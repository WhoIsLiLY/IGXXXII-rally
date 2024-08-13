<x-layout>
    @php
        //  print_r($lokets);
        print($player);
        print($lokets);
    @endphp
    @foreach ($lokets as $loket)
        <a href="{{ route('penpos.buyLoketById', ['player' => $player->username , 'loket' => $loket->id]) }}">
            <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
                stand {{ $loket->id }} | price : {{ $price }} | {{ $player->username }} | {{ $loket->id }}
            </div>
        </a>
        {{ print($loket) }}
        
    @endforeach
</x-layout>