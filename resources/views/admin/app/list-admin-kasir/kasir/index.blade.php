@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb addBtn=true title="Data Kasir" addUrl="{{ route('admin.list-admin-kasir.kasir.create') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">List Admin & Kasir</div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.list-admin-kasir.kasir.index') }}">Data Kasir</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Kasir</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>
                                            <a href="{!! route('admin.list-admin-kasir.kasir.edit', $item->uuid) !!}" class="btn btn-primary" data-toggle="tooltip" title="Ubah">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            {!! Form::open(['route' => ['admin.list-admin-kasir.kasir.destroy', $item->uuid], 'method' => 'DELETE', 'class' => 'table-action-column']) !!}
                                            <button class="btn btn-danger delete" data-toggle="tooltip" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

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