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
    <style>
        .custom-list {
            list-style: none; /* Remove the default bullet points */
            padding-left: 0; /* Remove default padding */
        }
        </style>
    
    <a href="{{ route('penpos.listPlayer', ['action' => 'FACTORY', 'id' => 'productOption']) }}">&lt;&lt; Factory</a>

    <h1>{{$player->username}}</h1>
    <h2>player point: {{$ubaya->point}}</h2>
    <h2>player inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>
    @foreach ($productOption as $po)
        <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
            <div class="col-md-10">
                <h3>{{ $po->productName }}</h3>
                <div class="d-flex" style="justify-content: space-between;">
                    <div>
                        <p>commodity:</p>
                        <ul>
                            @foreach (explode(',', $po->commodityNames) as $commodityName)
                                <li>{{ $commodityName }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <p>owned:</p>
                        <ul class="custom-list">
                            @foreach (explode(',', $po->commodityID) as $commodityID)
                                <li>{{ $commodityID }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <p>Capacity   : {{ $po->capacity }}</p>
                <input type="number" class="amount my-3" min="1" value="1">
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
                <a class="commodityLink" href=
                "{{ route('penpos.production', ['player' => $player->username, 'productID' => $po->id, 'qcID' => 1]) }}">
                    create
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