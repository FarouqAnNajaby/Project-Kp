@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah Pengaturan" backUrl="{{ route($route . '.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.auth.settings') }}">Pengaturan</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Data</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($data, ['route' => $route . '.auth.settings', 'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('username', 'Username*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off']) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', $data->nama, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        @endif
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-9 offset-md-3">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        (<b>*</b>) = Wajib diisi
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ubah Password</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => $route . '.auth.settings.password', 'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('password', 'Password Sekarang*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('new_password', 'Password Baru*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::password('new_password', ['class' => 'form-control' . ($errors->has('new_password') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('new_password_confirmation', 'Konfirmasi Password Baru*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::password('new_password_confirmation', ['class' => 'form-control' . ($errors->has('new_password_confirmation') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-9 offset-md-3">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
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
@endpush

@push('javascript-custom')
<script>
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