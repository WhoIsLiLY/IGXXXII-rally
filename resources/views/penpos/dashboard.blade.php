<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penpos Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>

    <div>
        <a href="{{ route("tupal") }}">
            <button type="button">Tugu Pahlawan</button>
        </a>

        <a href="{{ route('penpos.kotalama') }}">
            <button type="button">Kota Lama</button>
        </a>

        <a href="{{ route('ubaya') }}">
            <button type="button">Ubaya</button>
        </a>
    </div>
</body>
</html>