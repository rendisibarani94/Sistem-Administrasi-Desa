// Debug: Check if script is loaded
console.log('Rupiah Input Script Loaded');

function rupiahInput(wireModel) {
    console.log('rupiahInput function called with:', wireModel);

    return {
        rawValue: '',
        displayValue: '',
        focused: false,

        init() {
            console.log('Alpine component initialized');
            // Initialize with existing value if any
            if (this.$wire && this.$wire.get(wireModel)) {
                this.rawValue = this.$wire.get(wireModel);
                this.formatDisplay();
            }
        },

        updateValue() {
            console.log('updateValue called, displayValue:', this.displayValue);
            // Remove all non-digit characters
            const numbers = this.displayValue.replace(/\D/g, '');
            this.rawValue = numbers;
            console.log('rawValue set to:', this.rawValue);

            // Format for display
            this.formatDisplay();

            // Update Livewire property if exists
            if (this.$wire && wireModel) {
                this.$wire.set(wireModel, this.rawValue);
            }
        },

        formatDisplay() {
            console.log('formatDisplay called, rawValue:', this.rawValue, 'focused:', this.focused);

            if (!this.rawValue) {
                this.displayValue = '';
                return;
            }

            // Don't format while user is typing (focused)
            if (this.focused) {
                this.displayValue = this.rawValue;
                return;
            }

            // Format number with thousand separators
            const formatted = new Intl.NumberFormat('id-ID').format(this.rawValue);
            this.displayValue = formatted;
            console.log('Formatted value:', formatted);
        }
    }
}
