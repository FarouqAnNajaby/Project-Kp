@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Tambah UMKM" backUrl="{{ route('admin.umkm.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.index') }}">Data UMKM</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.umkm.create') }}">Tambah UMKM</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.umkm.store']) !!}
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
                                {{ Form::select('kategori', $kategori, null, ['placeholder' => 'Pilih', 'class' => 'form-control select2' . ($errors->has('kategori') ? ' is-invalid' : null), 'required']) }}
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
                            {!! Form::label('email', 'Email UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
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
                                <div class="custom-control custom-checkbox">
                                    {!! Form::checkbox('syarat_ketentuan', true, false, ['class' => 'custom-control-input' . ($errors->has('syarat_ketentuan') ? ' is-invalid' : null), 'id' => 'syarat_ketentuan', 'required']) !!}
                                    <label class="custom-control-label" for="syarat_ketentuan">Dengan ini saya menyatakan setuju dengan <a href="" target="_blank" class="font-weight-bold">syarat & ketentuan</a>.</label>
                                    @error('syarat_ketentuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    new Cleave('.phone-number', {
        phone: true
        , phoneRegionCode: 'id'
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