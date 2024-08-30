<x-layout>
    @if (session('status') !== null)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('status') ? 'Success' : 'Failed' }}",
                    text: "{{ session('status') ? 'Purchase was successful.' : 'Purchase failed. Inufficient Point!' }}",
                    icon: "{{ session('status') ? 'success' : 'error' }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @php
        //print_r($stands);
        //print_r($player);
    @endphp
    <div class="ms-4 text-text">
        <a href="{{ route('penpos.listPlayer', ['action' => 'BUY STAND', 'id' => 'buyStand']) }}">Back << </a>
    </div>
    <div class="m-4 text-text">
        <h3>Your Point: {{ $budget }}</h3>
    </div>
    @foreach ($stands as $stand)
        <div class="row div-color text-white py-3 m-4" style="padding-left:20px;border-radius:20px;">
            <div class="col-md-10 mt-2 text-text">
                <h3>{{ $stand->name }}</h3>
                <p>Customer Value: {{ $stand->probability }}</p>
                <p>Base Price: {{ $stand->base_price }} Point</p>
                <p>Amount Bought: {{ $stand->amount }}x</p>
                <p>Adjusted Price: {{ $stand->adjusted_base_price }} Point</p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <button class = "btn btn-secondary"
                    onclick="confirmPurchase('{{ route('penpos.buyStandById', ['player' => $player->username, 'stand' => $stand->id]) }}')">Buy
                    Now</button>
            </div>
        </div>
    @endforeach

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
