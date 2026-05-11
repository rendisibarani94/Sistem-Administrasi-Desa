<?php

namespace App\Livewire\Admin\DatabaseBackup;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Component
{
    use WithFileUploads;

    public $sqlFile;
    public $backupStatus        = '';
    public $backupStatusMessage = '';
    public $restoreStatus       = '';
    public $isRestoring         = false;
    public $isBackingUp         = false;
    public $availableBackups    = [];

    protected $rules = [
        'sqlFile' => 'required|file|mimes:sql,txt|max:102400', // 100 MB
    ];

    // -------------------------------------------------------------------------
    // Lifecycle
    // -------------------------------------------------------------------------

    public function mount(): void
    {
        $this->refreshBackupList();
    }

    // -------------------------------------------------------------------------
    // Backup
    // -------------------------------------------------------------------------

    public function backupDatabase(): void
    {
        $this->resetMessages();
        $this->isBackingUp = true;

        try {
            $success = $this->tryMysqldumpBackup();

            if (! $success) {
                // Fallback: pure-PHP backup (includes CREATE TABLE statements)
                $this->createPhpBackup();
            }

            $this->backupStatus        = 'success';
            $this->backupStatusMessage = 'Backup berhasil dibuat!';
            $this->refreshBackupList();

        } catch (\Exception $e) {
            $this->backupStatus        = 'error';
            $this->backupStatusMessage = 'Backup gagal: ' . $e->getMessage();
            logger()->error('Backup failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        } finally {
            $this->isBackingUp = false;
        }
    }

    private function tryMysqldumpBackup(): bool
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path     = storage_path('app/backups/' . $filename);

        $this->ensureBackupDirectoryExists();

        $config = config('database.connections.mysql');

        // Build command — WITHOUT --no-create-info so CREATE TABLE is included
        $command = [
            'mysqldump',
            '--user='     . $config['username'],
            '--host='     . ($config['host'] === '127.0.0.1' ? 'localhost' : $config['host']),
            '--port='     . $config['port'],
            '--protocol=TCP',
            '--single-transaction',
            '--routines',
            '--triggers',
            '--add-drop-table',          // DROP TABLE IF EXISTS before CREATE TABLE
            '--result-file=' . $path,
            $config['database'],
        ];

        // Insert password only when non-empty
        if (! empty($config['password'])) {
            array_splice($command, 2, 0, ['--password=' . $config['password']]);
        }

        try {
            $process = new Process($command);
            $process->setTimeout(300);
            $process->run();

            if (
                $process->isSuccessful()
                && Storage::disk('backups')->exists($filename)
                && Storage::disk('backups')->size($filename) > 0
            ) {
                return true;
            }

            logger()->warning('mysqldump did not produce a valid file', [
                'stderr' => $process->getErrorOutput(),
            ]);

        } catch (\Exception $e) {
            logger()->warning('mysqldump not available, falling back to PHP backup', [
                'error' => $e->getMessage(),
            ]);
        }

        return false;
    }

    private function createPhpBackup(): void
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';

        $this->ensureBackupDirectoryExists();

