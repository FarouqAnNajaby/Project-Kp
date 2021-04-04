@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Detail Transaksi" backUrl="{{ route('kasir.transaksi.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('kasir.transaksi.index') }}">Transaksi</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('kasir.transaksi.show', $data->uuid) }}">Detail Transaksi</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row mb-3">
            <div class="col-md-6 col-12 text-right ml-auto">
                {!! Form::open(['route' => ['kasir.transaksi.update', [$data->uuid, 'terima']], 'class' => 'd-inline-block', 'method' => 'patch']) !!}
                <button href="#" class="btn btn-success btn-icon" id="terima" data-toggle="tooltip" title="Terima">
                    <i class="fas fa-check"></i>
                </button>
                {!! Form::close() !!}
                {!! Form::open(['route' => ['kasir.transaksi.update', [$data->uuid, 'tolak']], 'class' => 'd-inline-block', 'method' => 'patch']) !!}
                <button href="#" class="btn btn-danger btn-icon" id="tolak" data-toggle="tooltip" title="Tolak">
                    <i class="fas fa-times"></i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h4>Transaksi</h4>
                            <div class="invoice-number">#{{ $data->kode }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Pemesan:</strong><br>
                                    {{ $data->User->nama }}<br>
                                    {{ $data->User->email }}<br>
                                    {{ $data->User->nomor_telepon }}
                                </address>
                            </div>
                            <div class="col-md-6 ml-auto text-md-right">
                                <address>
                                    <strong>Tanggal Transaksi:</strong><br>
                                    {{ $data->formatted_tanggal_ecommerce }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Daftar Barang</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->TransaksiBarang as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>
                                            {{ $item->Barang->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->rp_harga }}
                                        </td>
                                        <td class="text-center">
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
                            @if($data->uuid_user)
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="section-title">
                                    Bukti Transfer
                                </div>
                                <div class="chocolat-parent">
                                    <a href="{{ asset('storage/bukti-transfer/' . $data->foto_bukti) }}" class="chocolat-image" title="Transaksi #{{ $data->kode }}">
                                        <div>
                                            <img alt="image" src="{{ asset('storage/bukti-transfer/' . $data->foto_bukti) }}" class="img-thumbnail" width="200px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-4 col-md-4 col-12 ml-auto text-right">
                                <hr class="mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">{{ $data->rp_total }}</div>
                                </div>
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
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $('#terima').click(function(e) {
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
    $('#tolak').click(function(e) {
        e.preventDefault();
        let $this = $(this);
        $('.modal').modal('show');
    });
    $('#save').on('click', function() {
        let alasan = $('select[name=alasan]').val();
        if (alasan) {
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
                        url = url.replace(':uuid', "{{ $data->uuid }}");
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
                                            url = "{{ route('kasir.laporan.show', $data->uuid) }}";
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
</script>
@endpush