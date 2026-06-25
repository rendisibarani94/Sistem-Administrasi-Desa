<div class="input-component">
    <label for="{{ $id ?? 'rupiah-input' }}" class="block mb-2 text-sm font-semibold text-gray-950">
        {{ $label ?? 'Jumlah (Rp)' }}
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-950 sm:text-sm font-semibold">Rp.</span>
        </div>
        <input
            type="text"
            name="{{ $name ?? 'amount' }}"
            id="{{ $id ?? 'rupiah-input' }}"
            @if(isset($wireModel)) wire:model.live="{{ $wireModel }}" @endif
            class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 pl-10 pr-12 placeholder:text-slate-600 @error($name ?? 'amount') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror"
            placeholder="{{ $placeholder ?? 'Masukan Jumlah' }}"
            autocomplete="off"
            x-data="{
                rawValue: '{{ $value ?? (isset($wireModel) ? (old($name) ?? '0') : '0') }}',
                isFocused: false,
                formatRupiah(value) {
                    if (!value || value === '0') {
                        return this.isFocused ? '' : '0';
                    }
                    let number = value.toString().replace(/\D/g, '');
                    number = number.replace(/^0+/, '') || '0';
                    return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }"
            x-init="
                // Initialize with Livewire value if available
                @if(isset($wireModel))
                this.rawValue = '{{ $this->{$wireModel} ?? '0' }}';
                @endif

                $el.value = this.formatRupiah(this.rawValue);

                @if(isset($wireModel))
                // Watch for Livewire updates
                Livewire.on('updated-{{ $wireModel }}', (value) => {
                    this.rawValue = value?.toString() || '0';
                    if (!this.isFocused) {
                        $el.value = this.formatRupiah(this.rawValue);
                    }
                });
                @endif
            "
            x-on:focus="
                this.isFocused = true;
                $el.value = this.rawValue === '0' ? '' : this.rawValue;
            "
            x-on:blur="
                this.isFocused = false;
                if (this.rawValue === '' || this.rawValue === '0') {
                    this.rawValue = '0';
                    $el.value = '0';
                } else {
                    $el.value = this.formatRupiah(this.rawValue);
                }
            "
            x-on:input.debounce.500ms="
                this.rawValue = $event.target.value.replace(/\D/g, '');
                this.rawValue = this.rawValue.replace(/^0+/, '') || '0';
                @if(isset($wireModel))
                $wire.set('{{ $wireModel }}', parseInt(this.rawValue) || 0);
                @endif
            "
            x-on:keypress="
                return ['0','1','2','3','4','5','6','7','8','9'].includes($event.key);
            "
        />
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
