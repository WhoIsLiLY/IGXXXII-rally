<x-layout>
    <style>
        .container-top {
            display: flex;
            align-items: center;
            width: 100%;
            background-color: #A67C52;
            padding: 10px;
            border: 2px solid #D6A14D;
        }
        .container-bot {
            align-items: center;
            width: 100%;
            padding: 10px;
            background-color: #7E5E5E;
        }
        button{
          background: #ffd3a7;
          color: #7E5E5E;
          padding: 5px;
          font-weight: bold;
        }
        
    </style>
    <header style="text-align: center;">
    <nav class="navbar d-flex px-3" style="background-color: #E4AD49;justify-content:space-between;">
      @if (Auth::user()->role == 'penpos')
            <a href="{{ route('penpos.dashboard') }}" style="font-size:20px;font-weight:bold;color:antiquewhite;">&lt;&lt; Dashboard</a>
      @endif
      <h1 class ="text-main">{{ $action }}</h1>
      <form action="{{ route("logout") }}"  method="POST">
              @csrf
              <button class="rounded">
                Logout
              </button>
      </form>
    </nav>
    </header>
    <div class="container mt-3 p-5">
            <h1 class ="text-main" style="text-align: center;">TEAM LIST</h1>
            <div class="container-top" >
              <button onclick="myFunction()" class="dropbtn rounded">Dropdown</button>
              <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
            </div>
            <div id="myDropdown" class="container-bot ">
              
                @foreach ($players as $player)
                    <!-- Header Section -->
                    <a href="{{ route('penpos.' . $id , ['player' => $player->username]) }}">
                        <div class="  text-white py-3 mb-4  ">
                            {{ $player->username }}
                        </div>
                    </a>
                @endforeach
            </div>
    </div>
    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        function filterFunction() {
          const input = document.getElementById("myInput");
          const filter = input.value.toUpperCase();
          const div = document.getElementById("myDropdown");
          const a = div.getElementsByTagName("a");
          for (let i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              a[i].style.display = "";
            } else {
              a[i].style.display = "none";
            }
          }
        }
        </script>
</x-layout>