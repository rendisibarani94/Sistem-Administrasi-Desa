{{-- @if (session()->has('success'))
<!-- Success Alert -->
<div class="bg-teal-50 border-3 border-teal-500 rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
    <div class="flex">
        <div class="shrink-0">
            <!-- Icon -->
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                </svg>
            </span>
            <!-- End Icon -->
        </div>
        <div class="ms-3">
            <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold">
                Berhasil!
            </h3>
            <p class="text-sm text-gray-700">
                {{ session('success') }}
</p>
</div>
</div>
</div>

@elseif (session()->has('failed'))

<!-- Error Alert -->
<div class="bg-red-50 border-4 border-red-500 rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
    <div class="flex">
        <div class="shrink-0">
            <!-- Icon -->
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </span>
            <!-- End Icon -->
        </div>
        <div class="ms-3">
            <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold">
                Gagal!
            </h3>
            <p class="text-sm text-gray-700">
                {{ session('failed') }}
            </p>
        </div>
    </div>
</div>
@endif --}}
@push('scripts')
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

@endpush
