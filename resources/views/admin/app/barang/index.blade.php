@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb addBtn=true title="Barang" addUrl="{{ route('admin.barang.create') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.index') }}">Data Barang</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            @if($outOfStock->count())
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Stok Hampir Habis !</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped white-space-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">UMKM</th>
                                        <th class="text-center">Hubungi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($outOfStock as $data)
                                    <tr>
                                        <td class="text-center">
                                            {{ ($outOfStock->currentPage() - 1) * $outOfStock->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{!! $data->name_limitted !!}</td>
                                        <td class="text-center">{{ $data->Kategori->nama }}</td>
                                        <td class="text-center">{{ $data->stok }}</td>
                                        <td class="text-center">{{ $data->rp_harga }}</td>
                                        <td class="text-center">{!! $data->umkm_limitted !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success btn-icon mr-1" data-toggle="tooltip" title="Whatsapp" href="{{ route('admin.barang.send-whatsapp', $data->uuid) }}">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a class="btn btn-icon btn-info mr-1" data-toggle="tooltip" title="Foto" href="{{ route('admin.barang.foto.index', $data->uuid) }}">
                                                <i class="far fa-images"></i>
                                            </a>
                                            <a class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ubah" href="{{ route('admin.barang.edit', $data->uuid) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{ Form::open(['route' => ['admin.barang.destroy', $data->uuid], 'method' => 'delete', 'class' => 'table-action-column']) }}
                                            <button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $outOfStock->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Barang</h4>
                        <div class="card-header-form">
                            {!! Form::select('kategori', $kategori, null, ['placeholder' => 'Semua Kategori', 'class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-striped white-space-nowrap']) !!}
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
<link rel="stylesheet" href="{{ asset('assets/admin/modules/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/modules/datatables/Buttons-1.7.0/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/datatables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/datatables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/datatables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/datatables/Buttons-1.7.0/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush

@push('javascript-custom')
<script>
    $(document).ready(function() {
        $("select[name=kategori]").on('change', function() {
            $('#list-barang-table').DataTable().draw();
        })
        deleteData()
    })
    $("table").on('draw.dt', function() {
        $('.tooltip.fade.top.in').hide();
        $('[data-toggle=tooltip]').tooltip({
            container: 'body'
        });
        deleteData()
    })

    const deleteData = () => {
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
    }
</script>
@endpush