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
							{!! $dataTable->table(['class' => 'table table-striped']) !!}
							{{-- <table class="table table-striped" id="table-2">
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
							</table> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('stylesheet')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css" />
@endpush

@push('javascript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush