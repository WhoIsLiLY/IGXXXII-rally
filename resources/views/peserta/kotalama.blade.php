<!DOCTYPE html>
<html>
<head>
    <title>Kotalama Data</title>
    <style>
        .city{
            width: 150px;
            height: 100px;
            background: blue;
            font-size: 20px;
            color: aliceblue;
            text-align: center;
        }

        .location{
            border: 3px solid red;
        }

        .choice{
            border: 3px solid yellow;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Kota Lama</h1>
    <h2>{{$player->username}}</h2>
    <p>
        Total Passengers: {{ $kotalama->total_passengers ?? 'N/A' }}
        <br>
        Total Duration: {{ $kotalama->total_duration ?? 'N/A' }}
        <br>
        Current Location: {{ $kotalama->location_id ?? 'N/A' }}
    </p>

    <p>
        Fuel: {{ $bus->fuel ?? 'N/A' }}
        <br>
        Passengers: {{ $bus->passenger ?? 'N/A' }}
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

    <script>
        let mapsData = @json($maps->pluck('city_id'));
        mapsData.forEach(function(cityId) {
            $("#" + cityId).css("background-color", "green");
        });

        let locationData = @json($kotalama->location_id);
        $("#" + locationData).addClass("location");

        let destinationList = @json($destinationList);
        destinationList.forEach(function(cityId) {
            $("#" + cityId).addClass("choice");
        });
    </script>
</body>
</html>