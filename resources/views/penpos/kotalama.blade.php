<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Penpos KOTALAMA</h1>
    <h3>daftar peserta</h3>
    @foreach($daftarPeserta as $peserta)
    <p>{{$peserta->username}}</p>
    @endforeach

    <h3>daftar kota</h3>
    @foreach($daftarKota as $kota)
    <p>{{$kota->name}}</p>
    @endforeach
</body>
</html>