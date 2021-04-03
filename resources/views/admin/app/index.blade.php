@extends('admin.layout.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-store"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total UMKM</h4>
                    </div>
                    <div class="card-body">{{ $umkm_count }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Barang</h4>
                    </div>
                    <div class="card-body">{{ $barang_count }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">{{ $user_count }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- statistik pengunjung per bulan -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik Transaksi</h4>
                    <div class="card-header-form">
                        {!! Form::select('bulan_transaksi', $bulan, request()->get('bulan_transaksi'), ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                        {!! Form::select('tahun_transaksi', $tahun, request()->get('tahun_transaksi'), ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartWrapper">
                        <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                            <div style="width: 3000px; height: 300px">
                                <canvas id="transaksiChart" height="300" width="0"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- statistik transaksi per hari -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik UMKM</h4>
                    <div class="card-header-form">
                        {!! Form::select('bulan_umkm', $bulan, request()->get('bulan_umkm'), ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                        {!! Form::select('tahun_umkm', $tahun, request()->get('tahun_umkm'), ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartWrapper">
                        <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
                            <div style="width: 3000px; height: 300px">
                                <canvas id="umkmChart" height="300" width="0"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/select2/dist/css/select2.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/admin/chart.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $('select[name=bulan_transaksi], select[name=tahun_transaksi]').on('change', function() {
        var bulan = $('select[name=bulan_transaksi]').val();
        var tahun = $('select[name=tahun_transaksi]').val();
        let url = new URL(window.location);
        let params = new URLSearchParams(url.search);

        if (tahun) {
            params.set('tahun_transaksi', tahun);
        } else {
            params.delete('tahun_transaksi');
        }
        if (bulan) {
            params.set('bulan_transaksi', bulan);
        } else {
            params.delete('bulan_transaksi');
        }
        params = params.toString();
        url = window.location.origin + window.location.pathname;
        window.location.href = `${url}?${params}`
    })
    $('select[name=bulan_umkm], select[name=tahun_umkm]').on('change', function() {
        var bulan = $('select[name=bulan_umkm]').val();
        var tahun = $('select[name=tahun_umkm]').val();
        let url = new URL(window.location);
        let params = new URLSearchParams(url.search);

        if (tahun) {
            params.set('tahun_umkm', tahun);
        } else {
            params.delete('tahun_umkm');
        }
        if (bulan) {
            params.set('bulan_umkm', bulan);
        } else {
            params.delete('bulan_umkm');
        }
        params = params.toString();
        url = window.location.origin + window.location.pathname;
        window.location.href = `${url}?${params}`
    })
    // statistik lengkung
    var statistics_chart = document.getElementById("transaksiChart").getContext('2d');
    var tanggal = ['{!! $tanggal_transaksi !!}'];
    var data = {
        !!$transaksi!!
    };
    var myChart = new Chart(statistics_chart, {
        type: 'line'
        , data: {
            labels: tanggal
            , datasets: [{
                label: 'Transaksi'
                , data: data
                , borderWidth: 4
                , backgroundColor: 'transparent'
                , borderColor: '#6777ef'
                , pointBackgroundColor: '#ffffff'
                , pointRadius: 4
            }]
        }
        , options: {
            legend: {
                display: false
            }
            , scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false
                        , color: '#f2f2f2'
                    , }
                    , ticks: {
                        beginAtZero: true
                        , stepSize: 30
                    }
                }]
                , xAxes: [{
                    gridLines: {
                        color: '#fbfbfb'
                        , lineWidth: 2
                    }
                }]
            }
        , }
    });

    // statistik bar
    var ctx = document.getElementById("umkmChart").getContext('2d');
    var data = {
        !!$umkm!!
    };
    var myChart = new Chart(ctx, {
        type: 'bar'
        , data: {
            labels: ['{!! $tanggal_umkm !!}']
            , datasets: [{
                label: 'UMKM Terdaftar'
                , data: data
                , borderWidth: 2
                , backgroundColor: '#6777ef'
                , borderColor: '#6777ef'
                , pointBackgroundColor: '#ffffff'
                , pointRadius: 4
            }]
        }
        , options: {
            legend: {
                display: false
            }
            , scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false
                        , color: '#f2f2f2'
                    , }
                    , ticks: {
                        beginAtZero: true
                        , stepSize: 10
                    }
                }]
                , xAxes: [{
                    gridLines: {
                        color: '#fbfbfb'
                        , lineWidth: 2
                    }
                }]
            }
        , }
    });
</script>
@endpush