<x-layout>
    @php
        print_r($stands);
        print_r($player);
    @endphp
    @foreach ($stands as $ad)
        {{ print($ad) }}
    @endforeach
</x-layout>