{{-- resources/views/components/nav-form-button.blade.php --}}
<li>
    <form method="{{ $method }}" action="{{ $action }}">
        @csrf
        <button type="submit" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group cursor-pointer">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 font-bold transition duration-75 group-hover:text-gray-900"
                 fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                {!! $icon !!}
            </svg>
            <span class="ms-3">{{ $text }}</span>
        </button>
    </form>
</li>
