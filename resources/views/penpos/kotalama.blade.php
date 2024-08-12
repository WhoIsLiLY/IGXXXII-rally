<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <h1>Penpos KOTALAMA</h1>
    <h3>daftar peserta</h3>
    @foreach($daftarPeserta as $peserta)
    <p>{{$peserta->username}}</p>
    @endforeach

    <h3>daftar kota</h3>
    @foreach($daftarKota as $kota)
    <p>{{$kota->name}}</p>
    @endforeach --}}

    <form action="{{ route('penpos.insert.maps') }}" method="POST">
        @csrf
        <label for="city_id">Select City:</label>
        <select name="city_id" id="city_id">
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    
        <label for="user_id">Select Player:</label>
        <select name="user_id" id="user_id">
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->username }}</option>
            @endforeach
        </select>
    
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>