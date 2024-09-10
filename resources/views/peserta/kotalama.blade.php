<x-layout>
    <x-slot:title>
        Kota Lama
    </x-slot:title>

    {{--    <?php
    echo '<pre>';
    print $player;
    echo '<br>';
    echo '</pre>';
    ?>
 --}}
    <!-- NAVBAR - Scan Button and Logout -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-main" href="#" style = "font-size:40px;">Industrial Games</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        
        .location{
            border: 3px solid red;
        }

        .choice{
            border: 3px solid yellow;
        }
        .container-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .box {
            background-color: #E4AD49;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            margin-bottom: 15px;
            width: 100%;
        }
        @media (min-width: 768px) {
            .box {
                width: 30%;
            }
        }
        .box p {
            margin: 0;
            font-size: 14px; /* Ukuran teks untuk label */
        }

        .number {
            display: block;
            font-size: 36px;
            font-weight: bold;
            color: white;
            margin-top: 10px;
        }
        img{
            width: 150% ;
        }
        .map-container {
        position: relative;
        }

        .city-map {
            width: 100%;
            height: auto;
        }

        
        .city{
            width: 200px;
            height: 160px;
            font-size: 20px;
            text-align: center;
            position: absolute;
            color: white;
            padding: 10px;
            border-radius: 8px;
            z-index: 10; 
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div >
    <div class="container mt-4" >
        <div class="row  py-2 mb-2 col-6 " >
            <h1>{{$player->username}}</h1>
        </div>

        <div class="container-box d-flex justify-content-between">
            <div class="box">
                <p><b>Passengers in Bus:</b> <span class="number">{{ $bus->passenger ?? 'N/A' }}</span></p>
            </div>
            <div class="box">
                <p><b>Kotalama Passengers:</b> <span class="number">{{ $kotalama->total_passengers ?? '000' }}</span></p>
            </div>
            <div class="box">
                <p><b>Total Duration:</b> <span class="number">{{ $kotalama->total_duration ?? 'N/A' }}</span></p>
            </div>
            <div class="box">
                <p><b>Current Location:</b> <span class="number">{{ $cities[$kotalama->location_id]->name }}</span></p>
            </div>
            <div class="box">
                <p><b>Remaining Fuel:</b> <span class="number">{{ $bus->fuel ?? 'N/A' }}</span></p>
            </div>
        </div>
        <div class="container text-center">
  
</div>
    </div>
    <div class="container d-flex justify-content-center mt-4 ">
        <div class="map-container">
            <img src="{{ asset('img/kotaLama/Map Besar.png')}}" class="city-map">
            <div class="city" id="1" style="top: 150px; left: 250px;"></div>
            <div class="city"id="2" style="top: 70px; left: 650px;"></div>
            <div class="city" id="3"style="top: 450px; left: 520px;"> </div>
            <div class="city" id="4"style="top: 365px; left: 780px;"></div>
            <div class="city"id="5" style="top: 310px; left: 190px;"></div>
            <div class="city" id="6"style="top: 500px; left: 200px;"></div>
            <div class="city" id="7"style="top: 150px; left: 870px;"></div>
            <div class="city" id="8"style="top: 250px; left: 480px;"></div>
            <div class="city" id="9"style="top: 550px; left: 950px;"></div>
        </div>    
    </div>
    <div class="container d-flex justify-content-center mt-4">
        <form action=""method="POST" class="d-inline">
            @csrf
            <button class="rounded btn btn-primary mb-4 " style="font-size:20px; padding:20px; width: 250px;">Restart</button>
            <button class="rounded btn btn-primary mb-4" style="font-size:20px; padding:20px; width:250px">Save</button>
        </form>               
    </div>

    <!-- Modal -->
    <div class="modal fade" id="moveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Move City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmMove">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>    


    

    <script>
        let mapsData = @json($maps->pluck('city_id'));
        let allCityIds = [1, 2, 3, 4, 5, 6, 7, 8, 9]; 
        console.log("City IDs that are in mapsData:", mapsData);
        // Loop melalui semua ID kota dari 1-9
        allCityIds.forEach(function(cityId) {
            if (!mapsData.includes(cityId)) {
                $("#" + cityId).css("background-color", "#FEFAE1");
                $("#" + cityId).css("border", "3px solid blue");
            } 
            else{
                $("#" + cityId).css("background-color", "");
                $("#" + cityId).css("border", "3px solid yellow");
            }
        });
    
        let locationData = @json($kotalama->location_id);
        $("#" + locationData).css("border", "3px solid red");;
        
        let destinationList = @json($destinationList);
        destinationList.forEach(function(cityId) {
            $("#" + cityId).addClass("choice").on('click', function() {
                let cityName = $("#" + cityId).text();
                $('#modalMessage').text('Do you want to move to city ' + cityName + '?');
                $('#moveModal').modal('show');
                $('#confirmMove').off('click').on('click', function() {
                    $.ajax({
                        url: '{{ route("peserta.move.city") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            city_id: cityId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#fuel').text(response.remainingFuel);
                                $('#busPassengers').text(response.newPassengerCount);
                                $('#totalPassengers').text(response.totalPassengers);
                                $('#totalDuration').text(response.totalDuration);
                                $('#moveModal').modal('hide');
                                location.reload();
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</x-layout>
