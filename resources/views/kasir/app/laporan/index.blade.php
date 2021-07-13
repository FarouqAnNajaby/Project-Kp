@extends('admin.layout.app')

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
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Pending</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($pending, 0, '', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($selesai, 0, '', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Batal</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($batal, 0, '', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="summary">
                    <div class="summary-info bg-primary">
                        <h4 class="text-light" id="pendapatan-amount">{{ $pendapatan }}</h4>
                        <div class="text-light font-weight-bold" id="pendapatan-desc">Total Pendapatan per-Tahun {{ date('Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Transaksi</h4>
                    </div>
                    <div class="card-body ">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                {!! Form::select('status', ['pending' => 'Pending', 'selesai' => 'Selesai', 'batal' => 'Batal'], null, ['placeholder' => 'Status', 'class' => 'form-control select2']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::select('jenis', ['online' => 'Transaksi Online', 'offline' => 'Transaksi Offline'], null, ['placeholder' => 'Jenis Transaksi', 'class' => 'form-control select2']) !!}
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::select('tahun', $tahun, date('Y'), ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::select('bulan', $bulan, null, ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                                    </div>
                                    <div class="col-md-4" id="combobox-tgl">
                                        {!! Form::select('hari', [], null, ['placeholder' => 'Tanggal', 'class' => 'form-control select2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table table-striped white-space-nowrap']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Alasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Alasan</label>
                    <div class="input-group">
                        {!! Form::select('alasan', [1 => 'Stok barang tidak mencukupi', 2 => 'Bukti transfer tidak valid', 3 => 'Jumlah yang dibayarkan kurang atau tidak sesuai'], null, ['placeholder' => '-------Pilih-------', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save">Kirim</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Buttons-1.7.0/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Buttons-1.7.0/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush

@push('javascript-custom')
<script>
    $("table").on('draw.dt', function() {
        $('.tooltip.fade.top.in').hide();
        $('[data-toggle=tooltip]').tooltip({
            container: 'body'
        });
        $('.transaksi-batal').on('click', function() {
            let uuid = $(this).data('uuid');
            $('.modal').modal('show').attr('data-uuid', uuid);
        })
    });
    $(document).ready(function() {
        $("select[name=bulan], select[name=tahun], select[name=status], select[name=hari], select[name=jenis]").on('change', function() {
            $('#laporantransaksi-table').DataTable().draw();
        })
        $('#save').on('click', function() {
            let uuid = $('.modal').data('uuid');
            let alasan = $('select[name=alasan]').val();
            if (uuid && alasan) {
                swal({
                        title: 'Apakah Anda yakin?'
                        , text: 'Pastikan alasan sudah benar & telah mentransfer kembali sesuai dengan nominal transaksi.'
                        , icon: 'warning'
                        , dangerMode: true
                        , buttons: true
                    })
                    .then((result) => {
                        if (result) {
                            let url = "{{ route('kasir.laporan.whatsapp', ':uuid') }}"
                            url = url.replace(':uuid', uuid);
                            $.ajax({
                                url: url
                                , data: {
                                    alasan: alasan
                                }
                                , type: 'POST'
                                , headers: {
                                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                }
                                , dataType: 'json'
                                , success: function(response) {
                                    response = response.msg;
                                    window.location.href = `whatsapp://send?phone=${response.nomor_telepon}&text=${response.text}`;
                                    $('.modal').modal('hide')
                                }
                                , error: function(xhr, status, error) {
                                    if (xhr.responseText != "") {
                                        var err = JSON.parse(xhr.responseText)
                                        swal({
                                            icon: 'error'
                                            , title: "Terjadi Kesalahan!"
                                            , text: err.msg.alasan[0] || ''
                                        });
                                    }
                                }
                            })
                        }
                    })
            }
        })
        $('select[name=bulan], select[name=tahun]').on('change', function() {
            var tahun = $('select[name=tahun]').val()
            var bulan = $("select[name=bulan]").val()
            var opt = '<option selected="selected" value="">Tanggal</option>';
            if (tahun && bulan) {
                let date = new Date(tahun, bulan, 0).getDate();
                let days = [];
                for (var i = 1; i <= date; i++) {
                    opt += "<option value=\"" + i + "\">" + i + "</option>";
                }
                $("select[name=hari]").html(opt);
            } else {
                $("select[name=hari]").html(opt);
            }
        })
        $('select[name=hari], select[name=bulan], select[name=tahun]').on('change', function() {
            var hari = $('select[name=hari]').val();
            if (!hari) {
                hari = 0;
            }
            var bulan = $('select[name=bulan]').val();
            if (!bulan) {
                bulan = 0;
            }
            var tahun = $('select[name=tahun]').val();
            if (!tahun) {
                tahun = 0;
            }
            let csrf_token = $('meta[name=csrf-token]').attr('content');
            let url = window.location.href + "/getPendapatan";
            $.ajax({
                url: url
                , data: {
                    hari: hari
                    , bulan: bulan
                    , tahun: tahun
                }
                , type: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': csrf_token
                }
                , success: function(response) {
                    $("#pendapatan-amount").html(response.amount)
                    $("#pendapatan-desc").html(response.description)
                }
                , error: function(xhr, status, error) {
                    if (xhr.responseText != "") {
                        var err = JSON.parse(xhr.responseText)
                        swal({
                            icon: 'error'
                            , title: "Gagal!"
                            , text: "Terjadi Kesalahan dalam Mendapatkan Pendapatan."
                        })
                    }
                }
            });
        });
    })
</script>
@endpush