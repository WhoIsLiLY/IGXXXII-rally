<!DOCTYPE html>
<html>
<head>
    <title>Kotalama Data</title>
</head>
<body>
    <h1>Kota Lama</h1>
    <h2>{{$player->username}}</h2>
    <p>
        Total Passengers: {{ $kotalama->total_passengers ?? 'N/A' }}
        <br>
        Total Duration: {{ $kotalama->total_duration ?? 'N/A' }}
    </p>

    <p>
        Fuel: {{ $bus->fuel ?? 'N/A' }}
        <br>
        Passengers: {{ $bus->passenger ?? 'N/A' }}
    </p>

    <p>map list:</p>
    <ul>
        @foreach($maps as $map)
            <li>{{$map->city_id ?? 'no map unlocked'}}</li>
        @endforeach
    </ul>
</body>
</html>