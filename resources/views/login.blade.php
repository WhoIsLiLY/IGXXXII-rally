<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.cdnfonts.com/css/antique-stories');
        @import url('https://db.onlinewebfonts.com/c/51365148ec9981c18941b8596e6f88f5?family=Pragmatica+Medium');

        .text-beige {
            color: #FEFAE1;
        }

        .text-main {
            font-family: "antique stories", sans-serif;
        }

        .text-text {
            font-family: 'Pragmatica Medium', sans-serif;
        }
    </style>
</head>

<body style = "background-color: #F6E3C7;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 text-beige p-5 rounded"
                style="background-color: #6B0001;">
                <h1 class="text-center mb-4 text-main">IG XXXII</h1>
                <form method="POST" action="{{ route('login') }}" class = "text-text">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-check mb-3">
                        <label for="showPassword">Show password</label>
                        <input type="checkbox" class="form-check-input" id = "btnShow">
                    </div>

                    <button type="submit" class="btn btn-primary w-100"
                        style = "background-color: #C47932;border-color:#C47932;">Submit</button>

                    @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $("#btnShow").click(function() {

            var passwordField = $("#password");
            var fieldType = passwordField.attr("type");

            if (fieldType == "password") {
                $("#password").attr("type", "text");
            } else if(fieldType = "text") {
                $("#password").attr("type", "password");
            }


        });
    </script>


</body>

</html>
