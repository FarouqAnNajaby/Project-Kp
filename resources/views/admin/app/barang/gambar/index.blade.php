@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="Foto Barang" url="{{ route('admin.barang.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">
				<a href="{{ route('admin.barang.index') }}">
					Data Barang
				</a>
			</div>
			<div class="breadcrumb-item">Foto Barang</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Data Foto</h4>
						<div class="card-header-form">
							<a class="btn btn-primary" href="{{ route('admin.barang.gambar.create') }}">Tambah Foto</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-2">
								<thead>
									<tr>
										<th>No</th>
										<th>Gambar</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>
											<img class="img-responsive" src="https://via.placeholder.com/100x100" alt="">
										</td>
										<td>
											<a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus" data-confirm="Anda yakin?|Data akan terhapus permanen, ingin melanjutkan?" data-confirm-yes="alert('Terhapus')"><i class="fas fa-trash"></i></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection