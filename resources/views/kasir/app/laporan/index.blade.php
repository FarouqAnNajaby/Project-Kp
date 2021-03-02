@extends('admin.layout.app')

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')

<section class="section">
    <x-admin-breadcrumb title="Laporan Transaksi">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Laporan Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>

    <div class="section-body">
        <div class="row">
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Pending</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Selesai</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 col-12 text-right ml-auto">
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            </div>

        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Transaksi</h4>
                        <div class="card-header-form">
                            {!! Form::select('bulan', $bulan, null, ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                            {!! Form::select('tahun', $tahun, null, ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th data-width="40">No</th>
                                    <th>Kode Transaksi</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>AS001</td>
                                    <td class="text-center">20/02/2021</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp. 5.000</td>
                                    <td class="text-center">
                                        <a href="{{ route('kasir.laporan.show') }}" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>AS002</td>
                                    <td class="text-center">23/02/2021</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp. 5.000</td>
                                    <td class="text-center"><button href="#" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>AS003</td>
                                    <td class="text-center">01/03/2021</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp. 5.000</td>
                                    <td class="text-center"><button href="#" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></button></td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
@endpush
