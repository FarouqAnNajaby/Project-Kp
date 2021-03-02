@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="History Barang" url="{{ route('admin.barang.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">History Barang</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>History Barang</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-2">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Barang</th>
										<th>Harga</th>
										<th>Persediaan</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Batik Sutra</td>
										<td>120.000</td>
										<td>30</td>
										<td>
											<a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Ubah" href="{{ route('admin.barang.edit') }}"><i class="fas fa-pencil-alt"></i></a>
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

@push('javascript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }} --}}
@endpush