<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaderboard Ubaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        :root{
            --tarheelOrange: #C67A32;
            --beige: #FFF7E1;
            --mineShaft: #444240;
            --maroon1: #60070D;
            --maroon2: #6B0000;
            --merah: #871719;
            --velvet: #84483D;
            --moca: #b3967e;
            --cream: #cb553b;
            --sage: #75806F;
            --kuningCoklat: #E4AD49; 
        }
        body{
            background-color: var(--beige);
        }
        .item {
            background-color: var(--tarheelOrange);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="isi mx-5 mt-5">
        @foreach ($scores as $score)
            <div class="row item text-white py-3 mb-4" style="padding-left:20px;">
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
    </div>
</body>
</html>