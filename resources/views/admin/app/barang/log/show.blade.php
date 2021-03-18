@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Log Barang" url="{{ route('admin.barang.log.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.log.index') }}">
                    Log Barang
                </a>
            </div>
            <div class=" breadcrumb-item">Detail Barang</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Nama Barang :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->Barang->nama }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Tanggal Input :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->tanggal_input }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Kategori :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->Barang->Kategori->nama }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Stok :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->stok_formatted }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Harga Satuan :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->rp_harga }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Nama UMKM :</label>
                    <p class="col-form-label col-7 col-md-8">
                        <a href="{{ route('admin.umkm.show', $data->Barang->UMKM->uuid) }}" target="_blank">
                            {{ $data->Barang->UMKM->nama }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection