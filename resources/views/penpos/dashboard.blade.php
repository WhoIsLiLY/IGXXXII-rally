<x-layout :title="'Penpos Dashboard'">
    <h1>Welcome to the Dashboard</h1>

    <div>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Tugu Pahlawan
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('penpos.listPlayer', ['action' => 'BUY LOKET', 'id' => 'buy-loket']) }}">Buy Loket</a></li>
                <li><a class="dropdown-item" href="{{ route('penpos.listPlayer', ['action' => 'UPGRADE LOKET', 'id' => 'upgrade-loket']) }}">Upgrade Loket</a></li>
                <li><a class="dropdown-item" href="{{ route('penpos.listPlayer', ['action' => 'BUY STAND', 'id' => 'buy-stand']) }}">Buy Stand</a></li>
                <li><a class="dropdown-item" href="{{ route('penpos.listPlayer', ['action' => 'BUY AD', 'id' => 'buy-ad']) }}">Buy Ad</a></li>
            </ul>
        </div>
        

        <a href="{{ route('penpos.kotalama') }}">
            <button type="button">Kota Lama</button>
        </a>

        <a href="">
            <button type="button">Ubaya</button>
        </a>
    </div>
</x-layout>