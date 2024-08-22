<x-layout>
    <!-- Display Flash Messages -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{ route('penpos.listPlayer', ['action' => 'HERITAGE', 'id' => 'heritageOption']) }}">&lt;&lt; Heritage</a>
    <h1>{{$player->username}}</h1>
    <h1>{{$ubaya->point}}</h1>
    @foreach ($heritageOption as $heritage)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>{{ $heritage->name }}</h3>
                <h3>Jumlah: {{ $heritage->heritage_amount }}</h3>
                <h3>Dimiliki: {{$heritage->player_amount?? 0}}</h3>
                <h3>Profit: {{ $heritage->profit }}</h3>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                <a href="{{ route('penpos.heritageCompletion', ['player' => $player->username, 'heritageID'=>$heritage->id]) }}">COMPLETE</a>
            </div>
        </div>
    @endforeach
</x-layout>