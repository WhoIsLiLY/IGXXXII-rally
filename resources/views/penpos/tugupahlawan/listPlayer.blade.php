<x-layout>
    <header style="text-align: center; padding-top:20px;">
        <h1>TEAM LIST</h1>
        <h3>{{ $action }}</h3>
    </header>
    <div class="container mt-3">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Dropdown</button>
            <form action="{{ route("logout") }}"  method="POST">
              @csrf
              <button>
                Logout
              </button>
            </form>
            <div id="myDropdown" class="dropdown-content">
              <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                @foreach ($players as $player)
                    <!-- Header Section -->
                    <a href="{{ route('penpos.' . $id , ['player' => $player->username]) }}">
                        <div class="row bg-secondary text-white py-3 mb-4">
                            {{ $player->username }}
                        </div>
                    </a>
                @endforeach
            </div>
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