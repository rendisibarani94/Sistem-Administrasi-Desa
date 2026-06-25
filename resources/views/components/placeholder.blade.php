@props([
    'title' => 'Konten Belum Tersedia',
    'description' => 'Konten Sedang Dipersiapkan',
    'showPlaceholder' => true,
])

<div class="bg-gray-50 rounded-xl p-8 text-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>

    <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $title }}</h3>
    <p class="mt-2 text-sm text-gray-500">
        {{ $description }}
    </p>

    @if($showPlaceholder)
    <div class="mt-6 animate-pulse">
        <div class="h-4 bg-gray-200 rounded w-3/4 mx-auto"></div>
        <div class="h-4 bg-gray-200 rounded w-1/2 mx-auto mt-2"></div>
        <div class="h-4 bg-gray-200 rounded w-2/3 mx-auto mt-2"></div>
    </div>
    @endif
</div>
