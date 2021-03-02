@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Tambah UMKM" url="{{ route('admin.umkm.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item"><a href="{{ route('admin.umkm.index') }}">Data UMKM</a></div>
			<div class="breadcrumb-item"><a>Tambah UMKM</a></div>
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
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama UMKM</label>
							<div class="col-sm-12 col-md-7">
								{!! Form::text('nama_umkm', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
							<div class="col-sm-12 col-md-7">
								{{ Form::select('kategori', [
									'pakaian' => 'Pakaian', 'makanan' => 'Makanan', 'minuman' => 'Minuman'
									], null, ['placeholder' => 'Pilih', 'class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat UMKM</label>
							<div class="col-sm-12 col-md-7">
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pemilik UMKM</label>
							<div class="col-sm-12 col-md-7">
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email UMKM</label>
							<div class="col-sm-12 col-md-7">
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Telepon</label>
							<div class="col-sm-12 col-md-7">
								<input type="number" class="form-control inputtags">
							</div>
						</div>

						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
							</label>
							<div class="col-sm-12 col-md-7">
								<div class="custom-control custom-checkbox" style="c">
									<input type="checkbox" name="agree" class="custom-control-input" id="agree">
									<label class="custom-control-label" for="agree">Dengan ini saya menyatakan <b>setuju</b> dengan <a href="">persyaratan & ketentuan </a></label>
								</div>
							</div>
						</div>

						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
							<div class="col-sm-12 col-md-7">
								<button class="btn btn-primary">Kirim</button>
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