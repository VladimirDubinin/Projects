<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/main.css')}}">
	@yield('custom_scripts')
	<title>GoodsBuy</title>
</head>
<body>
	@include('inc.header')
	<div class="container py-3 mt-80">
		@yield('body')
	</div>
	@include('inc.footer')
</body>
</html>

