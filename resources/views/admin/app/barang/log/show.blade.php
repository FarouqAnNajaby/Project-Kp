@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Log Barang" backUrl="{{ route('admin.barang.log.index') }}">
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
                    <label class="col-form-label text-md-right col-5 col-md-4">Kategori :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->Barang->Kategori->nama }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Stok Awal :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->stok_awal_formatted }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Stok Tambahan :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->stok_tambahan_formatted }}</p>
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
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Jenis :</label>
                    @php
                    if($data->jenis == 'create') {
                    $jenis = 'Baru';
                    } else if($data->jenis == 'update') {
                    $jenis = 'Ubah';
                    } else if($data->jenis == 'stock') {
                    $jenis = 'Pengadaan';
                    } else {
                    $jenis = 'Hapus';
                    }
                    @endphp
                    <p class="col-form-label col-7 col-md-8">{{ $jenis }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Nama Admin :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->Admin->nama }}</p>
                </div>
                @if($data->jenis == 'stock')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Nama Pengirim :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->nama_pengirim }}</p>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Foto Bukti :</label>
                    <div class="col-form-label col-7 col-md-8">
                        <div class="chocolat-parent">
                            <a href="{{ asset('storage/foto-bukti/' . $data->foto_bukti) }}" class="chocolat-image" title="{{ $data->Barang->nama }}">
                                <div>
                                    <img alt="image" src="{{ asset('storage/foto-bukti/' . $data->foto_bukti) }}" class="img-thumbnail" width="200px">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-5 col-md-4">Tanggal :</label>
                    <p class="col-form-label col-7 col-md-8">{{ $data->tanggal_input }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush