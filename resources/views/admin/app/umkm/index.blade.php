@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb addBtn=true title="UMKM" url="{{ route('admin.umkm.create') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">Data UMKM</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Data UMKM</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-2">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama UMKM</th>
										<th>Email</th>
										<th>Nomor Telepon</th>
										<th>Kategori</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Kamila Collection</td>
										<td>Kamila@gmail.com</td>
										<td>081238044604</td>
										<td>Pakaian</td>
										<td>
											<a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Ubah" href="edit_umkm.php"><i class="fas fa-pencil-alt"></i></a>
											<a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Anda yakin?|Data akan terhapus permanen, ingin melanjutkan?" data-confirm-yes="alert('Terhapus')"><i class="fas fa-trash"></i></a>
											<a class="btn btn-secondary btn-action mr-1" data-toggle="tooltip" title="Detil" id="modal-2"><i class="fas fa-eye"></i></a>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Keripik Madura</td>
										<td>kerim@gmail.com</td>
										<td>081238044604</td>
										<td>Pakaian</td>
										<td>
											<a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Ubah" href="edit_umkm.php"><i class="fas fa-pencil-alt"></i></a>
											<a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Anda yakin?|Data akan terhapus permanen, ingin melanjutkan?" data-confirm-yes="alert('Terhapus')"><i class="fas fa-trash"></i></a>
											<a class="btn btn-secondary btn-action mr-1" data-toggle="tooltip" title="Detil" id="modal-3"><i class="fas fa-eye"></i></a>
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