<x-layout>
    <header style="text-align: center; padding-top:20px;">
        <h1>TEAM LIST</h1>
    </header>

    @foreach ($players as $player)
        <div class="container mt-3">
            <!-- Header Section -->
            <div class="row bg-secondary text-white py-3 mb-4">
            {{ $player->username }}
            </div>
        </div>
    @endforeach
</x-layout>