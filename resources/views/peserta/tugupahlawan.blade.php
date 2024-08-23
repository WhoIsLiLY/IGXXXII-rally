<x-layout>
    <?php 
        echo "<pre>";
        print($player); 
        echo "<br>";
        echo "</pre>";     
    ?>

    <!-- NAVBAR - Scan Button and Logout -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Industrial Games</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#scanModal">Scan</button>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopCamera()"></button>
                </div>
                <div class="modal-body">
                    <div class="video-container">
                        <video id="video" class="w-100"></video>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="stopCamera()">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Question Modal -->
    @if (session()->has('questionStatus'))
        @if (session('questionStatus') == true)
            <div class="modal fade show" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="questionModalLabel">Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ session('questionMessage')->question }}</h4>
                                </div>
                                <div class="card-body">
                                    @if (session('questionMessage')->img_path)
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('storage/' . session('questionMessage')->img_path) }}" alt="Question Image" class="img-fluid rounded">
                                        </div>
                                    @endif
                                    <form action="{{ route('peserta.answer.check') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="question_id" value="{{ session('questionMessage')->id }}">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerA" name="answer" class="custom-control-input" value="a" required>
                                                <label class="custom-control-label" for="answerA">{{ session('questionMessage')->a }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerB" name="answer" class="custom-control-input" value="b" required>
                                                <label class="custom-control-label" for="answerB">{{ session('questionMessage')->b }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerC" name="answer" class="custom-control-input" value="c" required>
                                                <label class="custom-control-label" for="answerC">{{ session('questionMessage')->c }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerD" name="answer" class="custom-control-input" value="d" required>
                                                <label class="custom-control-label" for="answerD">{{ session('questionMessage')->d }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="answerE" name="answer" class="custom-control-input" value="e" required>
                                                <label class="custom-control-label" for="answerE">{{ session('questionMessage')->e }}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Answer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="row bg-secondary text-white py-3 mb-4">
            <div class="col-6">
                <h3>{{ $player->username }}</h3>
                <p>Jumlah poin : {{ $player->tupals->point}}</p>
                <p>Skor saat ini : {{ $player->score }}</p>
            </div>
            <div class="col-6 text-end">
                @php
                    $totalServiceTime = 0;
                    foreach ($player->lokets as $loket) {
                        $totalServiceTime += 30/$loket->service_time ?? 0;
                    }
                @endphp
                @php
                    $totalCustomer = 0;
                    foreach ($player->playersStandsAds as $standAd) {
                        $totalCustomer += $standAd->probability*$standAd->amount;
                    }
                @endphp
                <p>Total Service Time: {{ $totalServiceTime }}</p>
                <p>Pelanggan datang: {{ $totalCustomer }}</p>
            </div>
        </div>
        <!-- Loket Section -->
        <div class="row bg-secondary text-white mb-4">
            <div class="col-12">
                <div class="p-4 bg-secondary text-white text-center">
                    Loket
                </div>
            </div>
        </div>

        <!-- Stand and Ads Section -->
        <div class="row bg">
            <div class="col-6">
                <div class="p-4 bg-secondary text-white text-center">
                    Stand
                </div>
            </div>
            <div class="col-6">
                <div class="p-4 bg-secondary text-white text-center">
                    Ads
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
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
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
