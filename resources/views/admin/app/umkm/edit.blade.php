@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah UMKM" url="{{ route('admin.umkm.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item"><a href="{{ route('admin.umkm.index') }}">Data UMKM</a></div>
            <div class="breadcrumb-item"><a>Ubah UMKM</a></div>
        </x-slot>
    </x-admin-breadcrumb>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Formulir</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($data, ['route' => ['admin.umkm.update', $data->uuid], 'method' => 'patch', 'files' => true]) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('logo', 'Logo UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview" @if ($data->logo) style="background-image:url({{ asset('storage/logo-umkm/'.$data->logo) }}); background-size:cover; background-position:center center;"@endif>
                                    {!! Form::label('image-upload', 'Pilih File', ['id' => 'image-label']) !!}
                                    {!! Form::file('logo', ['id' => 'image-upload', 'accept' => 'image/jpeg,
                                    image/png']) !!}
                                </div>
                                @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null)]) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {{ Form::select('kategori', $kategori, $data->uuid_umkm_kategori, ['placeholder' => 'Pilih', 'class' => 'form-control' . ($errors->has('kategori') ? ' is-invalid' : null)]) }}
                                @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama_pemilik', 'Nama Pemilik UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama_pemilik', null, ['class' => 'form-control' . ($errors->has('nama_pemilik') ? ' is-invalid' : null)]) !!}
                                @error('nama_pemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('email', 'Email UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null)]) !!}
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nomor_telp', 'Nomor Telepon', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nomor_telp', null, ['class' => 'form-control' . ($errors->has('nomor_telp') ? ' is-invalid' : null)]) !!}
                                @error('nomor_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('alamat', 'Alamat UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('alamat', null, ['class' => 'form-control' . ($errors->has('alamat') ? ' is-invalid' : null)]) !!}
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

@push('javascript')
<script src="{{ asset('assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        no_label: false, // Default: false
        success_callback: null // Default: null
    });
</script>
@endpush