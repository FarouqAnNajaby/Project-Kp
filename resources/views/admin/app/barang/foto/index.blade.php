@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb addBtn=true title="Foto Barang" url="{{ route('admin.barang.foto.create',$data->uuid) }}">
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
					</div>
					<div class="card-body">
						<div class="table-responsive">
							{!! $dataTable->table(['class' => 'table table-striped']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Buttons-1.7.0/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Buttons-1.7.0/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush