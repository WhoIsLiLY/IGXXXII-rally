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

    <h1>ganti sesi</h1>
    <h1>current session  : {{$session->current}}</h1>
    <p>hati-hati! mengganti sesi akan menyebabkan kenaikan bunga hutang setiap pemain dan mengubah heritage. jika salah dalam mengganti sesi akan mengakibatkan seluruh data error dan harus refresh database</p>
    <a href="{{ route('penpos.changeSessionUbayaHandle',['session'=>$session->current]) }}">SESI BERIKUTNYA</a>
</x-layout>