@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Tambah Barang" backUrl="{{ route('admin.barang.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.index') }}">Data Barang</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.create') }}">Tambah Barang</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.barang.store']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('umkm', 'UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('umkm', $umkm, null, ['placeholder' => 'Pilih', 'class' => 'form-control select2' . ($errors->has('umkm') ? ' is-invalid' : null), 'required']) !!}
                                @error('umkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama Barang*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null,['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori Barang*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('kategori', $kategori, null, ['placeholder' => 'Pilih', 'class' => 'form-control select2' . ($errors->has('kategori') ? ' is-invalid' : null), 'required']) !!}
                                @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('stok', 'Stok Barang*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('stok', null, ['class' => 'form-control' . ($errors->has('stok') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('harga', 'Harga Barang/Satuan*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    {!! Form::text('harga', null, ['class' => 'form-control' . ($errors->has('harga') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                    @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('deskripsi_singkat', 'Deskripsi Singkat Barang* <i class="fas fa-info-circle" data-toggle="tooltip" title="Maximal 50 kata."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::textarea('deskripsi_singkat', null, ['class' => 'form-control' . ($errors->has('deskripsi_singkat') ? ' is-invalid' : null), 'required', 'style' => 'resize:vertical;height:150px;min-height:150px;']) !!}
                                @error('deskripsi_singkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('deskripsi', 'Deskripsi Barang* <i class="fas fa-info-circle" data-toggle="tooltip" title="Minimal 50 kata."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::textarea('deskripsi', null, ['class' => 'form-control summernote' . ($errors->has('deskripsi') ? ' is-invalid' : null), 'required']) !!}
                                @error('deskripsi')
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
                    <div class="card-footer bg-whitesmoke">
                        (<b>*</b>) = Wajib diisi
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/freezeui/freeze-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    const cleaveInit = (id) => {
        new Cleave(id, {
            numeralDecimalMark: ','
            , delimiter: '.'
            , numeral: true
        });
    }
    cleaveInit('#stok')
    cleaveInit('#harga')

    $('form').on('submit', function(e) {
        FreezeUI({
            selector: 'form'
        })
        $('input').attr('readonly', true)
        $('input[type=submit]').attr('disabled', true)
        $('.select2').attr('readonly', true)
        $('.summernote').summernote('disable')
    })
</script>
@endpush