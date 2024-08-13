<x-layout>
    @php
        print_r($ads);
        print_r($player)
    @endphp
    @foreach ($ads as $ad)
        {{ print($ad) }}
    @endforeach
</x-layout>