@props([
    'title',
    'icon',
    'childLinks' => [],
    'id' => null
])

@php
    // Generate a unique ID for the dropdown if not provided
    $dropdownId = $id ?? 'dropdown-' . \Illuminate\Support\Str::random(8);
    
    // Check if any child route is active to determine if dropdown should be open
    $isAnyChildActive = false;
    foreach ($childLinks as $link) {
        if (isset($link['route']) && request()->routeIs($link['route'])) {
            $isAnyChildActive = true;
            break;
        }
    }
    
    // Classes for the button
    $buttonBaseClasses = 'flex items-center transition duration-150 w-full p-2 text-base rounded-lg group cursor-pointer';
    $buttonInactiveClasses = 'text-gray-900 dark:text-zinc-950 hover:text-white hover:bg-gray-100 dark:hover:bg-teal-700';
    $buttonActiveClasses = '';
    $buttonClasses = $buttonBaseClasses . ' ' . $buttonInactiveClasses;
    
    // SVG classes
    $svgBaseClasses = 'shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white';
    $svgInactiveClasses = 'text-gray-500 dark:text-zinc-950';
    $svgActiveClasses = 'text-gray-900 dark:text-white';
    $svgClasses = $svgInactiveClasses . ' ' . $svgBaseClasses;
    
    // Arrow icon classes with transition and rotation based on dropdown state
    $arrowBaseClasses = 'w-[28px] h-[28px] transition-transform duration-300 dark:group-hover:text-white';
    $arrowTransform = ''; // Always start with no rotation
    $arrowClasses = $arrowBaseClasses . ' ' . $arrowTransform;
    
    // Dropdown content classes - always start hidden regardless of active state
    $dropdownClasses = !$isAnyChildActive ?  'hidden py-2 space-y-2 transition-all duration-300 ease-in-out overflow-hidden' : 'py-2 space-y-2 transition-all duration-300 ease-in-out overflow-hidden';
@endphp

<li>
    <button 
        type="button" 
        class="{{ $buttonClasses }}" 
        aria-controls="{{ $dropdownId }}" 
        data-collapse-toggle="{{ $dropdownId }}"
        {{ $attributes }}
    >
        <svg class="{{ $svgClasses }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
            {!! $icon !!}
        </svg>
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $title }}</span>

        <svg class="{{ $arrowClasses }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
          </svg>
          
          
    </button>
    <ul id="{{ $dropdownId }}" class="{{ $dropdownClasses }}">
        @foreach ($childLinks as $link)
            @if (isset($link['icon']))
                <x-nav-link 
                    href="{{ route($link['route']) }}" 
                    :active="request()->routeIs($link['route'])" 
                    :path="$link['icon']"
                    customClass="ml-5"
                >
                    {{ $link['text'] }}
                </x-nav-link>
            @else
                <x-nav-link 
                    href="{{ route($link['route']) }}" 
                    :active="request()->routeIs($link['route'])"
                    customClass="ml-5"
                >
                    {{ $link['text'] }}
                </x-nav-link>
            @endif
        @endforeach
    </ul>
</li>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all dropdown toggle buttons
        const dropdownToggles = document.querySelectorAll('[data-collapse-toggle]');
        
        dropdownToggles.forEach(toggle => {
            // Store original click handler
            const originalClickHandler = toggle.onclick;
            
            // Replace with our custom handler
            toggle.onclick = function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('data-collapse-toggle');
                const target = document.getElementById(targetId);
                const arrow = this.querySelector('svg:last-child');
                
                // Toggle the visibility and rotation
                if (target.classList.contains('hidden')) {
                    // Open dropdown
                    target.classList.remove('hidden');
                    target.classList.add('max-h-96');
                    arrow.classList.add('transform', 'rotate-90');
                } else {
                    // Close dropdown
                    target.classList.add('hidden');
                    target.classList.remove('max-h-96');
                    arrow.classList.remove('transform', 'rotate-90');
                }
                
                // Prevent default behavior that might be causing conflicts
                return false;
            };
        });
    });
</script>
@endpush