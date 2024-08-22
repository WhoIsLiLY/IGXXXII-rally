<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css') }}/custom.css">
    <title>Dashboard</title>
</head>

<body style = "background-color: #FFF9E1;">
    <div class = "d-flex justify-content-end text-secondary">
        <form action="{{ route('logout') }}" method = "POST">
            @csrf
            <button class = "btn btn-primary m-4">Logout</button>
        </form>
    </div>
    <div class="container d-flex justify-content-center align-items-center" style ="height: 80vh;">
        <div class="row">
            <div class="col text-center">
                <h1 class ="text-main">Welcome to the Dashboard</h1>
                <div>
                    <div class = "text-secondary ml-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tugu Pahlawan
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'BUY LOKET', 'id' => 'buyLoket']) }}">Buy
                                        Loket</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'UPGRADE LOKET', 'id' => 'upgradeLoket']) }}">Upgrade
                                        Loket</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'BUY STAND', 'id' => 'buyStand']) }}">Buy
                                        Stand</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'BUY AD', 'id' => 'buyAd']) }}">Buy
                                        Ad</a></li>
                                <li><a class="dropdown-item" href="{{ route('penpos.changeSession') }}">Change Session</a>
                                </li>
                            </ul>
                        </div>


                        <button type="button" class = "btn btn-primary"
                            onclick="window.location.href='{{ route('penpos.kotalama') }}'">Kota Lama</button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                UBAYA
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'BANK', 'id' => 'bank']) }}">Bank</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'COMMODITY', 'id' => 'commodityOption']) }}">Commodity</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'FACTORY', 'id' => 'productOption']) }}">Factory</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('penpos.listPlayer', ['action' => 'HERITAGE', 'id' => 'heritageOption']) }}">Heritage</a></li>
                                <li><a class="dropdown-item"
                                    href="{{ route('penpos.listPlayer', ['action' => 'INVENTORY', 'id' => 'inventory']) }}">Inventory</a></li>
                                <li><a class="dropdown-item" href="{{ route('penpos.changeSessionUbaya') }}">Change Session UBAYA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>
