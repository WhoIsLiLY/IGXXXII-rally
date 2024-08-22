<x-layout>
     <!-- Display Flash Messages -->
     @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
     @endif
 
     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif
     
    <a href="{{ route('penpos.listPlayer', ['action' => 'INVENTORY', 'id' => 'inventory']) }}">&lt;&lt; Inventory</a>
    <h1>{{$player->username}}</h1>
    <h2>player point: {{$ubaya->point}}</h2>
    <h2>player inventory: {{$totalInventory}}/{{$ubaya->inventory}}</h2>

    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>Inventory   : +20</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.inventoryUpgrade', ['player' => $player->username, 'upgrade' => 1]) }}">500</a>
        </div>
    </div>
    
    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>Inventory   : +50</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.inventoryUpgrade', ['player' => $player->username, 'upgrade' => 2]) }}"> 800 </a>
        </div>
    </div>
    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>Inventory   : +70</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.inventoryUpgrade', ['player' => $player->username, 'upgrade' => 3]) }}"> 1000 </a>
        </div>
    </div>
    <div class="row bg-secondary text-white py-3 mb-4" style="padding:20px; margin:20px;">
        <div class="col-md-10">
            <h3>Inventory   : +100</h3>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center bg-white rounded">
            <a href="{{ route('penpos.inventoryUpgrade', ['player' => $player->username, 'upgrade' => 4]) }}"> 1300 </a>
        </div>
    </div>
    
</x-layout>