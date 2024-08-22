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
    @foreach ($debtOption as $debt)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            <div class="col-md-10">
                <h3>{{ $debt->point }}</h3>
                <p>interest rate: {{ $debt->interest_rate }}%</p>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                <a href="{{ route('penpos.debtByID', ['player' => $player->username, 'id'=>$debt->id]) }}">Debt</a>
            </div>
        </div>
    @endforeach
</x-layout>