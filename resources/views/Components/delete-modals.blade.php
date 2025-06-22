<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle the confirmation dialog
        @this.on('swal:confirm', (parameters) => {
            Swal.fire({
                title: parameters[0].title,
                text: parameters[0].text,
                icon: parameters[0].icon,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: parameters[0].confirmButtonText,
                cancelButtonText: parameters[0].cancelButtonText,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.delete();
                }
            });
        });

        // Handle the success message with custom GIF
        @this.on('swal:success', (parameters) => {
            Swal.fire({
                title: parameters[0].title,
                text: parameters[0].text,
                imageUrl: "{{ asset('vendor/sweetalert/success/sukses.gif') }}",
                imageWidth: 250,
                imageHeight: 250,
                imageAlt: 'Custom GIF',
                confirmButtonText: 'OK',
                confirmButtonColor: '#0f766e'
            });
        });
    });
</script>
