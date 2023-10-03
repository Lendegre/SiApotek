<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Arfa Farma">
	<title>{{ $title }} | Arfa Farma</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="icon" href="{{ asset('img/logo.png') }}">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.6.min.css">
</head>

<body>
	<div class="wrapper">
		@include('components.app_sidebar')
		
		<div class="main">
			@include('components.app_header')
			
			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>{{ $title }}</strong></h1>
					@if ($id_page != 1)
					<p>
						<a href="{{ route('overview') }}">Overview</a> /
						<span>{{ $title }}</span>
					</p>
					@endif
					@yield('content-app')
				</div>
			</main>
			
			@include('components.app_footer')
		</div>
	</div>
	
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/modal.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
	@include('components.notiflix_dialog')
</body>
</html>