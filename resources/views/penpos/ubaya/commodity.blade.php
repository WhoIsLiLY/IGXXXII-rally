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
                <a href="{{ route('penpos.listPlayer', ['action' => 'COMMODITY', 'id' => 'commodityOption']) }}"
                    style="font-weight:bold;color:antiquewhite;">&lt;&lt; Commodity</a>
            @endif
        </div>
        <div class = "col d-flex justify-content-center">
            <h1 class ="text-main">COMMODITY</h1>
        </div>
        <div class = "col d-flex justify-content-end me-3">
            
        </div>
    </nav>

    <div class="isi mx-5 mt-3">
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
        
        <h1 class="text">{{$player->username}}</h1>
        <h2 class="text">Player Point: {{$ubaya->point}}</h2>
        <h2 class="text">Player Inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>
        @foreach ($commodityOption as $comm)
        <div class="row item text-white py-3 mb-4 " style="padding:10px;">
            <div class="col-md-10">
                <h3>{{ $comm->name }}</h3>
                <p>Minimum buy: {{ $comm->min_buy }}</p>
                <p>Capacity   : {{ $comm->capacity }}</p>
                <input type="number" class="amount my-3" min="{{ $comm->min_buy }}" value="{{ $comm->min_buy }}" data-price="{{ $comm->price }}" data-id="{{$comm->id}}">
            </div>
            <a class="col-md-2 d-flex align-items-center justify-content-center commodityLink" href="{{ route('penpos.commodityByID', ['player' => $player->username, 'id' => $comm->id, 'amount' => $comm->min_buy]) }}" 
                data-template="{{ route('penpos.commodityByID', ['player' => $player->username, 'id' => '__ID__', 'amount' => '__AMOUNT__']) }}">
                <button class="w-100 h-100 py-1 button fs-5 fw-semibold"> {{ $comm->price * $comm->min_buy }}</button>
            </a> 
        </div>
        @endforeach
    </div>

    <script>
        document.querySelectorAll('.amount').forEach(function(input) {
            input.addEventListener('input', function() {
                var amount = input.value;
                var commodityId = input.getAttribute('data-id');
                var price = input.getAttribute('data-price');

                var link = input.closest('.row').querySelector('.commodityLink');
                var templateUrl = link.getAttribute('data-template');
                var finalUrl = templateUrl.replace('__ID__', commodityId).replace('__AMOUNT__', amount);

                link.setAttribute('href', finalUrl);
                link.textContent = price * amount;
            });
        });
    </script>
</body>
</html>