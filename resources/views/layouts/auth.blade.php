<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $title }} | Arfa Farma | Autentikasi</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('img/logo2.png') }}">
</head>
<body>
    
    <div class="container-fluid">
        @yield('content-auth')
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>