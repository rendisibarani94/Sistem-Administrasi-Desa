@props(['active' => false, 'path' => null, 'customClass' => ''])

@php
    // Base classes always applied to the anchor element
    $baseClasses = 'flex items-center p-2 transition duration-150 rounded-lg group';

    // Classes for inactive (default) state
    $inactiveClasses = 'dark:text-zinc-950 hover:text-white dark:hover:bg-teal-700';

    // Classes for the active state (mimicking the hover state)
    $activeClasses = 'text-white dark:bg-teal-700';

    // Combine the base with either the active or inactive classes
    $aClasses = $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses);

    // SVG classes: base + different color depending on active state
    $svgBaseClasses = 'w-5 h-5 transition duration-75 dark:group-hover:text-white';
    $svgInactiveClasses = 'dark:text-zinc-950';
    $svgActiveClasses = 'dark:text-white';
    $svgClasses = ($active ? $svgActiveClasses : $svgInactiveClasses) . ' ' . $svgBaseClasses;
@endphp

<li>
    <a {{ $attributes->merge(['class' => $aClasses . ' ' . $customClass]) }} aria-current="{{ $active ? 'page' : 'false' }}">
        @if ($path)
            <svg class="{{ $svgClasses }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                {!! $path !!}
            </svg>
        @endif
        <span class="ms-3">{{ $slot }}</span>
    </a>
</li>
