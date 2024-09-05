<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <title>{{ $title ?? 'Default Title' }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
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

        .isi{
            font-family: 'Montserrat';
        }
        .text{
            color: var(--velvet);
            font-weight: 600;
            margin-left: -1.2%;
        }
        .item{
            background-color: var(--tarheelOrange);
            border-radius: 10px;
        }
        .button{
            border-radius: 20px;
            border: none;
            color: var(--cream);
            background-color: var(--beige);
        }
        a{
            text-decoration: none;
        }
        input{
            padding: 2px 5px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar" style="background-color: #E4AD49;">
        <div class = "col d-flex justify-content-start ms-3 fs-6">
            @if (Auth::user()->role == 'penpos')
                <a href="{{ route('penpos.listPlayer', ['action' => 'BANK', 'id' => 'bank']) }}"
                    style="font-weight:bold;color:antiquewhite;">&lt;&lt; Bank</a>
            @endif
        </div>
        <div class = "col d-flex justify-content-center">
            <h1 class ="text-main">DEBT</h1>
        </div>
        <div class = "col d-flex justify-content-end me-3">
            
        </div>
    </nav>
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
    <div class="isi mx-5 mt-3">
        <h1 class="text">{{$player->username}}</h1>
        @foreach ($debtOption as $debt)
            <div class="row item text-white py-3 mb-4 px-3">
                <div class="col-md-10">
                    <h3>{{ $debt->point }}</h3>
                    <p>interest rate: {{ $debt->interest_rate }}%</p>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <a href="{{ route('penpos.debtByID', ['player' => $player->username, 'id'=>$debt->id]) }}" class="w-100 h-100">
                        <button class="w-100 h-100 py-1 button fs-5 fw-semibold">Debt</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>