<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRATHAEL</title>
    <link rel="icon" type="favicon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{ asset('utils/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('utils/datatable/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('utils/font-awsome-6/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('utils/sweetalert2/dist/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('utils/datepicker/datepicker.css') }}">
</head>
<body class="body">
    {{-- Navbar --}}
    <nav class="container-fluid bg-merch p-4 shadow sticky-top">
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="{{ route('landing') }}" class="text-link text-white fw-bold fs-5">GRATHAEL</a>
            </div>
            <div class="col-md-8 text-end">
            @if(!auth()->user())
            <div class="d-inline m-3">
                <a href="{{ route('landing') }}" class="text-link m-2 {{ Route::current()->getName() == "landing" ? "text-active" : "text-white"}}">Home</a>
                <a href="{{ route('kamar.hotel') }}" class="text-link m-2 {{ Route::current()->getName() == "kamar.hotel" ? "text-active" : "text-white"}}">Kamar</a>
                <a href="{{ route('fasilitas.hotel') }}" class="text-link m-2 {{ Route::current()->getName() == "fasilitas.hotel" ? "text-active" : "text-white"}}">Fasilitas</a>
            </div>
            <div class="d-inline">
                <a href="{{ route('login') }}" class="text-link fw-bold text-white">Login /</a>
            </div>
                <a class="text-warning text-link fw-bold" href="{{ route('register') }}">Daftar</a>
            @else
            <div class="d-inline">
                <span class="text-warning fw-bold">Hi, {{ auth()->user()->name }}</span>
            </div>
                <div class="d-inline m-3">
                    <a href="{{ route('landing') }}" class="text-link m-2 {{ Route::current()->getName() == "landing" ? "text-active" : "text-white"}}">Home</a>
                    <a href="{{ route('kamar.hotel') }}" class="text-link m-2 {{ Route::current()->getName() == "kamar.hotel" ? "text-active" : "text-white"}}">Kamar</a>
                    <a href="{{ route('fasilitas.hotel') }}" class="text-link m-2 {{ Route::current()->getName() == "fasilitas.hotel" ? "text-active" : "text-white"}}">Fasilitas</a>
                </div>
               
                    <div class="d-inline m-3">
                        @if(session('cart'))
                            <a href="{{ route('cart.index') }}" class="text-link text-white fw-bold"> Keranjang <span id="count" class="fw-bold">{{ count(session()->all()['cart']) }}</span></a>
                        @else
                            <a href="{{ route('cart.index') }}" class="text-link text-white fw-bold"> Keranjang <span id="count" class="fw-bold"></span></a>
                        @endif
                    </div>
                    {!! Form::open(['route' => 'logout', 'method' => 'post', 'class' => 'd-inline']) !!}
                        <button class="btn btn-danger fw-bold"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </nav>
    {{ $slot }}
    <footer class="container-fluid bg-white p-4 border-top border-5">
        <div class="row align-items-center text-center">
            <span class="fw-bold fs-4 text-dark">GRATHAEL</span>
        </div>
    </footer>
    <script src="{{ asset('utils/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('utils/datatable/datatables.js') }}"></script>
    <script src="{{ asset('utils/font-awsome-6/js/all.js') }}"></script>
    <script src="{{ asset('utils/sweetalert2/dist/sweetalert2.js') }}"></script>
    <script src="{{ asset('utils/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('utils/bootbox/bootbox.js') }}"></script>
    <script src="{{ asset('utils/datepicker/datepicker.js') }}"></script>
    {{ $script ?? '' }}
</body>
</html>