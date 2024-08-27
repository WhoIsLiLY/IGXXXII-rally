<!DOCTYPE html>
<html>
<head>
    <title>Kotalama Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .city {
            width: 150px;
            height: 100px;
            background: blue;
            font-size: 20px;
            color: aliceblue;
            text-align: center;
            cursor: pointer;
        }

        .location {
            border: 3px solid red;
        }

        .choice {
            border: 3px solid yellow;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Kota Lama</h1>
    <h2>{{ $player->username }}</h2>
    <p>
        Total Passengers: <span id="totalPassengers">{{ $kotalama->total_passengers ?? 'N/A' }}</span>
        <br>
        Total Duration: <span id="totalDuration">{{ $kotalama->total_duration ?? 'N/A' }}</span>
        <br>
        Current Location: {{ $currentCityName ?? 'N/A' }}
    </p>

    <p>
        Fuel: <span id="fuel">{{ $bus->fuel ?? 'N/A' }}</span>
        <br>
        {{-- Passengers: <span id="busPassengers">{{ $bus->passenger ?? 'N/A' }}</span> --}}
    </p>

    <table>
        <tr>
            <td></td>
            <td class="city" id="2">B</td>
            <td class="city" id="7">G</td>
            <td></td>
        </tr>
        <tr>
            <td class="city" id="1">A</td>
            <td class="city" id="8">Pom Bensin</td>
            <td class="city" id="4">D</td>
            <td class="city" id="9">Kota Lama</td>
        </tr>
        <tr>
            <td></td>
            <td class="city" id="5">E</td>
            <td class="city" id="3">C</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="city" id="6">F</td>
            <td></td>
        </tr>
    </table>

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

    <script>
        let mapsData = @json($maps->pluck('city_id'));
        mapsData.forEach(function(cityId) {
            $("#" + cityId).css("background-color", "green");
        });
    
        let locationData = @json($kotalama->location_id);
        $("#" + locationData).addClass("location");
    
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
</body>
</html>
