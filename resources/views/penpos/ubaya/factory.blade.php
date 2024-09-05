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
        .custom-list {
            list-style: none; /* Remove the default bullet points */
            padding-left: 0; /* Remove default padding */
        }
        .disabled{
            color: red;
        }
        .isi{
            margin: 1% 3% 2% 3%;
            font-family: 'Montserrat';
        }
        .text{
            color: var(--velvet);
            font-weight: 600;
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
                <a href="{{ route('penpos.listPlayer', ['action' => 'FACTORY', 'id' => 'productOption']) }}"
                    style="font-weight:bold;color:antiquewhite;">&lt;&lt; Factory</a>
            @endif
        </div>
        <div class = "col d-flex justify-content-center">
            <h1 class ="text-main">FACTORY</h1>
        </div>
        <div class = "col d-flex justify-content-end me-3">
          
        </div>
    </nav>
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

    <div class="isi">
        <h1 class="text">{{$player->username}}</h1>
        <h2 class="text">Player Point: {{$ubaya->point}}</h2>
        <h2 class='text'>Player Inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>
        @foreach ($productOption as $po)
            <div class="item row text-white py-3 mb-4" style="padding:20px; margin:20px 0;">
                <div class="col-md-10">
                    <h3>{{ $po->productName }}</h3>
                    <div class="d-flex" style="justify-content: space-between;">
                        <div>
                            <p>component:</p>
                            <ul>
                                @foreach (explode(',', $po->commodityNames) as $commodityName)
                                    <li>1 {{ $commodityName }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <p>owned:</p>
                            <ul class="custom-list">
                                @foreach (explode(',', $po->commodityAmounts) as $commodityAmount)
                                    <li>{{ $commodityAmount }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <p>Capacity   : {{ $po->capacity }}</p>
                    <input type="number" class="amount my-3" min="1" value="1" data-id="{{$po->id}}">
                </div>
                <a class="commodityLink col-md-2 d-flex align-items-center justify-content-center" href= "{{ route('penpos.production', ['player' => $player->username, 'productID' => $po->id, 'qcID' => 0, 'amount'=>1]) }}" data-template= "{{ route('penpos.production', ['player' => $player->username, 'productID' => '__ID__', 'qcID' => 0, 'amount'=>'__AMOUNT__']) }}">
                    <button class="commodityLink button py-1 h-100 w-100 fs-5 fw-semibold">Create</button>
                </a>
                <div class="d-none qc" style="justify-content: space-between">
                    <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                        <a class="qcLink py-2 px-4" 
                        data-template=
                        "{{ route('penpos.production', ['player' => $player->username, 'productID' => '__ID__', 'qcID' => 1, 'amount'=>'__AMOUNT__']) }}">
                            QC 1: 800 poin
                        </a>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                        <a class="qcLink py-2 px-4"
                        data-template=
                        "{{ route('penpos.production', ['player' => $player->username, 'productID' => '__ID__', 'qcID' => 2, 'amount'=>'__AMOUNT__']) }}">
                            QC 2: 1000 poin
                        </a>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                        <a class="qcLink py-2 px-4"
                        data-template=
                        "{{ route('penpos.production', ['player' => $player->username, 'productID' => '__ID__', 'qcID' => 3, 'amount'=>'__AMOUNT__']) }}">
                            QC 3: 1500 poin
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        document.querySelectorAll('.amount').forEach(function(input) {
            input.addEventListener('input', function() {
                var amount = input.value;
                var commodityAmounts = input.getAttribute('data-id');

                var normalLink = input.closest('.row').querySelector('.normal');
                var qcContainer = input.closest('.row').querySelector('.qc');

                var templateUrl = normalLink.querySelector('a').getAttribute('data-template');
                var finalUrl = templateUrl.replace('__ID__', commodityAmounts).replace('__AMOUNT__', amount);

                normalLink.querySelector('a').setAttribute('href', finalUrl);
                qcContainer.querySelectorAll('a').forEach(function(qcLink) {
                    var qcTemplateUrl = qcLink.getAttribute('data-template');
                    var qcFinalUrl = qcTemplateUrl.replace('__ID__', commodityAmounts).replace('__AMOUNT__', amount);
                    qcLink.setAttribute('href', qcFinalUrl);
                });

                if (amount >= 5) {
                    normalLink.classList.add('d-none');
                    normalLink.classList.remove('d-flex');

                    qcContainer.classList.remove('d-none');
                    qcContainer.classList.add('d-flex');
                } else {
                    normalLink.classList.remove('d-none');
                    normalLink.classList.add('d-flex');

                    qcContainer.classList.add('d-none');
                    qcContainer.classList.remove('d-flex');
                }
            });
        });
    </script>
</body>
</html>