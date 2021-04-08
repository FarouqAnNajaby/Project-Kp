@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah UMKM" backUrl="{{ route('admin.umkm.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.index') }}">Data UMKM</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.edit', $data->uuid) }}">Ubah UMKM</a>
            </div>
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
                            {!! Form::label('logo', 'Logo UMKM <i class="fas fa-info-circle" data-toggle="tooltip" title="Ukuran file maksimal 3MB & ekstensi berupa jpeg, jpg, png."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-file">
                                    {!! Form::file('logo', ['class' => 'custom-file-input', 'id'=>'logo', 'accept' => 'image/jpeg,image/png']) !!}
                                    {!! Form::label('logo', 'Pilih foto', ['class' => 'custom-file-label']) !!}
                                </div>
                                @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="preview-image mt-4"></div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {{ Form::select('kategori', $kategori, $data->uuid_umkm_kategori, ['placeholder' => 'Pilih', 'class' => 'form-control select2' . ($errors->has('kategori') ? ' is-invalid' : null), 'required']) }}
                                @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama_pemilik', 'Nama Pemilik UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama_pemilik', null, ['class' => 'form-control' . ($errors->has('nama_pemilik') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama_pemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('email', 'Email UMKM', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null), 'autocomplete' => 'off']) !!}
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nomor_telp', 'Nomor Telepon* <i class="fas fa-info-circle" data-toggle="tooltip" title="Agar dapat dihubungi ketika persediaan barang menipis. Pastikan nomor telepon adalah nomor aktif."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nomor_telp', null, ['class' => 'form-control phone-number' . ($errors->has('nomor_telp') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nomor_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('alamat', 'Alamat UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('alamat', null, ['class' => 'form-control' . ($errors->has('alamat') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
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
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    const logo = $("#logo")
    const defaultLogo = () => $('.preview-image').css('background-image', 'url({{ asset($data->logo) }})');
    const maxAllowedSize = 3 * 1024 * 1024;
    const invalidMaxSizeAlert = () => swalAlert('Ukuran foto maksimal 3MB.')
    const invalidExtAlert = () => swalAlert('Ekstensi file hanya boleh berupa jpeg, jpg dan png.')
    const resetLogoInput = () => {
        defaultLogo()
        $("#logo").val('').next('label').html('Pilih foto');
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

    $(document).ready(function() {

        bsCustomFileInput.init()
        defaultLogo()

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
            } else {
                defaultLogo()
            }
        })
        new Cleave('.phone-number', {
            phone: true
            , phoneRegionCode: 'id'
        })
    })
    $('form').on('submit', function(e) {
        FreezeUI({
            selector: 'form'
        })
        $('input.form-control').attr('readonly', true)
        $('input[type=submit]').attr('disabled', true)
        $('.select2').attr("readonly", true)
    })
</script>
@endpush