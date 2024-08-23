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
        .disabled{
            color: red;
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
            <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded normal">
                <a class="commodityLink p-3" href=
                "{{ route('penpos.production', ['player' => $player->username, 'productID' => $po->id, 'qcID' => 0, 'amount'=>1]) }}"
                data-template=
                "{{ route('penpos.production', ['player' => $player->username, 'productID' => '__ID__', 'qcID' => 0, 'amount'=>'__AMOUNT__']) }}">
                    create
                </a>
            </div>
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
</x-layout>