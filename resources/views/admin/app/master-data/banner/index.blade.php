@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb addBtn=true title="Banner E-Commerce" addUrl="{{ route('admin.master-data.banner.create') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Master Data</div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.master-data.banner.index') }}">Data Banner E-Commerce</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Banner E-Commerce</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Judul</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <div class="chocolat-parent">
                                                <a href="{{ asset('storage/banner/' . $banner->foto) }}" class="chocolat-image" title="{{ $banner->judul }}">
                                                    <div>
                                                        <img alt="image" src="{{ asset('storage/banner/' . $banner->foto) }}" class="img-thumbnail" width="100px">
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $banner->judul }}</td>
                                        <td>{{ $banner->tanggal_input }}</td>
                                        <td>
                                            <a class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ubah" href="{{ route('admin.master-data.banner.edit', $banner->uuid) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            {{ Form::open(['route' => ['admin.master-data.banner.destroy', $banner->uuid], 'method' => 'delete', 'class' => 'table-action-column']) }}
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
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
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