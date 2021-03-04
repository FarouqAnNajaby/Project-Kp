@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Tambah Kategori" url="{{ route('admin.umkm.kategori.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">
				<a href="{{ route('admin.umkm.kategori.index') }}">
					Data Kategori
				</a>
			</div>
			<div class="breadcrumb-item">Tambah Kategori</div>
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