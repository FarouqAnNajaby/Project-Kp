@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Detail Laporan Transaksi" url="{{ route('kasir.laporan.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item"><a href="{{ route('kasir.laporan.index') }}">Laporan Transaksi</a></div>
            <div class="breadcrumb-item">Detail Laporan Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>

    <div class="section-body">
        <div class="row mb-3">
            <div class="col-md-6 col-12 text-right ml-auto">
                <button class="btn btn-icon btn-warning icon-left"><i class="fas fa-print"></i> Print</button>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-8">
                            <h3>Laporan Transaksi</h3>
                            @if ($data->jenis == 'online')
                            <p class="mt-3"> Nama : {{ $data->User->name }}</p>
                            @endif
                        </div>
                        <div class="col-sm-4 text-right">
                            <h6>{{ $data->formatted_tanggal }}</h6>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="p-0 text-center">No</th>
                                        <th class="p-0 text-center">Nama Barang</th>
                                        <th class="p-0 text-center">Harga</th>
                                        <th class="p-0 text-center">Jumlah</th>
                                        <th class="p-0 text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->TransaksiBarang as $item)
                                    <tr>
                                        <td class="p-0 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->Barang->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->rp_harga }}
                                        </td>
                                        <td class="p-0 text-center">
                                            {{ $item->jumlah }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->total }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-4 text-right ml-auto">

                                <div class="invoice-detail-item mt-4">
                                    <div class="invoice-detail-name">Total</div>
                                    <h4>{{ $data->rp_total }}</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

@endsection

@push('javascript')
<script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endpush
