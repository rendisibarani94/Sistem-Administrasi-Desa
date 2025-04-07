<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
        Swal.fire({
            title: 'Sukses!'
            , text: "{{ session('success') }}"
            , icon: 'success'
            , confirmButtonText: 'OK'
        });
        @elseif(session('error'))
        Swal.fire({
            title: 'Gagal!'
            , text: "{{ session('error') }}"
            , icon: 'error'
            , confirmButtonText: 'OK'
        });
        @endif
    });

</script>
