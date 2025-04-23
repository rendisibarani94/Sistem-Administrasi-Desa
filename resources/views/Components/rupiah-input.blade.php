<div class="input-component">
    <label for="{{ $id ?? 'rupiah-input' }}" class="block mb-2 text-sm font-semibold text-gray-950">
        {{ $label ?? 'Jumlah (Rp)' }}
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-950 sm:text-sm font-semibold">Rp.</span>
        </div>
        <input type="text" name="{{ $name ?? 'amount' }}" id="{{ $id ?? 'rupiah-input' }}" @if(isset($wireModel)) wire:model.live="{{ $wireModel }}" @endif class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 pl-10 pr-12 placeholder:text-slate-600 @error($name ?? 'amount') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror" placeholder="{{ $placeholder ?? 'Masukan Jumlah' }}" value="{{ $value ?? '' }}" autocomplete="off" x-data="{ 
                value: '{{ $value ?? '' }}',
                isFocused: false,
                formatRupiah() {
                    if (!this.value || this.value === '0') {
                        return this.isFocused ? '' : '0';
                    }
                    // Remove non-digit characters
                    let number = this.value.replace(/\D/g, '');
                    
                    // Remove leading zeros, preserving a single zero if necessary
                    number = number.replace(/^0+/, '') || '0';
                    
                    // Add thousand separators
                    return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }" x-data="{ 
                value: '{{ $value ?? '' }}',
                isFocused: false,
                formatRupiah() {
                    if (!this.value || this.value === '0') return '0';
                    return this.value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },
                rawValue() {
                    return this.value.replace(/\D/g, '').replace(/^0+/, '') || '0';
                }
            }" x-init="
                $nextTick(() => {
                    if ($wire.{{ $wireModel ?? 'null' }} !== undefined) {
                        value = $wire.{{ $wireModel ?? 'null' }}.toString();
                    }
                    // Initial format with separators
                    $el.value = formatRupiah();
                });
            " x-on:focus="
                isFocused = true;
                // Show raw value without formatting when focused
                $el.value = value === '0' ? '' : rawValue();
            " x-on:input="
                // Update raw value without formatting
                value = $event.target.value.replace(/\D/g, '');
                value = value.replace(/^0+/, '') || '0';
                $dispatch('input', value);
            " x-on:blur="
                isFocused = false;
                // Handle empty/zero values
                if (value === '' || value === '0') {
                    value = '0';
                    $el.value = '0';
                } else {
                    // Apply formatting when blurring
                    $el.value = formatRupiah();
                }
                $dispatch('input', value);
            " x-on:keypress="
                return ['0','1','2','3','4','5','6','7','8','9'].includes($event.key);
            " />
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <span class="text-gray-950 sm:text-sm font-semibold">IDR</span>
        </div>
    </div>
    <div class="h-0.25">
        @error($name ?? 'amount')
        <span class="errorMsg text-red-500 font-semibold text-xs italic">{{ "*".$message }}</span>
        @enderror
    </div>
</div>
