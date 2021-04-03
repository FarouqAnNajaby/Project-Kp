@extends('ecommerce.layout.app')

@section('content')
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Daftar Akun</h2>
                    <p>Lengkapi Biodata Diri Anda untuk Memulai Bertransaksi dengan Akun Anda</p>
                    <!-- Form -->
                    {!! Form::open(['class' => 'form']) !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('nama', 'Nama Lengkap<span>*</span>', [], false) !!}
                                {!! Form::text('nama', null, ['required']) !!}
                                @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="form-group">
                                {!! Form::label('jenis_kelamin', 'Jenis Kelamin<span>*</span>', [], false) !!}
                                {!! Form::select('jenis_kelamin', ['laki_laki' => 'Laki-laki', 'perempuan' => 'Perempuan'], null, ['placeholder' => '------Pilih------', 'class' => 'select-jk', 'required']) !!}
                                @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('tanggal_lahir', 'Tanggal Lahir') !!}
                                {!! Form::date('tanggal_lahir', null) !!}
                                @error('tanggal_lahir')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('email', 'Email<span>*</span>', [], false) !!}
                                {!! Form::email('email', null, ['required']) !!}
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('nomor_telepon', 'Nomor Telepon<span>*</span>', [], false) !!}
                                {!! Form::text('nomor_telepon', null, ['required']) !!}
                                @error('nomor_telepon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('password', 'Kata Sandi<span>*</span>', [], false) !!}
                                {!! Form::password('password', ['required']) !!}
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Konfirmasi Kata Sandi<span>*</span>', [], false) !!}
                                {!! Form::password('password_confirmation', ['required']) !!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group login-btn">
                                <button class="btn" type="submit">Daftar Sekarang</button>
                                <a href="{{ route('ecommerce.login') }}" class="btn">Login</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <!--/ End Form -->
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