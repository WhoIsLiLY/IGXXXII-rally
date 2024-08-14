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
        <a href="{{ route('penpos.listPlayer', ['action'=>'BUY AD', 'id'=>'buyAd']) }}">Back <<</a>
        <h3>Your Point: {{ $budget }}</h3>
    @foreach ($ads as $ad)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>{{ $ad->name }}</h3>
                <p>Customer Value: {{ $ad->probability }}</p>
                <p>Base Price: {{ $ad->base_price }} Point</p>
                <p>Amount Bought: {{ $ad->amount }}x</p>
                <p>Adjusted Price: {{ $ad->adjusted_base_price }} Point</p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <button onclick="confirmPurchase('{{ route('penpos.buyAdById', ['player' => $player->username, 'ad'=>$ad->id]) }}')" class="btn modern-btn">Buy Now</button>
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