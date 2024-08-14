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
                <a href="{{ route('penpos.buyStandById', ['player'=>$player->username, 'stand'=>$stand->id]) }}" class="btn modern-btn">Buy Now</a>
            </div>
            {{ print($stand);}}
        </div>
    @endforeach
</x-layout>