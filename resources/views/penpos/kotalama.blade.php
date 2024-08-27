<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kota Lama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css') }}/custom.css">
    <style>
        .text-text {
            font-family: 'Pragmatica Medium', sans-serif;
        }
    </style>
</head>
<body style = "background-color: #FFF9E1; ">
    {{-- <h1>Penpos KOTALAMA</h1>
    <h3>daftar peserta</h3>
    @foreach($daftarPeserta as $peserta)
    <p>{{$peserta->username}}</p>
    @endforeach

    <h3>daftar kota</h3>
    @foreach($daftarKota as $kota)
    <p>{{$kota->name}}</p>
    @endforeach --}}

    {{-- <form action="{{ route('penpos.insert.maps') }}" method="POST">
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
    </form> --}}
    <div class = "container d-flex justify-content-center align-items-center " style ="height: 80vh;">
        <div class="col text-center">
            <h1 class ="text-main">PENPOS KOTA LAMA</h1>
            <form id="penposForm" action="{{ route('penpos.insert.maps') }}" method="POST" onsubmit="submitForm(event)" >
                @csrf

                <label for="city_id">Select City:</label>
                <select name="city_id" id="city_id" onclick="populateCities()">
                    <option value="" disabled selected>Select a City</option>
                </select>
                <br>
                <br>
                <label for="user_id">Select Player:</label>
                <select name="user_id" id="user_id" onclick="populatePlayers()">
                    <option value="" disabled selected>Select a Player</option>
                </select>
                <br>
                <br>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="confirmationMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="refreshPage()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        const cities = @json($cities);
        const players = @json($players);

        function populateCities() {
            const citySelect = document.getElementById('city_id');
            if (citySelect.options.length <= 1) {
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        }

        function populatePlayers() {
            const playerSelect = document.getElementById('user_id');
            if (playerSelect.options.length <= 1) {
                players.forEach(player => {
                    const option = document.createElement('option');
                    option.value = player.id;
                    option.textContent = player.username;
                    playerSelect.appendChild(option);
                });
            }
        }

        function submitForm(event) {
            event.preventDefault();

            const form = document.getElementById('penposForm');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                const messageElement = document.getElementById('confirmationMessage');
                messageElement.textContent = data.message;

                const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function refreshPage() {
            window.location.reload();
        }
    </script>
    
</body>
</html>