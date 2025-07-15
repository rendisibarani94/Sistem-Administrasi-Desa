<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    public function export()
{
    try {
        $filename = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);

        // Ensure directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Get database configuration
        $config = config('database.connections.mysql');
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s --port=%s --no-create-info --skip-triggers %s > %s',
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['host']),
            escapeshellarg($config['port']),
            escapeshellarg($config['database']),
            escapeshellarg($path)
        );

        // Execute command
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(300); // 5 minutes
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->download($path)->deleteFileAfterSend(true);

    } catch (\Exception $e) {
        return back()->withErrors('Backup failed: ' . $e->getMessage());
    }
}

public function import(Request $request)
{
    $request->validate([
        'sql_file' => 'required|file|mimes:sql,txt|max:10240'
    ]);

    try {
        // Store uploaded file
        $file = $request->file('sql_file');
        $path = $file->storeAs('restores', 'restore_' . time() . '.sql');

        // Get full file path
        $filePath = storage_path('app/' . $path);

        // Get database config
        $config = config('database.connections.mysql');

        $command = sprintf(
            'mysql --user=%s --password=%s --host=%s --port=%s %s < %s',
            escapeshellarg($config['username']),
            escapeshellarg($config['password']),
            escapeshellarg($config['host']),
            escapeshellarg($config['port']),
            escapeshellarg($config['database']),
            escapeshellarg($filePath)
        );

        // Execute command
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(300); // 5 minutes
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return back()->with('success', 'Database restored successfully!');

    } catch (\Exception $e) {
        return back()->withErrors('Restore failed: ' . $e->getMessage());
    }
}


}


