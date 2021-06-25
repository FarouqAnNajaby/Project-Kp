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
                        {!! Form::model($data, ['route' => ['admin.barang.pengadaan.update', [$data->uuid_umkm, $data->uuid]], 'method' => 'patch']) !!}
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Input :</label>
                            <p class="col-sm-12 col-md-7">{{ $data->tanggal_input }}</p>
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
@endpush

@push('javascript-custom')
<script>
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