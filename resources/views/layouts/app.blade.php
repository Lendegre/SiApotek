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
	<link rel="icon" href="{{ asset('img/logo2.png') }}">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/public.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.6.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
	<div class="wrapper">
		@include('components.app_sidebar')
		
		<div class="main">
			@include('components.app_header')
			
			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>{{ $title }}</strong></h1>
					@if ($id_page != 1 && $id_page != null)
					<p>
						<a href="{{ route('overview') }}">Halaman Utama</a> /
						<span>{{ $title }}</span>
					</p>
					@endif
					@yield('content-app')
				</div>
			</main>
			
			@include('components.app_footer')
		</div>
	</div>
	

	<script src="https://unpkg.com/feather-icons"></script>
    <script>
		feather.replace();
	</script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/modal.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script>	
		new DataTable('#data');
	</script>

	{{-- <script>
	$(document).ready(() => {
	$("#jumlah").keyup(function () {
	   var int1 = $("#isi").val() * $("#jumlah").val();
	   console.log(int1);
	   $("#stok").val(int1);
	});

	$("#isi").keyup(function () {
	   var int2 = $("#jumlah").val() * $("#isi").val();
	   console.log(int2);
	   $("#stok").val(int2);
	});
  	});
	</script> --}}

	@stack('chart-script')

	@include('components.notiflix_dialog')
</body>
</html>