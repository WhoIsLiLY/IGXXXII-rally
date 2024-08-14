<x-layout>
    @if(session('status') !== null)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('status') ? 'Success' : 'Failed' }}",
                    text: "{{ session('status') ? 'Upgrade was successful.' : 'Upgrade failed. Inufficient Point!' }}",
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
        <a href="{{ route('penpos.listPlayer', ['action'=>'UPGRADE LOKET', 'id'=>'upgradeLoket']) }}">Back <<</a>
        <h3>Your Point: {{ $budget }}</h3>
        @if ($lokets->count() === 0){
            <h1>You don't have any loket! <a href="{{ route('penpos.buyLoket', ['player'=>$player->username]) }}">Buy it now!</a></h1>
        }
            
        @endif
    @foreach ($lokets as $loket)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>Loket {{ $loket->id }}</h3>
                
                @if(!$loket->upgrade_price)
                <p>Service Time: {{ $loket->service_time }}</p>
                    <p>Level Maxed</p>
                @else
                    <p>Service Time: {{ $loket->service_time }} -> {{ $loket->service_time - 5 }}</p>
                    <p>Upgrade Price: {{ $loket->upgrade_price }} Point</p>
                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                        <button onclick="confirmPurchase('{{ route('penpos.upgradeLoketById', ['player' => $player->username, 'loket'=>$loket->id, 'price'=>$loket->upgrade_price]) }}')" class="btn modern-btn">Buy Now</button>
                    </div>
                @endif

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