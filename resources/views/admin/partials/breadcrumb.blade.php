<div class="section-header">

	@if ($attributes->has('backBtn'))
	<div class="section-header-back">
		<a href="{{ $attributes->get('url') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
	</div>
	<h1>{{ $attributes->get('title') }}</h1>
	@endif

	@if($attributes->has('addBtn'))
	<h1>{{ $attributes->get('title') }}</h1>
	<div class="section-header-button">
		<a href="{{ $attributes->get('url') }}" class="btn btn-primary">Tambah {{ $attributes->get('title') }}</a>
	</div>
	@endif

	<div class="section-header-breadcrumb">
		<div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
		{{ $breadcrumbItem }}
	</div>
</div>