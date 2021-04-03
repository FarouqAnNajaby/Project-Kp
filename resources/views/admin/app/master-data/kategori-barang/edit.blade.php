@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah Kategori Barang" backUrl="{{ route('admin.master-data.kategori-barang.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Master Data</div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.master-data.kategori-barang.index') }}">Data Kategori Barang</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.master-data.kategori-barang.edit', $data->uuid) }}">Ubah Kategori Barang</a>
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
                        {!! Form::model($data, ['route' => ['admin.master-data.kategori-barang.update', $data->uuid], 'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('nama', 'Kategori Barang*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : null), 'autocomplete' => 'off', 'required']) !!}
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('is_dropdown', 'Dropdown E-Commerce* <i class="fad fa-question-circle" data-toggle="tooltip" title="Kategori yang akan ditampilkan pada menu e-commerce."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('is_dropdown', ['tidak' => 'Tidak', 'ya' => 'Ya'], $data->is_dropdown ? 'ya' : 'tidak', ['class' => 'form-control' . ($errors->has('is_dropdown') ? ' is-invalid' : null), 'required']) !!}
                                @error('is_dropdown')
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