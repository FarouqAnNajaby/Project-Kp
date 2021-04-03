@extends('ecommerce.layout.app')

@section('content')
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Masuk</h2>
                    <p>Masuk menggunakan akun anda untuk memulai transaksi</p>
                    <!-- Form -->
                    {!! Form::open(['class' => 'form']) !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('email', 'Email <span>*</span>', [], false) !!}
                                {!! Form::email('email', null, ['required']) !!}
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('password', 'Password <span>*</span>', [], false) !!}
                                {!! Form::password('password', ['required']) !!}
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="remember">
                                        {!! Form::checkbox('remember', 'remember', false, ['id' => 'remember']) !!}
                                        Ingat saya
                                    </label>
                                </div>
                                {{-- <a href="javascript:;" class="lost-pass">Lupa password?</a> --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group login-btn">
                                <button class="btn">Login</button>
                                <a href="{{ route('ecommerce.register') }}" class="btn">Register</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection