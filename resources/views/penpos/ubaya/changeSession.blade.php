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
        .text{
            color: var(--velvet);
            font-weight: 600;
        }
        .isi{
            font-family: 'Montserrat';
        }
        .item{
            background-color: var(--tarheelOrange);
            border-radius: 10px;
        }
        .peringatan {
            color: #60070D;
            font-weight: 700;
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
    </style>
</head>
<body>
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
        <h1 class="text">Ganti Sesi</h1>
        <h1 class="text">Current Session  : {{$session->current}}</h1>
        <div class="container-p w-100 p-4 item text-white fs-5 d-flex align-items-center justify-content-center">
            <p class="w-75"><span class="peringatan fs-4">Hati-hati!</span> mengganti sesi akan menyebabkan <b>kenaikan bunga hutang</b> setiap pemain dan <b>mengubah heritage</b>. jika salah dalam mengganti sesi akan mengakibatkan seluruh data error dan harus refresh database</p>
            <a href="{{ route('penpos.changeSessionUbayaHandle',['session'=>$session->current]) }}" class="w-25 h-100 d-flex align-items-center justify-content-center">
                <button class="w-75 h-100 py-3 button fs-5 fw-semibold">SESI BERIKUTNYA</button>
            </a>
        </div>
    </div>
</body>
</html>