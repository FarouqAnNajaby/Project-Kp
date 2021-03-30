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
                        <div class="card-header-form">
                            {!! Form::select('bulan', $bulan, null, ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                            {!! Form::select('tahun', $tahun, null, ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                        </div>
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
<link rel="stylesheet" href="{{ asset('assets/admin/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css" />
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush

@push('javascript-custom')
<script>
    $("table").on('draw.dt', function() {
        $('.tooltip.fade.top.in').hide();
        $('[data-toggle=tooltip]').tooltip({
            container: 'body'
        });
    });
    $(document).ready(function() {
        $("select[name=bulan], select[name=tahun], select[name=status]").on('change', function() {
            $('#transaksi-table').DataTable().draw();
        })
    })
</script>
@endpush