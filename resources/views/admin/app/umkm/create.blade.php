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
							{!! Form::label('nama_umkm', 'Nama UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('nama_umkm', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('kategori_umkm', 'Kategori UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{{ Form::select('kategori_umkm', [
									'pakaian' => 'Pakaian', 'makanan' => 'Makanan', 'minuman' => 'Minuman'
									], null, ['placeholder' => 'Pilih', 'class' => 'form-control']) }}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('alamat_umkm', 'Alamat UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('alamat', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('nama_pemilik_umkm', 'Nama Pemilik UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('nama_pemilik_umkm', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('email_umkm', 'Email UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::text('email_umkm', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							{!! Form::label('nomor_umkm', 'Nomor Telepon', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
							<div class="col-sm-12 col-md-7">
								{!! Form::number('nomor_umkm', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group row mb-4">
							<div class="col-sm-12 col-md-9 offset-md-3">
								<div class="custom-control custom-checkbox" style="c">
									{!! Form::checkbox('syarat_ketentuan', false, false, ['class' => 'custom-control-input', 'id' => 'syarat_ketentuan']) !!}
									<label class="custom-control-label" for="syarat_ketentuan">Dengan ini saya menyatakan setuju dengan <a href=""><b> persyaratan & ketentuan</b></a></label>
								</div>
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