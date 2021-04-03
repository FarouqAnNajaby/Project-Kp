@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Detail UMKM" backUrl="{{ route('admin.umkm.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.index') }}">Data UMKM</a>
            </div>
            <div class=" breadcrumb-item">
                <a href="{{ route('admin.umkm.show', $data->uuid) }}">Detail UMKM</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail">Detail UMKM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="deskripsi-tab" data-toggle="tab" href="#deskripsi">Daftar Barang</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="detail">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Logo UMKM :</label>
                            <div class="col-form-label col-7 col-md-3">
                                <div class="chocolat-parent">
                                    <a href="{{ asset($data->logo) }}" class="chocolat-image" title="{{ $data->nama }}">
                                        <div>
                                            <img alt="image" src="{{ asset($data->logo) }}" class="img-thumbnail">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Nama UMKM :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->nama }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Kategori UMKM :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->UMKM_Kategori->nama }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Tanggal Daftar :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->tanggal_input }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Nama Pemilik :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->nama_pemilik }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Email UMKM :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->email }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Nomor Telepon UMKM :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->nomor_telp }}</p>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-5 col-md-4">Alamat :</label>
                            <p class="col-form-label col-7 col-md-8">{{ $data->alamat }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="deskripsi">
                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                {!! Form::select('kategori', $kategori, null, ['placeholder' => 'Semua Kategori', 'class' => 'form-control select2', 'style' => 'width:100%;']) !!}
                            </div>
                        </div>
                        {!! $dataTable->table(['class' => 'table table-striped', 'width' => '100%']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/chocolat/dist/css/chocolat.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/datatables/Buttons-1.7.0/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/admin/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
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
            $('#daftar-barang-umkm-table').DataTable().draw();
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
            msg.innerHTML = "Data Tidak Dapat Dikembalikan.<br/>Transaksi Pending dengan Barang dari UMKM Terkait Masih Bisa di Terima/Tolak.";
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