<x-layout>
    @if(session('status') !== null)
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
        <a href="{{ route('penpos.listPlayer', ['action'=>'BUY STAND', 'id'=>'buyStand']) }}">Back <<</a>
        <h3>Your Point: {{ $budget }}</h3>
    @foreach ($stands as $stand)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>{{ $stand->name }}</h3>
                <p>Customer Value: {{ $stand->probability }}</p>
                <p>Base Price: {{ $stand->base_price }}</p>
                <p>Amount Bought: {{ $stand->amount }}</p>
                <p>Adjusted Price: {{ $stand->adjusted_base_price }}</p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <button onclick="confirmPurchase('{{ route('penpos.buyStandById', ['player' => $player->username, 'stand'=>$stand->id]) }}')" class="btn modern-btn">Buy Now</button>
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