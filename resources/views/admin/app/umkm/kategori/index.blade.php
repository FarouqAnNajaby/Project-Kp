@extends('admin.layout.app')

@section('content')
<section class="section">
	<x-admin-breadcrumb addBtn=true title="Kategori" url="{{ route('admin.umkm.kategori.create') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">Data Kategori</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Data Kategori</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-1">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Kategori</th>
										<th>Hubungi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Pakaian</td>
										<td>
											<a class="btn btn-icon btn-success" data-toggle="tooltip" title="Ubah" href="{{ route('admin.kategori.edit') }}"><i class="fas fa-pencil-alt"></i></a>

											<a class="btn btn-icon btn-danger" data-toggle="tooltip" title="Hapus" data-confirm="Anda yakin?|Data akan terhapus permanen, ingin melanjutkan?" data-confirm-yes="alert('Terhapus')"><i class="fas fa-trash"></i></a>
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

	@endsection