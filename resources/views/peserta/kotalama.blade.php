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
    <!-- NAVBAR and Logout -->
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
        /* .container-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        } */

        .box {
            background-color: #E4AD49;
            padding: 16px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            margin-bottom: 10px;
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
            width: 150px;
            height: 120px;
            font-size: 20px;
            text-align: center;
            position: absolute;
            color: white;
            padding: 10px;
            border-radius: 8px;
            z-index: 10; 
        }

        .pointer {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 100px solid #007bff;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div >
    <div class="container mt-4">
        <div class="row  py-2 mb-2 col-6 " >
            <h1>{{$player->username}}</h1>
        </div>
        <div class="d-flex w-100" style="justify-content: space-between;">
            <div class="w-24 h-100">
                <div class="box" style="width: 100%;">
                    <p><b>Current Location:</b> <span class="number">{{ $cities[$kotalama->location_id]->name }}</span></p>
                </div>
                <div class="box" style="width: 100%;">
                    <p><b>Remaining Fuel:</b> <span class="number">{{ $bus->fuel ?? 'N/A' }}</span></p>
                </div>
                <div class="box" style="width: 100%;">
                    <p><b>Passengers in Bus:</b> <span class="number">{{ $bus->passenger ?? 'N/A' }}</span></p>
                </div>
                <div class="box" style="width: 100%;">
                    <p><b>Kotalama Passengers:</b> <span class="number">{{ $kotalama->total_passengers ?? '000' }}</span></p>
                </div>
                <div class="box" style="width: 100%;">
                    <p><b>Total Duration:</b> <span class="number">{{ $kotalama->total_duration ?? 'N/A' }}</span></p>
                </div>
            </div>
            <div class="map-container" style="width: 85%; margin-top:-5%; position:relative;">
                <img src="{{ asset('img/kotaLama/map revisi.png')}}" class="city-map">
                <div class="city" id="1" style="top: 90px; left: 180px"></div>
                <div class="city" id="2" style="top: 55px; left: 585px"></div>
                <div class="city" id="3" style="top: 400px; left: 460px;"></div>
                <div class="city" id="4" style="top: 320px; left: 670px;"></div>
                <div class="city" id="5" style="top: 260px; left: 163px;"></div>
                <div class="city" id="6" style="top: 440px; left: 170px;"></div>
                <div class="city" id="7" style="top: 140px; left: 750px;"></div>
                <div class="city" id="8" style="top: 185px; left: 405PX;"></div>
                <div class="city" id="9" style="top: 480px; left: 830px;"></div>
                <form id="kotaLamaForm" class="d-flex w-100 mt-3" style="justify-content: center;">
                    @csrf
                    <!-- Tombol Restart -->
                    <button type="button" id="restartButton" class="rounded btn btn-primary" style="font-size:20px; padding:10px; width:200px; margin:0 20px;">Restart</button>
                    
                    <!-- Tombol Save -->
                    <button type="button" id="saveButton" class="rounded btn btn-primary" style="font-size:20px; padding:10px; width:200px; margin:0 20px;">Save</button>
                </form>
            </div>
        </div>
    </div>

        <!-- peta versi 1 -->
        {{-- </div>
        <div class="container d-flex justify-content-center mt-4 ">
            <div class="map-container">
                <img src="{{ asset('img/kotaLama/MapBesarPolos.png')}}" class="city-map">
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
        </div> --}}

        <!-- Modal -->
        <div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moveModalLabel">Move City</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="modalMessage">Are you sure you want to move to this city?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="confirmMove">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>

       /* let mapsData = @json($maps->pluck('city_id'));
        let allCityIds = [1, 2, 3, 4, 5, 6, 7, 8, 9]; 
        allCityIds.forEach(function(cityId) {
            if (!mapsData.includes(cityId)) {
                $("#" + cityId).css("background-color", "#FEFAE1");
                 $("#" + cityId).css("border", "2px solid black");
             } 
             else{
                
                $("#" + cityId).css("background-color", "");
                $("#" + cityId).css("border", "3px solid yellow");
             }
         });*/

         let mapsData = @json($maps->pluck('city_id'));
         let allCityIds = ["1", "2", "3", "4", "5","6", "7", "8", "9"];

        allCityIds.forEach(function(cityId) {
            if (mapsData.includes(cityId)) {
                // Jika ada yang cocok, ubah background color menjadi default (atau sesuai kebutuhan)
                $("#" + cityId).css("background-color", "");
            } else {
                $("#" + cityId).css("background-color", "#FEFAE1"); 
                $("#" + cityId).css("border", "2px solid black");

            }
        });


        let locationData = @json($kotalama->location_id);
        $("#" + locationData).addClass("location");
    
        let destinationList = @json($destinationList);

        destinationList.forEach(function(cityId) {
            $("#" + cityId).addClass("choice").on('click', function() {
                let cityName = $("#" + cityId).text();
                $('#modalMessage').text('Do you want to move to ' + cityName + '?');
                // $('#modalMessage').text("*if close button doesn't work, click anywhere outside of the box");
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
        $(document).ready(function() {
        // Aksi untuk tombol Restart
        $('#restartButton').click(function() {
            $.ajax({
                url: '{{ route('peserta.restart') }}', // route untuk restart
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // token CSRF Laravel
                },
                success: function(response) {
                    alert(response.message); // menampilkan pesan sukses
                    location.reload(); // refresh halaman
                },
                error: function(xhr) {
                    // Jika terjadi error, tangkap pesan error dari responseJSON
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        alert(xhr.responseJSON.message); // Tampilkan pesan error dari server
                    } else {
                        alert('An unknown error occurred.'); // Error umum jika tidak ada pesan khusus
                    }
                }
            });
        });

        // Aksi untuk tombol Save
        $('#saveButton').click(function() {
            $.ajax({
                url: '{{ route('peserta.save.score') }}', // route untuk save score
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // token CSRF Laravel
                },
                success: function(response) {
                    alert(response.finalScore); // menampilkan skor yang disimpan
                    location.reload(); // refresh halaman
                },
                error: function(response) {
                    alert('Error: ' + response.message); // jika terjadi error
                }
            });
        });
    });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-layout>
