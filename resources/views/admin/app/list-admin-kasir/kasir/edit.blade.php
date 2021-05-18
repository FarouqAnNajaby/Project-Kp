@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah Data Kasir" backUrl="{{ route('admin.list-admin-kasir.kasir.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">List Admin & Kasir</div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.list-admin-kasir.kasir.index') }}">Data Kasir</a>
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
                        {!! Form::model($data,['route' => ['admin.list-admin-kasir.kasir.update', $data->uuid],'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('username', 'Username*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Nama*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama')
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Formulir Ubah Password</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['admin.list-admin-kasir.kasir.update', $data->uuid],'method' => 'put']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('password', 'Password', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
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
<link rel="stylesheet" href="{{ asset('assets/modules/freezeui/freeze-ui.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            FreezeUI({
                selector: 'form'
            })
            $('input.form-control').attr('readonly', true)
            $('input[type=submit]').attr('disabled', true)
        })
    })
</script>
@endpush