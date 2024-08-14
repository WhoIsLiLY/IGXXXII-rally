<x-layout>
    @if(session('status') !== null)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('status') ? 'Success' : 'Failed' }}",
                    text: "{{ session('status') ? 'Purchase was successful.' : 'Purchase failed.' }}",
                    icon: "{{ session('status') ? 'success' : 'error' }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <a href="{{ route('penpos.listPlayer', ['action'=>'BUY LOKET', 'id'=>'buyLoket']) }}">Back <<</a>
    <h3>Your Point: {{ $budget }}</h3>
    <div class="row bg-secondary text-white py-3 mb-4" style="padding-left:20px;">
        <div class="col-md-10">
            New Stand | Price : {{ $price }}
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-end">
            <button onclick="confirmPurchase('{{ route('penpos.buyLoketById', ['player' => $player->username]) }}')" class="btn modern-btn">Buy Now</button>
        </div>
    </div>

    <script>
        function confirmPurchase(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be reversed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Buy Now!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
</x-layout>
