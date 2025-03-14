@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('show-delete-modal', () => {
            document.getElementById('delete-modal').classList.remove('hidden');
        });
        Livewire.on('hide-delete-modal', () => {
            document.getElementById('delete-modal').classList.add('hidden');
        });
    });
</script>
@endpush