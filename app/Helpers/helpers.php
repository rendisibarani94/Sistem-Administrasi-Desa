<?php
if (!function_exists('resolve_image_url')) {
    /**
     * Resolve an image path from public assets, storage uploads, or direct URLs.
     *
     * @param string|null $path
     * @param string|null $fallback
     * @return string|null
     */
    function resolve_image_url($path, $fallback = null)
    {
        $path = is_string($path) ? trim($path) : '';

        if ($path === '') {
            return $fallback ? resolve_image_url($fallback) : null;
        }

        if (preg_match('/^(https?:)?\/\//', $path) || str_starts_with($path, 'data:')) {
            return $path;
        }

        $normalizedPath = ltrim(str_replace('\\', '/', $path), '/');

        if (is_file(public_path($normalizedPath))) {
            return asset($normalizedPath);
        }

        $storageRelativePath = str_starts_with($normalizedPath, 'storage/')
            ? ltrim(substr($normalizedPath, 8), '/')
            : $normalizedPath;

        if ($storageRelativePath !== '' && \Illuminate\Support\Facades\Storage::disk('public')->exists($storageRelativePath)) {
            $absolutePath = \Illuminate\Support\Facades\Storage::disk('public')->path($storageRelativePath);

            if (is_file($absolutePath)) {
                $mimeType = @mime_content_type($absolutePath) ?: 'application/octet-stream';
                return 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($absolutePath));
            }

            return asset('storage/' . $storageRelativePath);
        }

        return $fallback ? resolve_image_url($fallback) : null;
    }
}

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
