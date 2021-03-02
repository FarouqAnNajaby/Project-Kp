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
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto Barang</label>
							<div class="col-sm-12 col-md-7">
								<div id="image-preview" class="image-preview">
									<label for="image-upload" id="image-label">Choose File</label>
									<input type="file" name="image" id="image-upload" />
								</div>
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Barang</label>
							<div class="col-sm-12 col-md-7">
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
							<div class="col-sm-12 col-md-7">
								<select class="form-control selectric" disabled="true">
									<option>Pilih</option>
									<option>Pakaian</option>
									<option>Makanan</option>
									<option>Minuman</option>
								</select>
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama UMKM</label>
							<div class="col-sm-12 col-md-7">
								<input type="text" class="form-control" disabled="true">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
							<div class="col-sm-12 col-md-7">
								<input type="number" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Persediaan</label>
							<div class="col-sm-12 col-md-7">
								<input type="number" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
							<div class="col-sm-12 col-md-7">
								<button class="btn btn-primary">Kirim</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection