<x-layout>
    @foreach ($scores as $score)
        <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
            {{-- <div class="col-md-10 d-flex" style="justify-content:space-between;"> --}}
            <div class="col-md-10">
                <h3>{{ $score->username }}</h3>
                {{-- @if($score->liability!=null)
                    <p>total liability: {{ $score->liability }}</p>
                @else
                    <p>total liability: 0</p>
                @endif
                <p>current point: {{ $score->point }}</p>
                <p>inventory taken: {{ $score->total_space_taken }}</p>
                <p>cr: {{ $score->cr }}</p>
                <p>qr: {{ $score->qr }}</p>
                <p>completed heritages: {{ $score->heritage }}</p> --}}
                <p>score: {{ $score->score }}</p>
            </div>
        </div>
    @endforeach
</x-layout>