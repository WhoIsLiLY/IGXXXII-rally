<x-layout>
    <?php 
        echo "<pre>";
        print($player); 
        echo "<br>";
        echo "</pre>";     
    ?>
    <div class="d-flex flex-row items-center space-x-4">
        <button class="btn btn-primary ms-5">Scan</button>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary ms-5">Logout</button>
        </form>
    </div>
   
    <form action="{{ route('peserta.question.check') }}" method="POST">
        @csrf
        <label for="question_id">Masukkan ID Pertanyaan:</label>
        <input type="number" name="question_id" min="1" max="70" required>
        <button type="submit">Submit</button>
    </form>

    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
