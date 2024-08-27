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
</head>
<body>
    <h1>UBAYA</h1>
    <h1>{{$player->username}}</h1>
    <h3>point: {{$ubaya->point}}</h3>
    <h3>inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h3>

    <div class="d-flex" style="display:flex;gap:20px;">
        <button id="active" class="active" onclick="GantiActive(this)">Debt</button>
        <button onclick="GantiActive(this)">Commodity</button>
        <button onclick="GantiActive(this)">Product</button>
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

    <div id="debtList">
        <p>debt list</p>
        @foreach ($debts as $debt)
            <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
                <div class="col-md-10">
                    <h3>{{ $debt->interest }}</h3>
                    <p>kenaikan tiap sesi: {{$debt->interest_rate}}%</p>
                </div>
            </div>
        @endforeach
    </div>

    <div id="commodityList">
        <p>commodity list</p>
        @foreach ($playerCommodities as $comm)
            <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
                <div class="col-md-10">
                    <h1>{{ $comm->name }}</h1>
                    @if($comm->amount)
                        <p>dimiliki: x{{ $comm->amount }}</p>
                    @else
                        <p>dimiliki: x0</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div id="productList">
        <p>product list</p>
        @foreach ($playerProducts as $prod)
            <div class="row bg-secondary text-white py-3 mb-4" style=padding-left:20px;>
                <div class="col-md-10">
                    <h1>{{ $prod->name }}</h1>
                    @if($prod->amount)
                        <p>dimiliki: x{{ $prod->amount }}</p>
                    @else
                        <p>dimiliki: x0</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        let nodeDebtList = document.getElementById('debtList');
        let nodeCommodityList = document.getElementById('commodityList');
        let nodeProductList = document.getElementById('productList');
        let classBaru = "";
        let classActive = "active";

        let GantiActive = e => {
            let nodeClassActive = document.getElementById('active');
            let idTerbaru = nodeClassActive.innerHTML;
            
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