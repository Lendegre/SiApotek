@extends('layouts.auth')

@section('content-auth')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
      <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="card bg bg-primary">
          <div class="card-body">
            <div class="text-center mb-4">
              <!-- Ganti 'your_logo_url' dengan URL gambar logo Anda -->
              <img src="{{ asset('img/logo2.png') }}" alt="Logo" style="max-width: 250px">
              <br>
              <br>
              <h2 class="text-center text-light mt-3">LOGIN</h2>
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
              <div class="mb-3">
                <label for="username" class="form-label"><strong>Username</strong></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan Username" required value="{{ old('username') }}">
                @error('username')
                <span style="font-size: 13px" class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label"><strong>Password</strong></label>
                <div class="input-group">
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan password" required>
                  @error('password')
                  <span style="font-size: 13px" class="text-danger">{{ $message }}</span>
                  @enderror
                  <button class="btn bg bg-light border border-light" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-dark w-100">Masuk</button>
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
        </div>
      </div>
  </div>
<script>
  // Toggle password visibility
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    // Ganti ikon mata sesuai dengan tipe password
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
  });
</script>
@endsection