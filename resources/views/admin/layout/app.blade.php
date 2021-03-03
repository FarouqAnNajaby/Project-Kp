<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Admin Lamongan Mart</title>

	@include('admin.partials.stylesheet')
</head>

<body>

	<div class="main-wrapper main-wrapper-1">

		@include('admin.partials.navbar')

		@if(request()->routeIs('admin*'))

		@include('admin.partials.sidebar')

		@else

		@include('kasir.partials.sidebar')

		@endif

		<!-- Main Content -->
		<div class="main-content">
			@yield('content')
		</div>
	</div>

	@include('admin.partials.footer')

	@include('admin.partials.js')

	@include('sweet::alert')

</body>

</html>