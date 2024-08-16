<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield("title")</title>
    <style>
        @import url('https://fonts.cdnfonts.com/css/antique-stories');
        @import url('https://db.onlinewebfonts.com/c/51365148ec9981c18941b8596e6f88f5?family=Pragmatica+Medium');

        .text-main {
            font-family: "antique stories", sans-serif;
            color: #6B0001;
            font-size: 55px;
        }

        .text-text {
            font-family: 'Pragmatica Medium', sans-serif;
            color: #6B0001;
            font-size: 30px;
        }
    </style>
</head>

<body style = "background-color:#FFF9E1; ">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row-100">
            <div class="col d-flex justify-content-center text-main">
                Industrial Games
            </div>
            <div class="col-4 d-flex offset-4 mt-4">
                <img src="{{ asset('img') }}/Emote berpikir.svg" alt="" class = "img-fluid" draggable="false">
            </div>
            <div class="col d-flex justify-content-center mt-3 text-text">
                @yield("error")
            </div>
        </div>
    </div>

</body>

</html>
