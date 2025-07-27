<?php
namespace App\Livewire\Admin\DatabaseBackup;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Component
{
    use WithFileUploads;

    public $sqlFile;
    public $backupStatus = '';
    public $backupStatusMessage = '';
    public $restoreStatus = '';
    public $isRestoring = false;
    public $isBackingUp = false;
    public $availableBackups = [];

    protected $rules = [
        'sqlFile' => 'required|file|mimes:sql,txt|max:10240', // 100MB max
    ];

    public function mount()
    {
        $this->refreshBackupList();
    }

    public function refreshBackupList()
    {
        $files = Storage::disk('backups')->files('');
        $this->availableBackups = collect($files)
            ->filter(fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'sql')
            ->map(fn($file) => [
                'name' => basename($file),
                'size' => Storage::disk('backups')->size($file),
                'date' => Storage::disk('backups')->lastModified($file)
            ])
            ->sortByDesc('date')
            ->toArray();
    }

    public function backupDatabase()
    {
        $this->resetMessages();
        $this->isBackingUp = true;

        try {
            // Try mysqldump first, fallback to PHP method
            if ($this->tryMysqldumpBackup()) {
                $this->backupStatus = 'success';
                $this->refreshBackupList();
                return;
            }

            // Fallback to PHP-based backup
            $this->createPhpBackup();
            $this->backupStatus = 'success';
            $this->refreshBackupList();

        } catch (\Exception $e) {
            $this->backupStatus = 'error';
            logger()->error('Backup failed: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString()
            ]);
        } finally {
            $this->isBackingUp = false;
            $this->backupStatusMessage = 'Backup Berhasil!';
        }
    }

    private function tryMysqldumpBackup()
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        // Ensure directory exists
        if (!Storage::disk('backups')->exists('')) {
            Storage::disk('backups')->makeDirectory('');
        }

        $config = config('database.connections.mysql');

        // Build command array with Windows/XAMPP specific fixes
        $command = [
            'mysqldump',
            '--user=' . $config['username'],
            '--protocol=TCP',
            '--host=' . ($config['host'] === '127.0.0.1' ? 'localhost' : $config['host']),
            '--port=' . $config['port'],
            '--single-transaction',
            '--routines',
            '--triggers',
            '--no-create-info',
            '--skip-add-drop-table',
            '--result-file=' . $path,
            $config['database']
        ];

        // Only add password if it's not empty
        if (!empty($config['password'])) {
            array_splice($command, 2, 0, ['--password=' . $config['password']]);
        }

        try {
            $process = new Process($command);
            $process->setTimeout(300);
            $process->run();

            if ($process->isSuccessful() && Storage::disk('backups')->exists($filename) && Storage::disk('backups')->size($filename) > 0) {
                return true;
            }
        } catch (\Exception $e) {
            logger()->warning('Mysqldump failed, trying PHP backup', ['error' => $e->getMessage()]);
        }

        return false;
    }

    private function createPhpBackup()
    {
        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';

        // Ensure directory exists
        if (!Storage::disk('backups')->exists('')) {
            Storage::disk('backups')->makeDirectory('');
        }

        $sql = '';
        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');

        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_{$dbName}"};

            // Get table data
            $rows = DB::table($tableName)->get();

            if ($rows->count() > 0) {
                foreach ($rows as $row) {
                    $sql .= "INSERT INTO `{$tableName}` VALUES (";
                    $values = [];
                    foreach ($row as $value) {
                        if (is_null($value)) {
                            $values[] = 'NULL';
                        } else {
                            $values[] = "'" . addslashes($value) . "'";
                        }
                    }
                    $sql .= implode(', ', $values) . ");\n";
                }
            }
        }

        Storage::disk('backups')->put($filename, $sql);

        if (Storage::disk('backups')->size($filename) == 0) {
            throw new \Exception('PHP backup created empty file');
        }
    }

    public function restoreDatabase()
    {
        $this->resetMessages();
        $this->isRestoring = true;

        $this->validate();

        try {
            if (!$this->sqlFile) {
                throw new \Exception('No file selected for restore');
            }

            // Store uploaded file in the 'backups' disk
            $filePath = $this->sqlFile->storeAs('', 'restore-' . now()->format('Y-m-d_H-i_s') . '.sql', 'backups');

            // Read the SQL file
            $sql = Storage::disk('backups')->get($filePath);

            if (empty(trim($sql))) {
                throw new \Exception('Uploaded SQL file is empty or could not be read');
            }

            // Execute the SQL commands
            DB::unprepared($sql);

            $this->restoreStatus = 'success';
        } catch (\Exception $e) {
            $this->restoreStatus = 'error';
            logger()->error('Restore failed: ' . $e->getMessage(), [
                'exception' => $e->getTraceAsString()
            ]);
        } finally {
        if ($filePath) {
            Storage::disk('backups')->delete($filePath);
        }

            $this->isRestoring = false;
            $this->refreshBackupList();
        }
    }

    public function downloadBackup($filename)
    {
        if (!Storage::disk('backups')->exists($filename)) {
            $this->backupStatus = 'error';
            return;
        }

        // return Storage::download('backups', $filename);
        return Storage::disk('backups')->download($filename);
    }

    private function resetMessages()
    {
        $this->reset(['backupStatus', 'restoreStatus']);
    }

    public function deleteBackup($filename)
    {
        if (!Storage::disk('backups')->exists($filename)) {
            $this->backupStatus = 'error';
            $this->backupStatusMessage = 'Backup Gagal Dihapus.';
            return;
        }

        Storage::disk('backups')->delete($filename);
        $this->refreshBackupList();
        $this->backupStatus = 'success';
        $this->backupStatusMessage = 'Backup Berhasil Dihapus.';
    }

    #[Layout('components.layouts.layouts')]
    public function render()
    {
        return view('admin.database-backup.index');
    }
}