        $dbName = config('database.connections.mysql.database');
        $tables = DB::select('SHOW TABLES');
        $sql    = "-- PHP Backup: {$dbName} | " . now()->toDateTimeString() . "\n";
        $sql   .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $tableRow) {
            $tableName = $tableRow->{"Tables_in_{$dbName}"};

            // DROP + CREATE TABLE
            $createRow = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $createSql = $createRow[0]->{'Create Table'};
            $sql      .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql      .= $createSql . ";\n\n";

            // INSERT rows in chunks to avoid memory issues
            DB::table($tableName)->orderBy(DB::raw('1'))->chunk(500, function ($rows) use ($tableName, &$sql) {
                foreach ($rows as $row) {
                    $values = [];
                    foreach ((array) $row as $value) {
                        if (is_null($value)) {
                            $values[] = 'NULL';
                        } else {
                            $values[] = "'" . addslashes((string) $value) . "'";
                        }
                    }
                    $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                }
            });

            $sql .= "\n";
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        Storage::disk('backups')->put($filename, $sql);

        if (Storage::disk('backups')->size($filename) === 0) {
            throw new \Exception('PHP backup produced an empty file.');
        }
    }

    // -------------------------------------------------------------------------
    // Restore
    // -------------------------------------------------------------------------

    public function restoreDatabase(): void
    {
        $this->resetMessages();
        $this->isRestoring = true;
        $filePath          = null; // must be declared here so finally{} can see it

        try {
            $this->validate();

            if (! $this->sqlFile) {
                throw new \Exception('Tidak ada file yang dipilih untuk restore.');
            }

            // Save upload to backups disk temporarily
            $filePath = $this->sqlFile->storeAs(
                '',
                'restore-tmp-' . now()->format('Y-m-d_H-i-s') . '.sql',
                'backups'
            );

            $sql = Storage::disk('backups')->get($filePath);

            if (empty(trim($sql))) {
                throw new \Exception('File SQL kosong atau tidak dapat dibaca.');
            }

            // Try mysql CLI restore first (fastest, handles edge cases)
            $restored = $this->tryMysqlCliRestore(
                Storage::disk('backups')->path($filePath)
            );

            if (! $restored) {
                // Fallback: execute statement-by-statement via Laravel DB
                $this->executeStatements($sql);
            }

            $this->restoreStatus = 'success';

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->restoreStatus = 'error';
            throw $e; // let Livewire handle validation errors normally

        } catch (\Exception $e) {
            $this->restoreStatus = 'error';
            logger()->error('Restore failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        } finally {
            // Clean up temp file
            if ($filePath && Storage::disk('backups')->exists($filePath)) {
                Storage::disk('backups')->delete($filePath);
            }
            $this->isRestoring = false;
            $this->refreshBackupList();
        }
    }

    /**
     * Try to restore using the mysql CLI tool.
     * Returns true on success, false if CLI is not available.
     */
    private function tryMysqlCliRestore(string $absolutePath): bool
    {
        $config  = config('database.connections.mysql');
        $command = [
            'mysql',
            '--user='  . $config['username'],
            '--host='  . ($config['host'] === '127.0.0.1' ? 'localhost' : $config['host']),
            '--port='  . $config['port'],
            '--protocol=TCP',
            $config['database'],
        ];

        if (! empty($config['password'])) {
            array_splice($command, 2, 0, ['--password=' . $config['password']]);
        }

        try {
            $process = new Process(
                array_merge($command, ['--execute=source ' . $absolutePath])
            );
            $process->setTimeout(300);
            $process->run();

            if ($process->isSuccessful()) {
                return true;
            }

            logger()->warning('mysql CLI restore failed, falling back to PHP', [
                'stderr' => $process->getErrorOutput(),
            ]);

        } catch (\Exception $e) {
            logger()->warning('mysql CLI not available, using PHP fallback', [
                'error' => $e->getMessage(),
            ]);
        }

        return false;
    }

    /**
     * Execute SQL file statement by statement using Laravel DB.
     */
    private function executeStatements(string $sql): void
    {
        // Strip /* ... */ block comments and -- line comments
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
        $sql = preg_replace('/^--.*$/m', '', $sql);

        // Split on semicolons that are NOT inside quoted strings
        $statements = $this->splitSqlStatements($sql);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (! empty($statement)) {
                DB::unprepared($statement);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Split SQL into individual statements, respecting quoted strings.
     */
    private function splitSqlStatements(string $sql): array
    {
        $statements  = [];
        $current     = '';
        $inString    = false;
        $stringChar  = '';
        $length      = strlen($sql);

        for ($i = 0; $i < $length; $i++) {
            $char = $sql[$i];

            if ($inString) {
                $current .= $char;
                // Handle escape sequences inside strings
                if ($char === '\\') {
                    $current .= $sql[++$i] ?? '';
                } elseif ($char === $stringChar) {
                    $inString = false;
                }
            } elseif ($char === '"' || $char === "'" || $char === '`') {
                $inString   = true;
                $stringChar = $char;
                $current   .= $char;
            } elseif ($char === ';') {
                $statements[] = $current;
                $current      = '';
            } else {
                $current .= $char;
            }
        }

        if (! empty(trim($current))) {
            $statements[] = $current;
        }

        return $statements;
    }

    // -------------------------------------------------------------------------
    // Manage existing backups
    // -------------------------------------------------------------------------

    public function downloadBackup(string $filename)
    {
        if (! Storage::disk('backups')->exists($filename)) {
            $this->backupStatus        = 'error';
            $this->backupStatusMessage = 'File backup tidak ditemukan.';
            return;
        }

        return Storage::disk('backups')->download($filename);
    }

    public function deleteBackup(string $filename): void
    {
        if (! Storage::disk('backups')->exists($filename)) {
            $this->backupStatus        = 'error';
            $this->backupStatusMessage = 'File backup tidak ditemukan.';
            return;
        }

        Storage::disk('backups')->delete($filename);
        $this->refreshBackupList();

        $this->backupStatus        = 'success';
        $this->backupStatusMessage = 'Backup berhasil dihapus.';
    }

    public function refreshBackupList(): void
    {
        $files = Storage::disk('backups')->files('');

        $this->availableBackups = collect($files)
            ->filter(fn ($file) => pathinfo($file, PATHINFO_EXTENSION) === 'sql')
            ->map(fn ($file) => [
                'name' => basename($file),
                'size' => Storage::disk('backups')->size($file),
                'date' => Storage::disk('backups')->lastModified($file),
            ])
            ->sortByDesc('date')
            ->values()
            ->toArray();
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function ensureBackupDirectoryExists(): void
    {
        $path = storage_path('app/backups');
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    private function resetMessages(): void
    {
        $this->reset(['backupStatus', 'backupStatusMessage', 'restoreStatus']);
    }

    // -------------------------------------------------------------------------
    // Render
    // -------------------------------------------------------------------------

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.database-backup.index');
    }
}