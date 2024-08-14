<x-layout>
    @if(session('status') !== null)
        @if(session('status'))
            <div class="alert alert-info">Purchase was successful.</div>
        @else
            <div class="alert alert-warning">Purchase failed.</div>
        @endif
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
                <p>Base Price: {{ $ad->base_price }}</p>
                <p>Amount Bought: {{ $ad->amount }}</p>
                <p>Adjusted Price: {{ $ad->adjusted_base_price }}</p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="{{ route('penpos.buyAdById', ['player'=>$player->username, 'ad'=>$ad->id]) }}" class="btn modern-btn">Buy Now</a>
            </div>
            {{ print($ad);}}
        </div>
    @endforeach
</x-layout>