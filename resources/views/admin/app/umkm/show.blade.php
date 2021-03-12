@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Detail UMKM" url="{{ route('admin.umkm.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">
				<a href="{{ route('admin.umkm.index') }}">
					UMKM
				</a>
			</div>
			<div class=" breadcrumb-item">Detail UMKM</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail">Detail UMKM</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="deskripsi-tab" data-toggle="tab" href="#deskripsi">Daftar Barang</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="detail">
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Logo UMKM :</label>
							<p class="col-form-label col-7 col-md-3">
								<img src="{{ asset('storage/logo-umkm/'.$data->logo) }}" class="img-thumbnail">
							</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Nama UMKM :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->nama }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Tanggal Daftar :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->tanggal_input }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Alamat :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->alamat }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Nama Pemilik :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->nama_pemilik }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Email UMKM :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->email }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">No Telepon UMKM :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->nomor_telp }}</p>
						</div>
					</div>
					<div class="tab-pane fade" id="deskripsi">
						<p class="text-justify">
							{!! $dataTable->table(['class' => 'table table-striped']) !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script type="text/javascript" src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush