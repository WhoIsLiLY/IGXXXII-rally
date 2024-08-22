<x-layout>
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
    
    <a href="{{ route('penpos.listPlayer', ['action' => 'COMMODITY', 'id' => 'commodityOption']) }}">&lt;&lt; Commodity</a>

    <h1>{{$player->username}}</h1>
    <h2>player point: {{$ubaya->point}}</h2>
    <h2>player inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>
    @foreach ($commodityOption as $comm)
    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>{{ $comm->name }}</h3>
            <p>Minimum buy: {{ $comm->min_buy }}</p>
            <p>Capacity   : {{ $comm->capacity }}</p>
            <input type="number" class="amount my-3" min="{{ $comm->min_buy }}" value="{{ $comm->min_buy }}" data-price="{{ $comm->price }}" data-id="{{$comm->id}}">
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a class="commodityLink" href="{{ route('penpos.commodityByID', ['player' => $player->username, 'id' => $comm->id, 'amount' => $comm->min_buy]) }}" 
               data-template="{{ route('penpos.commodityByID', ['player' => $player->username, 'id' => '__ID__', 'amount' => '__AMOUNT__']) }}">
                {{ $comm->price * $comm->min_buy }}
            </a>
        </div>
    </div>
    @endforeach

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
</x-layout>
