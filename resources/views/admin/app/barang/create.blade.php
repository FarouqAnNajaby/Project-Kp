@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Tambah Barang" url="{{ route('admin.barang.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item"><a href="{{ route('admin.barang.index') }}">Data Barang</a></div>
            <div class="breadcrumb-item"><a>Tambah Barang</a></div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.barang.store']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('umkm', 'UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('umkm', $umkm, null, ['placeholder' => 'Pilih', 'class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama_barang', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama_barang', null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('kategori', $kategori, null, ['placeholder' => 'Pilih', 'class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('stock', 'Stok', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('harga_barang', 'Harga', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::number('harga_barang', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('deskripsi_barang', 'Deskripsi', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::textarea('deskripsi_barang', null, ['class' => 'summernote-simple']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-9 offset-md-3">
                                {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush