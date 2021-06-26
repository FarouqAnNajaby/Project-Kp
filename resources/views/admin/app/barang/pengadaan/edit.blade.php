@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Pengadaan Barang" backUrl="{{ route('admin.barang.pengadaan.show', $data->uuid_umkm) }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.pengadaan.index') }}">Pengadaan Barang</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($data, ['route' => ['admin.barang.pengadaan.update', [$data->uuid_umkm, $data->uuid]], 'method' => 'patch', 'files' => true]) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', $data->nama,['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('kategori', $data->Kategori->nama, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('stok', 'Stok Sekarang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('stok', $data->stok, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('tambah_stok', 'Tambah Stok*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('tambah_stok', null, ['class' => 'form-control' . ($errors->has('tambah_stok') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('tambah_stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('harga', 'Harga Barang/Satuan', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    {!! Form::text('harga', $data->harga, ['class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama_pengirim', 'Nama Pengirim*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama_pengirim', null, ['class' => 'form-control' . ($errors->has('nama_pengirim') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama_pengirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('foto_bukti', 'Foto Bukti* <i class="fas fa-info-circle" data-toggle="tooltip" title="Ukuran file maksimal 3MB & ekstensi berupa jpeg, jpg, png."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-file">
                                    {!! Form::file('foto_bukti', ['class' => 'custom-file-input', 'id'=>'foto_bukti', 'accept' => 'image/jpeg,image/png']) !!}
                                    {!! Form::label('foto_bukti', 'Pilih foto', ['class' => 'custom-file-label']) !!}
                                </div>
                                @error('foto_bukti')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="preview-image mt-4"></div>
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
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    const logo = $("#foto_bukti")
    const maxAllowedSize = 3 * 1024 * 1024;
    const invalidMaxSizeAlert = () => swalAlert('Ukuran foto maksimal 3MB.')
    const invalidExtAlert = () => swalAlert('Ekstensi file hanya boleh berupa jpeg, jpg dan png.')
    const resetLogoInput = () => {
        $("#foto_bukti").val('').next('label').html('Pilih foto');
    }
    const swalAlert = (text) => {
        swal({
            title: 'Terjadi Kesalahan'
            , text: text
            , icon: 'error'
        })
    }
    $.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$', "i")).test($(this).val());
    }

    bsCustomFileInput.init()

    logo.on('change', function() {
        const $this = this
        if (this.files && this.files[0]) {
            if (logo.hasExtension(['.jpeg', '.jpg', '.png'])) {
                if ($this.files[0].size < maxAllowedSize) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.preview-image').css('background-image', 'url(' + e.target.result + ')');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    invalidMaxSizeAlert()
                    resetLogoInput()
                }
            } else {
                invalidExtAlert()
                resetLogoInput()
            }
        }
    })
    const cleaveInit = (id) => {
        new Cleave(id, {
            numeralDecimalMark: ','
            , delimiter: '.'
            , numeral: true
        });
    }
    cleaveInit('#tambah_stok')
    cleaveInit('#harga')

    $('form').on('submit', function(e) {
        FreezeUI({
            selector: 'form'
        })
        $('input').attr('readonly', true)
        $('input[type=submit]').attr('disabled', true)
        $('.select2').attr('readonly', true)
    })
</script>
@endpush