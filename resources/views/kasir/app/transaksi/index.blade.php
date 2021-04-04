@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb title="Transaksi">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                        <div class="card-header-form">
                            {!! Form::select('bulan', $bulan, null, ['placeholder' => 'Bulan', 'class' => 'form-control select2']) !!}
                            {!! Form::select('tahun', $tahun, null, ['placeholder' => 'Tahun', 'class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="card-body ">
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
        $('.terima').click(function(e) {
            e.preventDefault();
            let $this = $(this);
            swal({
                    title: 'Pastikan data telah sesuai!'
                    , text: 'Setelah anda konfirmasi, maka tidak dapat dibatalkan.'
                    , icon: 'warning'
                    , dangerMode: true
                    , buttons: true
                })
                .then((result) => {
                    if (result) {
                        $this.parent().submit();
                    }
                })
        });
        $('.tolak').click(function(e) {
            e.preventDefault();
            let $this = $(this);
            $('.modal').modal('show').attr('data-uuid', $this.data('uuid'));
        });
    });
    $(document).ready(function() {
        $("select[name=bulan], select[name=tahun], select[name=status]").on('change', function() {
            $('#transaksi-table').DataTable().draw();
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
                            let url = "{{ route('kasir.transaksi.update', [':uuid', 'tolak']) }}"
                            url = url.replace(':uuid', uuid);
                            $.ajax({
                                url: url
                                , data: {
                                    alasan: alasan
                                }
                                , type: 'PATCH'
                                , headers: {
                                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                }
                                , dataType: 'json'
                                , success: function(response) {
                                    response = response.msg;
                                    console.log(response);
                                    var link = `whatsapp://send?phone=${response.nomor_telepon}&text=${response.text}`;
                                    var msg = document.createElement('p');
                                    msg.innerHTML = 'Transaksi berhasil dibatalkan.<br>Untuk mengkonfirmasi transaksi ke whatsapp pelanggan, silahkan klik link <a href="' + link + '">berikut</a>.'
                                    $('.modal').modal('hide')
                                    swal({
                                            closeOnClickOutside: false
                                            , closeOnEsc: false
                                            , icon: 'success'
                                            , title: 'Sukses!'
                                            , content: msg
                                        })
                                        .then((result) => {
                                            if (result) {
                                                url = "{{ route('kasir.laporan.show', ':uuid') }}";
                                                url = url.replace(':uuid', uuid)
                                                window.location.href = url;
                                            }
                                        })
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
    })
</script>
@endpush