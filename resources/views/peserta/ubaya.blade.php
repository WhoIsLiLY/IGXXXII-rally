<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css') }}/custom.css">
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
            margin: 1% 3% 2% 3%;
            background-color: var(--beige);
            font-family: 'Montserrat';
        }
        .pagination button.active {
            color: black;
            background-color: var(--tarheelOrange);
            color: white;
        }
        .pagination button:hover:not(.active) {
            background-color: var(--velvet);
            color: white;
            transform: scale(1.08);
        }
        .btn1{
            border: none;
            padding: 1%;
            background-color: var(--moca);
            border-radius: 10px;
        }
        h3{
            color: var(--velvet);
        }
        .judul{
            color: black;
            margin-top: 15px;
            font-weight: 600;
            font-size: 20px;
        }
        .baris{
            background-color: var(--kuningCoklat);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1 style="font-weight: 700; color: black;">UBAYA</h1>
    <h1 style="font-weight: 500; color: var(--velvet);">{{$player->username}}</h1>
    <div class="row">
        <h3 class="col-5">Point: {{$ubaya->point}}</h3>
        <h3 class="col-7 text-end">Inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h3>
    </div>

    <div class="row pagination d-flex" style="gap:20px; margin-left: 0.5%">
        <button id="active" class="col-3 active btn1" onclick="GantiActive(this)">Debt</button>
        <button onclick="GantiActive(this)" class="col-3 btn1">Commodity</button>
        <button onclick="GantiActive(this)" class="col-3 btn1">Product</button>
        {{-- <div>
            <input type="radio" name="data" id="debt" checked="true">
            <label for="debt">Debt</label>
        </div>
        <div>
            <input type="radio" name="data" id="commodity">
            <label for="commodity">Commodity</label>
        </div>
        <div>
            <input type="radio" name="data" id="product">
            <label for="product">Product</label>
        </div> --}}
    </div>

    <div id="debtList" class="list">
        <p class="judul">Debt List</p>
        <div class="rounded mx-5 p-3" style="overflow-y:scroll; height:500px; width:90%;">
            @foreach ($debts as $debt)
                <div class="row baris text-white py-3 mb-4" style=padding-left:20px;>
                    <div class="col-md-10">
                        <h3>{{ $debt->interest }}</h3>
                        <p>kenaikan tiap sesi: {{$debt->interest_rate}}%</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="commodityList" style="display:none;" class="list">
        <p class="judul">Commodity List</p>
        <div class="rounded mx-5 p-3" style="overflow-y:scroll; height:500px; width:90%;">
            @foreach ($playerCommodities as $comm)
                <div class="row baris text-white py-3 mb-4" style=padding-left:20px;>
                    <div class="col-md-10">
                        <h1>{{ $comm->name }}</h1>
                        @if($comm->amount)
                            <p>dimiliki: x{{ $comm->amount }}</p>
                        @else
                            <p>dimiliki: 0x</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="productList" style="display:none;" class="list">
        <p class="judul">Product List</p>
        @foreach ($playerProducts as $prod)
            <div class="row baris text-white py-3 mb-4" style=padding-left:20px;>
                <div class="col-md-10">
                    <h1>{{ $prod->name }}</h1>
                    @if($prod->amount)
                        <p>dimiliki: x{{ $prod->amount }}</p>
                    @else
                        <p>dimiliki: 0x</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        let nodeDebtList = document.getElementById('debtList');
        let nodeCommodityList = document.getElementById('commodityList');
        let nodeProductList = document.getElementById('productList');
        let classBaru = "col-3 btn1";
        let classActive = "active col-3 btn1";

        let GantiActive = e => {
            let nodeClassActive = document.getElementById('active');
            let idTerbaru = "";
            
            nodeClassActive.setAttribute("class", classBaru);
            nodeClassActive.setAttribute("id", idTerbaru);
            
            if(e.innerHTML == "Debt"){
                nodeDebtList.style.display = 'block';
                nodeCommodityList.style.display = 'none';
                nodeProductList.style.display = 'none';
            }else if(e.innerHTML == 'Commodity') {
                nodeDebtList.style.display = 'none';
                nodeCommodityList.style.display = 'block';
                nodeProductList.style.display = 'none';
            }else{
                nodeDebtList.style.display = 'none';
                nodeCommodityList.style.display = 'none';
                nodeProductList.style.display = 'block';
            }

            e.setAttribute("class", classActive);
            e.setAttribute("id", "active");
        }

        // document.querySelectorAll('input[name="data"]').forEach(function(radio) {
        //     radio.addEventListener('change', function() {
        //         document.getElementById('debtList').style.display = 'none';
        //         document.getElementById('commodityList').style.display = 'none';
        //         document.getElementById('productList').style.display = 'none';
    
        //         if (this.id === 'debt') {
        //             document.getElementById('debtList').style.display = 'block';
        //         } else if (this.id === 'commodity') {
        //             document.getElementById('commodityList').style.display = 'block';
        //         } else if (this.id === 'product') {
        //             document.getElementById('productList').style.display = 'block';
        //         }
        //     });
        // });
        // document.querySelector('input[name="data"]:checked').dispatchEvent(new Event('change'));
    </script>
</body>
</html>