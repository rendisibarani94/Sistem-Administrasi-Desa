<div class="p-6 bg-white rounded-lg shadow-md">
    <x-slot:judul>
        Data Base Backup Penduduk
    </x-slot:judul>
    <!-- Backup Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Database Backup</h2>
            <button
                wire:click="backupDatabase"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center cursor-pointer disabled:opacity-50"
            >
                <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                <span wire:loading>
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                {{ $isBackingUp ? 'Creating Backup...' : 'Create New Backup' }}
            </button>
        </div>

        @if($backupStatus === 'success')
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                Backup created successfully!
            </div>
        @elseif($backupStatus === 'error')
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                Backup failed! Please check server logs.
            </div>
        @endif

        @if(count($availableBackups))
            <div class="mt-6">
                <h3 class="font-medium mb-2">Available Backups:</h3>
                <div class="border rounded overflow-hidden">
                    @foreach($availableBackups as $backup)
                        <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50">
                            <div>
                                <div class="font-medium">{{ $backup['name'] }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ formatBytes($backup['size']) }}
                                    {{ \Carbon\Carbon::createFromTimestamp($backup['date'])->format('M d, Y H:i') }}
                                </div>
                            </div>
                            <button
                                wire:click="downloadBackup('{{ $backup['name'] }}')"
                                class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded text-sm cursor-pointer disabled:opacity-50"
                            >
                                Download
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-500">No backups available yet</p>
        @endif
    </div>

    <!-- Restore Section -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Database Restore</h2>
        <form wire:submit.prevent="restoreDatabase">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Select SQL File</label>
                <input
                    type="file"
                    wire:model="sqlFile"
                    accept=".sql,.txt"
                    class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:cursor-pointer
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100"
                >
                @error('sqlFile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center disabled:opacity-50 cursor-pointer"
            >
                <svg wire:loading.remove class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                </svg>
                <span wire:loading>
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                {{ $isRestoring ? 'Restoring Database...' : 'Restore Database' }}
            </button>
        </form>

        @if($restoreStatus === 'success')
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                Database restored successfully!
            </div>
        @elseif($restoreStatus === 'error')
            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                Restore failed! Please check the SQL file and try again.
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Helper function to format bytes
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
</script>
@endpush
