<x-layout>
    <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
        <div class="col-md-10">
            <h3>DEBT</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.debtOption', ['player' => $player->username]) }}">DEBT</a>
        </div>
    </div>
    <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
        <div class="col-md-10">
            <h3>PAY</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.payOption', ['player' => $player->username]) }}">PAY</a>
        </div>
    </div>
</x-layout>