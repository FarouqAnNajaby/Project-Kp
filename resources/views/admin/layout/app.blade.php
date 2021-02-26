<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Admin Lamongan Mart</title>

	@include('admin.partials.stylesheet')
</head>

<body>

	<div class="main-wrapper main-wrapper-1">

		@include('admin.partials.navbar')

		@include('admin.partials.sidebar')

		<!-- Main Content -->
		<div class="main-content">
			@yield('content')
		</div>
	</div>

	@include('admin.partials.footer')

	@include('admin.partials.js')

</body>

</html>