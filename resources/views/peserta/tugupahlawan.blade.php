<x-layout>
    <?php 
        echo "<pre>";
        print($player->username);
        echo "</pre>";    
    ?>
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="row bg-secondary text-white py-3 mb-4">
            <div class="col-6">
                <h3>{{ $player->team_name }}</h3> <!-- contoh menampilkan nama tim -->
                <p>Jumlah poin : {{ $player->points }}</p> <!-- contoh menampilkan poin -->
                <p>Skor saat ini : {{ $player->current_score }}</p> <!-- contoh menampilkan skor -->
            </div>
            <div class="col-6 text-end">
                <p>Service rate: {{ $player->service_rate }}</p> <!-- contoh menampilkan service rate -->
                <p>Pelanggan datang: {{ $player->customer_count }}</p> <!-- contoh menampilkan jumlah pelanggan -->
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
