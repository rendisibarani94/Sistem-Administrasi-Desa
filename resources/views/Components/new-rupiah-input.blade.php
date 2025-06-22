<div
    class="input-component"
    x-data="{
        rawValue: @entangle($attributes->whereStartsWith('wire:model')->first()),
        displayValue: '',
        focused: false,
        initialized: false,

        init() {
            // Proper initialization
            this.$nextTick(() => {
                this.handleInitialValue();
                this.initialized = true;
            });

            // Efficient value watcher
            this.$watch('rawValue', (value) => {
                if (this.initialized && value !== null) {
                    this.formatDisplay();
                }
            });
        },

        handleInitialValue() {
            // Handle all number cases
            const numValue = Number(this.rawValue);
            if (!isNaN(numValue)) {
                this.rawValue = numValue;
                this.formatDisplay();
            }
        },

        updateValue() {
            // Proper number handling
            const numbers = this.displayValue.replace(/\D/g, '');
            this.rawValue = numbers ? parseInt(numbers, 10) : 0;
        },

        formatDisplay() {
            // Handle empty case
            if (!this.rawValue && this.rawValue !== 0) {
                this.displayValue = '';
                return;
            }

            // Handle zero explicitly
            if (this.rawValue === 0) {
                this.displayValue = '0';
                return;
            }

            // Format based on focus state
            this.displayValue = this.focused
                ? this.rawValue.toString()
                : new Intl.NumberFormat('id-ID').format(this.rawValue);
        }
    }"
>
    <label for="{{ $name }}" class="block mb-2 text-sm font-semibold text-gray-950">
        {{ $label ?? 'Jumlah (Rp)' }}
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-950 sm:text-sm font-semibold">Rp.</span>
        </div>

        <!-- Fixed input with name attribute -->
        <input
            type="text"
            name="{{ $name }}"
            x-model="displayValue"
            @input="updateValue"
            @focus="focused = true"
            @blur="focused = false; formatDisplay()"
            class="bg-gray-50 border text-gray-900 font-medium text-sm rounded-sm block w-full p-2.5 pl-10 pr-12 placeholder:text-slate-600 @error($name) border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-400 focus:ring-blue-500 focus:border-blue-500 @enderror"
            placeholder="Masukan Jumlah"
            autocomplete="off"
        />
    </div>

    {{-- Show validation error if exists --}}
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
