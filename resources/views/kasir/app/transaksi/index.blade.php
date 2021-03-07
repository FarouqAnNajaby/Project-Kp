@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb title="Transaksi">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-striped']) !!}
                            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
    $("table").on('draw.dt', function () {
		$('.tooltip.fade.top.in').hide();
		$('[data-toggle=tooltip]').tooltip({container: 'body'});
    });
</script>
@endpush
