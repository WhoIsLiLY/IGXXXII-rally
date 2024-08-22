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
    <a href="{{ route('penpos.listPlayer', ['action' => 'BANK', 'id' => 'bank']) }}">&lt;&lt; Bank</a>
    <h1>{{$player->username}}</h1>
    <h1>{{$ubaya->point}}</h1>
    @foreach ($payOption as $pay)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>{{ $pay->interest }}</h3>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                <a href="{{ route('penpos.payByID', ['player' => $player->username, 'id'=>$pay->id]) }}">pay</a>
            </div>
        </div>
    @endforeach
</x-layout>