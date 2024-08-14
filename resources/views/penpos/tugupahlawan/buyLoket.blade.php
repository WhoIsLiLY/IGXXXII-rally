<x-layout>
    @if(session('status') !== null)
        @if(session('status'))
            <div class="alert alert-info">Purchase was successful.</div>
        @else
            <div class="alert alert-warning">Purchase failed.</div>
        @endif
    @endif
    @php
        //  print_r($lokets);
        // print($player);
        if(isset($status)){
            if($status == false){
                // err message
                print("failed, inufficient point");
            }else{
                // success
                echo "success";
            }
        }
    @endphp
    <a href="{{ route('penpos.listPlayer', ['action'=>'BUY LOKET', 'id'=>'buyLoket']) }}">Back <<</a>
    <h3>Your Point: {{ $budget }}</h3>
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                New Stand | Price : {{ $price }}
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="{{ route('penpos.buyLoketById', ['player' => $player->username]) }}" class="btn modern-btn">Buy Now</a>
            </div>
        </div>
</x-layout>