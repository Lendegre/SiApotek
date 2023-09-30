@extends('layouts.app')

@section('content')
    <div class="row" style="height: 100vh;">
        <div class="col-md-8 d-md-block d-none bg-secondary p-0">
            <img src="{{ asset('img/bannerLogin.jpg') }}" style="height: 100%; width: 100%; object-fit: cover" alt="Banner Login">
        </div>

        <div class="col-md-4 py-5 px-4">
            <div class="">
                <h1 style="font-weight: bold">Arfa Farma</h1>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum maxime ea autem fugit debitis voluptas quos sed qui, modi Pariatur!
                </p>
            </div>
            <hr>

            @include('components.alert')
            
            @auth
            
            <p>Silakan logout terlebih dahulu jika ingin login kembali!</p>

            <form action="{{ route('handleLogout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark">Logout</button>
            </form>

            @else

            <form action="{{ route('handleLogin') }}" method="post" class="mt-4">
                @csrf
                <div class="">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username anda" style="height: 50px" id="username" value="{{ old('username') }}">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password anda" style="height: 50px" id="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <button class="btn btn-dark" style="height: 55px; width: 100%">Login</button>
                </div>
            </form>

            
            @endauth


            <div class="mt-5">
                <p class="text-secondary text-center">Copyright &copy; Arfa Farma {{ date('Y', strtotime('now')) }}</p>
            </div>
        </div>
    </div>
@endsection