@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Foto Barang" url="{{ route('admin.barang.gambar.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">
				<a href="{{ route('admin.barang.index') }}">
					Data Barang
				</a>
			</div>
			<div class="breadcrumb-item">
				<a href="{{ route('admin.barang.gambar.index') }}">
					Foto Barang
				</a>
			</div>
			<div class="breadcrumb-item">
				Tambah Foto
			</div>
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
									<label for="image-upload" id="image-label">Pilih File</label>
									<input type="file" name="image" id="image-upload" />
								</div>
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