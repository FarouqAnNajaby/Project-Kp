<!DOCTYPE html>
<html lang="en">

<head>
	<title>Print Table</title>
	<meta charset="UTF-8">
	<meta name=description content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
	<style>
		body {
			margin: 20px
		}
	</style>
</head>

<body>
	<table class="table table-bordered table-condensed table-striped">
		@foreach($data as $row)
		@if ($loop->first)
		<tr>
			<th>No</th>
			@foreach($row as $key => $value)
			<th>{!! $key !!}</th>
			@endforeach
		</tr>
		@endif
		<tr>
			<td>{{ $loop->iteration }}</td>
			@foreach($row as $key => $value)
			@if(is_string($value) || is_numeric($value))
			<td>{!! $value !!}</td>
			@else
			<td></td>
			@endif
			@endforeach
		</tr>
		@endforeach
	</table>
	<script>
		window.print();
	</script>
</body>

</html>