<x-layout>
    @if (session('status') !== null)
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
    <div class = "ms-4">
        <a href="{{ route('penpos.listPlayer', ['action' => 'BUY LOKET', 'id' => 'buyLoket']) }}">Back << </a>
    </div>
    <div class = "m-4 text-text">
        <h3>Your Point: {{ $budget }}</h3>
    </div>
    <div class="row div-color text-white py-3 m-4" style="padding-left:20px;border-radius:20px;">
        <div class="col-md-10 mt-2 text-text">
            New Loket | Price : {{ $price }} Point
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-end">
            <form id="buyLoketForm" action="{{ route('penpos.buyLoketById', ['player' => $player->username]) }}" method="post">
                @csrf
                <button type="button" onclick="confirmPurchase()" class="btn btn-secondary">Buy Now</button>
            </form>
        </div>
    </div>

    <script>
        function confirmPurchase() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be reversed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Buy Now!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('buyLoketForm').submit();
                }
            })
        }
    </script>
</x-layout>
