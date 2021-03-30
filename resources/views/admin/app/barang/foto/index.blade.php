@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb addBtn="true" backBtn="true" title="Foto Barang" addUrl="{{ route('admin.barang.foto.create',$data->uuid) }}" backUrl="{{ route('admin.barang.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.index') }}">Data Barang</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.foto.index', $data->uuid) }}">Foto Barang</a>
            </div>
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
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foto as $row)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td class="py-3 text-center">
                                            <div class="chocolat-parent">
                                                <a href="{{ asset('storage/barang/' . $row->file) }}" class="chocolat-image" title="{{ $row->Barang->nama }}">
                                                    <div>
                                                        <img alt="image" src="{{ asset('storage/barang/' . $row->file) }}" class="img-thumbnail" width="200px">
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ Form::open(['route' => ['admin.barang.foto.destroy', [$data->uuid, $row->uuid]], 'method' => 'delete', 'class' => 'table-action-column']) }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $('.delete').click(function(e) {
        e.preventDefault();
        let $this = $(this);
        swal({
                title: 'Apakah Anda yakin?'
                , text: 'Data Tidak Dapat Dikembalikan Setelah Anda Menghapus.'
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
</script>
@endpush