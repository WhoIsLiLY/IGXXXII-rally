<x-layout>
    <x-slot:title>
        Tugu Pahlawan
    </x-slot:title>

    {{--    <?php
    echo '<pre>';
    print $player;
    echo '<br>';
    echo '</pre>';
    ?>
 --}}
    <!-- NAVBAR - Scan Button and Logout -->
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
                        <button class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#scanModal">Scan</button>
                    </li>
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

    <!-- Scan Modal -->
    <!--<div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('peserta.question.check') }}" method="POST">
                        @csrf
                        <label for="question_id">Masukkan ID Pertanyaan:</label>
                        <input type="number" name="question_id" min="1" max="70" required>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Scan Modal -->
    <form action="{{ route('peserta.question.check') }}" method="POST" id="barcodeForm">
        @csrf
        <input type="hidden" name="question_id" value="">
    </form>
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content modal-color">
                <div class="modal-header">
                    <h5 class="modal-title text-white text-main" id="scanModalLabel">Scan Barcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="stopCamera()"></button>
                </div>
                <div class="modal-body">
                    <div class="video-container">
                        <video id="video" class="w-100"></video>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="stopCamera()">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Question Modals -->
    @if (session()->has('questionStatus'))
        @if (session('questionStatus') == true)
            <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel"
                aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modal-color">
                        <div class="modal-header">
                            <h5 class="modal-title text-white text-main" id="questionModalLabel">Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ session('questionMessage')->question }}</h4>
                                </div>
                                <div class="card-body">
                                    @if (session('questionMessage')->img_name)
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('img/soalTuguPahlawan/' . session('questionMessage')->img_name) }}"
                                                alt="Question Image" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    <form action="{{ route('peserta.answer.check') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="question_id"
                                            value="{{ session('questionMessage')->id }}">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerA" name="answer"
                                                    class="custom-control-input" value="a" required>
                                                <label class="custom-control-label"
                                                    for="answerA">{{ session('questionMessage')->a }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerB" name="answer"
                                                    class="custom-control-input" value="b" required>
                                                <label class="custom-control-label"
                                                    for="answerB">{{ session('questionMessage')->b }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerC" name="answer"
                                                    class="custom-control-input" value="c" required>
                                                <label class="custom-control-label"
                                                    for="answerC">{{ session('questionMessage')->c }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerD" name="answer"
                                                    class="custom-control-input" value="d" required>
                                                <label class="custom-control-label"
                                                    for="answerD">{{ session('questionMessage')->d }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerE" name="answer"
                                                    class="custom-control-input" value="e" required>
                                                <label class="custom-control-label"
                                                    for="answerE">{{ session('questionMessage')->e }}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-secondary">Submit Answer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('questionModal'));
                    myModal.show();
                });
            </script>
        @else
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "{{ session('questionStatus') ? 'Success' : 'Failed' }}",
                        text: "{{ session('questionMessage') }}",
                        icon: "{{ session('questionStatus') ? 'success' : 'error' }}",
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif
    @endif


    <!-- SweetAlert for Answer Status -->
    @if (session()->has('answerStatus'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('answerStatus') == 1 ? 'Success' : 'Failed' }}",
                    text: "{{ session('answerMessage') }}",
                    icon: "{{ session('answerStatus') == 1 ? 'success' : 'error' }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="container mt-5">
        <!-- Header Section -->
        <div class="row text-white py-3 mb-4 rounded-div div-color text-text">
            <div class="col-6">
                <div>
                    <h3>{{ $player->username }}</h3>
                    <p>Jumlah poin : {{ $player->tupals->point }}</p>
                </div>
            </div>
            <div class="col-6 text-end">
                @php
                    $totalServiceTime = 0;
                    foreach ($player->lokets as $loket) {
                        $totalServiceTime += 30 / $loket->service_time ?? 0;
                    }
                @endphp
                @php
                    $totalCustomer = 0;
                    foreach ($player->playersStandsAds as $standAd) {
                        $totalCustomer += $standAd->probability * $standAd->amount;
                    }
                @endphp
                <p>Total Service Time: {{ $totalServiceTime }}</p>
                <p>Pelanggan datang: {{ $totalCustomer }}</p>
            </div>
        </div>

        <!-- Loket,Stand,Ads Section -->
        <div class="row text-white mb-4" data-bs-toggle="modal" data-bs-target="#modalLokets">
            <div class="col rounded-div div-color me-2">
                <div class="p-3 text-white text-center  text-main" style = "font-size:25px;">
                    Loket
                </div>
            </div>
            <div class="col rounded-div div-color me-2" data-bs-toggle="modal" data-bs-target="#modalStands">
                <div class="p-3 text-white text-center  text-main" style = "font-size:25px;">
                    Stand
                </div>
            </div>
            <div class="col rounded-div rounded-div div-color" data-bs-toggle="modal" data-bs-target="#modalAds">
                <div class="p-3 text-white text-center text-main" style = "font-size:25px;">
                    Ads
                </div>
            </div>
        </div>

    </div>
    </div>

    <!-- Loket Modal -->
    <div class="modal fade" id="modalLokets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-color">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white text-main" id="exampleModalLabel">Loket details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-text">
                    <div class = "p-2 rounded-div mb-4" style="background-color: #FFF9E1;">
                        @foreach ($player->lokets as $loket)
                            Loket - {{ $loket->id . ' Service time: ' . $loket->service_time }}
                            <div class = "d-flex justify-content-center">
                                <hr style="width:95%; height:3px;background-color:white;">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Stand Modal -->
    <div class="modal fade" id="modalStands" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-color">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white text-main" id="exampleModalLabel">Stand details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-text">
                    <div class = "p-2 rounded-div mb-4" style="background-color: #FFF9E1">
                        @foreach ($player->playersStandsAds as $indexStand => $playerStandAd)
                            @if ($playerStandAd->standAd->type == 'Stand')
                                <div>
                                    Stand -
                                    {{ $playerStandAd->standAd->name . ' Probability: ' . $playerStandAd->standAd->probability }}
                                </div>
                                <div>
                                    dimiliki - {{ $playerStandAd->amount }}
                                </div>
                                <div class = "d-flex
                        justify-content-center">
                                    <hr style="width:95%; height:3px;background-color:white;">
                                </div>
                            @endif
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </div>
    <!-- Ads Modal -->
    <div class="modal fade" id="modalAds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-color">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white text-main" id="exampleModalLabel">Ad details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-text">
                    <div class = "p-2 rounded-div mb-4" style="background-color: #FFF9E1;">
                        @foreach ($player->playersStandsAds as $playerStandAd)
                            @if ($playerStandAd->standAd->type == 'Ad')
                                Stand -
                                {{ $playerStandAd->standAd->name . ' Probability: ' . $playerStandAd->standAd->probability }}
                                <div>
                                    dimiliki - {{ $playerStandAd->amount }}
                                </div>
                                <div class = "d-flex justify-content-center">
                                    <hr style="width:95%; height:3px;background-color:white;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script>
        let videoElement = document.getElementById("video");
        let canvasElement = document.createElement("canvas");
        let canvasContext = canvasElement.getContext("2d");
        let scanning = false;

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "environment"
                }
            }).then(function(stream) {
                scanning = true;
                videoElement.srcObject = stream;
                videoElement.setAttribute("playsinline", true); // Ensures iOS doesn't open the video in fullscreen
                videoElement.play();

                videoElement.onloadedmetadata = () => {
                    canvasElement.width = videoElement.videoWidth;
                    canvasElement.height = videoElement.videoHeight;
                    scanBarcode();
                };
            }).catch(function(error) {
                console.error("Camera not accessible: ", error);
            });
        }

        function scanBarcode() {
            if (scanning) {
                canvasContext.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
                let imageData = canvasContext.getImageData(0, 0, canvasElement.width, canvasElement.height);
                let code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });

                if (code) {
                    //alert(code.data);
                    scanning = false;
                    stopCamera();
                    document.querySelector('input[name="question_id"]').value = code.data;
                    document.querySelector('form[action="{{ route('peserta.question.check') }}"]').submit();
                } else {
                    requestAnimationFrame(scanBarcode);
                }
            }
        }

        function stopCamera() {
            scanning = false;
            let stream = videoElement.srcObject;
            if (stream) {
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
            }
            videoElement.srcObject = null;
        }

        // Start camera when the scan modal is shown
        document.querySelector('#scanModal').addEventListener('shown.bs.modal', startCamera);

        // Stop camera when the scan modal is hidden
        document.querySelector('#scanModal').addEventListener('hidden.bs.modal', stopCamera);
    </script>
</x-layout>
