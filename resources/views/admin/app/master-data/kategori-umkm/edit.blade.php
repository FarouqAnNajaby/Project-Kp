@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Edit Kategori UMKM" backUrl="{{ route('admin.master-data.kategori-umkm.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Master Data</div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.master-data.kategori-umkm.index') }}">Data Kategori UMKM</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.master-data.kategori-umkm.edit', $data->uuid) }}">Ubah Kategori UMKM</a>
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
                        {!! Form::model($data, ['route' => ['admin.master-data.kategori-umkm.update', $data->uuid], 'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Kategori UMKM*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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