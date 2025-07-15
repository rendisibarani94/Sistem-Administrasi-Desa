<?php
if (!function_exists('cleanup_livewire_temp_files')) {
    /**
     * Clean up Livewire temporary files
     *
     * @param mixed $files Single file or array of files
     * @return void
     */
    function cleanup_livewire_temp_files($files)
    {
        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            try {
                if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                    $file->delete();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Failed to cleanup temporary file: ' . $e->getMessage());
            }
        }
    }

        // Add this helper function
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }


}
