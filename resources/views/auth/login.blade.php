@extends('layouts.auth')

@section('content-auth')
{{-- <div class="row" style="height: 100vh;"> --}}

    <div class="card col-md-4 py-3 px-md-4 px-3 mx-auto mt-5 border border-2 border-dark bg bg-primary rounded-3 shadow-lg">
        <div class="">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo2.png') }}" width="350" style="margin-left: 50px" alt="">
                <h1 style="font-weight: bold"></h1>
            </div>
            <hr class="border border-2 border-white">
            <br>
            <h2 class="text-white text-center">LOGIN</h2>
            {{-- <p class="my-3"> 
                <strong>
                Membantu dalam pengelolaan administrasi, obat, alat kesehatan dan lain sebagainya.
            </strong>
            </p> --}}
        </div>
        
        @include('components.alert')
        
        @auth
        
        <div class="">
            <p>Silakan logout terlebih dahulu jika ingin login kembali!</p>
            <div class="d-flex" style="gap: 10px">
                <a class="btn border-dark" href="{{ route('overview') }}">Dashboard</a>
                <form action="{{ route('handleLogout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">Logout</button>
                </form>
            </div>
        </div>
        
        @else
        
        <form action="{{ route('handleLogin') }}" method="post" class="mt-4">
            @csrf
            <div class="">
                <label for="username"><strong>Username</strong><span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control border border-2 border-dark @error('username') is-invalid @enderror" placeholder="Masukkan username anda" style="height: 50px" id="username" value="{{ old('username') }}">
                @error('username')
                <span style="font-size: 13px" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label for="password"><strong>Password</strong><span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control border border-2 border-dark @error('password') is-invalid @enderror" placeholder="Masukkan password anda" style="height: 50px" id="password">
                @error('password')
                <span style="font-size: 13px" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <button class="btn btn-dark" style="height: 55px; width: 100%">Masuk</button>
            </div>
        </form>
        @endauth
        
        <div class="mt-5">
            <p class="text-white text-center">Copyright &copy; Arfa Farma {{ date('Y', strtotime('now')) }}</p>
        </div>

    </div>
    
    {{-- <div class="col-md-7 d-md-block d-none bg-secondary p-0">
        <img src="{{ asset('img/bannerLogin3.jpg') }}" style="height: 100%; width: 100%; object-fit: cover" alt="Banner Login">
    </div> --}}
    
{{-- </div> --}}
@endsection