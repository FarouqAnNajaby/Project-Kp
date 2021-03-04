@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Ubah Barang" url="{{ route('admin.barang.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item"><a href="{{ route('admin.barang.index') }}">Data Barang</a></div>
			<div class="breadcrumb-item"><a>Ubah Barang</a></div>
		</x-slot>
	</x-admin-breadcrumb>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Formulir</h4>
					</div>
					<div class="card-body">
						{!! Form::open() !!}
						<div class="form-group row mb-4">
							{!! Form::label('logo_umkm', 'Logo UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								<div id="image-preview" class="image-preview">
									{!! Form::label('image-upload', 'Pilih File', ['id' => 'image-label']) !!}
									{!! Form::file('logo_umkm', ['id' => 'image-upload', 'accept' => 'image/jpeg,
									image/png']) !!}
								</div>
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('nama_barang', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('nama_barang', null,
								['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('kategori_umkm', 'Kategori UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{{ Form::select('kategori_umkm', [
									'pakaian' => 'Pakaian', 'makanan' => 'Makanan', 'minuman' => 'Minuman'
									], null, ['placeholder' => 'Pilih', 'class' => 'form-control select2','disabled' => 'true']) }}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('warna_pakaian', 'Warna Pakaian', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{{ Form::select('warna_pakaian', [
									'merah' => 'Merah', 'kuning' => 'Kuning', 'biru' => 'Biru'
									], null, ['placeholder' => 'Pilih', 'class' => 'form-control select2','multiple','disabled' => 'true']) }}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('nama_umkm', 'Nama UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('nama_umkm', null, ['class' => 'form-control','disabled' => 'true']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('harga_barang', 'Harga', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::number('harga_barang', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('stock', 'Persediaan', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::number('stock', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('deskripsi_barang', 'Deskripsi', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::textarea('deskripsi_barang', null, ['class' => 'summernote-simple']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							<div class="col-sm-12 col-md-9 offset-md-3">
								{!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('javascript')
<script type="text/javascript" src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
	$.uploadPreview({
		input_field: "#image-upload",   // Default: .image-upload
		preview_box: "#image-preview",  // Default: .image-preview
		label_field: "#image-label",    // Default: .image-label
		no_label: false,                // Default: false
		success_callback: null          // Default: null
	});
</script>
@endpush