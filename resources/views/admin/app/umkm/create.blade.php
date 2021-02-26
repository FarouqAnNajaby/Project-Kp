@extends('admin.layout.app')

@section('content')

<section class="section">
	<div class="section-header">
		<div class="section-header-back">
			<a href="{{ route('admin.umkm.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
		</div>
		<h1>Tambah Data UMKM</h1>
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
			<div class="breadcrumb-item"><a href="{{ route('admin.umkm.index') }}">Data UMKM</a></div>
			<div class="breadcrumb-item"><a>Tambah UMKM</a></div>
		</div>
	</div>

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
								{{ Form::select('kategori', ['' => 'Pilih', 'pakaian' => 'Pakaian', 'makanan' => 'Makanan', 'minuman' => 'Minuman'], '', ['class' => 'form-control']) }}
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