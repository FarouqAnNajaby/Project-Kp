@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb addBtn=true title="UMKM" addUrl="{{ route('admin.umkm.create') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.index') }}">Data UMKM</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data UMKM</h4>
                        <div class="card-header-form">
                            {!! Form::select('kategori', $kategori, null, ['placeholder' => 'Semua Kategori', 'class' => 'form-control select2']) !!}
                        </div>
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
<link rel="stylesheet" href="{{ asset('assets/admin/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/datatables/Buttons-1.7.0/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatables/Buttons-1.7.0/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush

@push('javascript-custom')
<script>
    $(document).ready(function() {
        $("select[name=kategori]").on('change', function() {
            $('#umkmlist-table').DataTable().draw();
        })
    })
    $("table").on('draw.dt', function() {
        $('.tooltip.fade.top.in').hide();
        $('[data-toggle=tooltip]').tooltip({
            container: 'body'
        });
        $('.delete').click(function(e) {
            e.preventDefault();
            let $this = $(this);
            var msg = document.createElement('p');
            msg.innerHTML = "Data dengan Barang Terkait juga Akan Dihapus.<br/>Transaksi Pending dengan Barang dari UMKM Terkait Masih Bisa di Terima/Tolak.";
            swal({
                    title: 'Apakah Anda yakin?'
                    , content: msg
                    , icon: 'warning'
                    , dangerMode: true
                    , buttons: true
                })
                .then((result) => {
                    if (result) {
                        $this.parent().submit();
                    }
                })
        });
    })
</script>
@endpush