<x-layout>
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
    
    <a href="{{ route('penpos.listPlayer', ['action' => 'FACTORY', 'id' => 'productOption']) }}">&lt;&lt; Factory</a>

    <h1>{{$player->username}}</h1>
    <h2>player point: {{$ubaya->point}}</h2>
    <h2>player inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>
    @foreach ($productOption as $comm)
    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>{{ $comm->name }}</h3>
            <p>Capacity   : {{ $comm->capacity }}</p>
            <input type="number" class="amount my-3" min="1" value="1" data-id="{{$comm->id}}">
        </div>
        <div>
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                <a class="commodityLink" href="{{ route('penpos.commodityByID', ['player' => $player->username, 'id' => $comm->id, 'amount' => 0]) }}">
                    create
                </a>
            </div>
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