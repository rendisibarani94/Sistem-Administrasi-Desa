<div class="input-component">
    <label for="{{ $id ?? 'textarea-input' }}" class="block mb-2 text-sm font-semibold text-gray-950">
        {{ $label ?? 'Textarea' }}
    </label>
    <div class="relative">
        <textarea 
            id="{{ $id ?? 'textarea-input' }}" 
            name="{{ $name ?? 'textarea' }}" 
            @if(isset($wireModel)) 
                wire:model.live="{{ $wireModel }}" 
            @endif 
            class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 placeholder:text-slate-600 @error($name ?? 'textarea') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" 
            placeholder="{{ $placeholder ?? 'Masukan Text' }}" 
            autocomplete="off" 
            rows="1" 
            x-data="{ 
                resize() {
                    $el.style.height = '0px';
                    $el.style.height = ($el.scrollHeight) + 'px';
                }
            }" 
            x-init="
                resize();
                $el.placeholder = '{{ $placeholder ?? 'Masukan Text' }}';
                
                // Add mutation observer to watch for Livewire updates
                const observer = new MutationObserver(() => {
                    setTimeout(() => resize(), 0);
                });
                
                observer.observe($el, { 
                    attributes: true, 
                    childList: true, 
                    characterData: true,
                    subtree: true
                });
                
                // Also listen for Livewire update events
                document.addEventListener('livewire:update', () => {
                    setTimeout(() => resize(), 0);
                });
            " 
            x-on:input="resize()" 
            x-on:focus="if($el.value === '') resize()"
        >{{ $slot ?? $value ?? '' }}</textarea>
    </div>
    <div class="h-0.25">
        @error($name ?? 'textarea')
            <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
        @enderror
    </div>
</div>