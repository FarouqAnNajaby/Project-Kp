@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li>
                            <a href="{{ route('ecommerce.index') }}">Home<i class="ti-arrow-right"></i></a>
                        </li>
                        <li class="active">
                            <a href="{{ route('ecommerce.profile') }}">Profil Pengguna</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product-area shop-sidebar shop section">
    <div class="container">
        <div class="row">
            @include('ecommerce.partials.sidebar')
            <div class="col-lg-9 col-sm-9 col-12">
                <div class="contact-us row">
                    <div class="col-12 mb-4">
                        <div class="form-main">
                            <div class="title">
                                <h3>Profil Pengguna</h3>
                            </div>
                            {!! Form::model($data = auth()->user(), ['class' => 'form', 'method' => 'patch']) !!}
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nama Lengkap</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::text('nama', $data->nama, ['required']) !!}
                                    @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Jenis Kelamin</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::select('jenis_kelamin', ['laki_laki' => 'Laki-laki', 'perempuan' => 'Perempuan'], $data->jenis_kelamin, ['class' => 'select-jk', 'required']) !!}
                                    @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Tanggal Lahir</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::date('tanggal_lahir', $data->tanggal_lahir, ['required']) !!}
                                    @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Email</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::email('email', $data->email, ['required']) !!}
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nomor Telepon</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::text('nomor_telepon', $data->formatted_notelp, ['required']) !!}
                                    @error('nomor_telepon')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group button">
                                    <button type="submit" class="btn ">Simpan</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-main">
                            <div class="title">
                                <h3>Ubah Kata Sandi</h3>
                            </div>
                            {!! Form::open(['route' => 'ecommerce.change-password', 'class' => 'form', 'method' => 'patch']) !!}
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Kata Sandi Sekarang</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::password('password', ['required']) !!}
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Kata Sandi Baru</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::password('new_password', ['required']) !!}
                                    @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Konfirmasi Kata Sandi Baru</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::password('new_password_confirmation', ['required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group button">
                                    <button class="btn">Simpan</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('javascript')
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    new Cleave('input[name=nomor_telepon]', {
        phone: true
        , phoneRegionCode: 'id'
    });
</script>
@endpush