@extends('layouts.auth')

@section('content-auth')
<div class="row" style="height: 100vh;">
    
    <div class="col-md-5 py-5 px-md-5 px-4">
        <div class="">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" width="50" alt="">
                <h1 style="font-weight: bold">Arfa Farma</h1>
            </div>
            <p class="my-3">
                Membantu dalam pengelolaan administrasi, obat, alat kesehatan dan lain sebagainya.
            </p>
        </div>
        <hr>
        
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
                <label for="username">Username<span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username anda" style="height: 50px" id="username" value="{{ old('username') }}">
                @error('username')
                <span style="font-size: 13px" class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password anda" style="height: 50px" id="password">
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
            <p class="text-secondary text-center">Copyright &copy; Arfa Farma {{ date('Y', strtotime('now')) }}</p>
        </div>
    </div>
    
    <div class="col-md-7 d-md-block d-none bg-secondary p-0">
        <img src="{{ asset('img/bannerLogin3.jpg') }}" style="height: 100%; width: 100%; object-fit: cover" alt="Banner Login">
    </div>
    
</div>
@endsection