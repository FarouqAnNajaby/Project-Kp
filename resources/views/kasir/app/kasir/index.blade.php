@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb title="Kasir">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Kasir</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-8 col-sm-7 col-lg-7">
                <div class="card block-ui">
                    <div class="card-header">
                        <h4>Input Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori', 'Kategori', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::select('kategori', $kategori, null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4" id="nama-barang-combobox" style="display: none;">
                            {!! Form::label('nama_barang', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::select('nama_barang', [], null, ['placeholder'=>'Pilih', 'Class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('jumlah', 'Jumlah Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::number('jumlah', 0, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4" id="stok-barang" style="display: none;">
                            {!! Form::label('stok', 'Stok Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::text('stok', null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4" id="harga-barang" style="display: none;">
                            {!! Form::label('harga', 'Harga Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::text('harga', null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                {!! Form::submit('Tambah', ['class' => 'btn btn-primary', 'id' => 'add-barang']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5 col-lg-5">
                <div class="card block-ui">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#deskripsi-content">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#foto-content">Foto</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active text-justify" id="deskripsi-content"></div>
                            <div class="tab-pane fade pb-0" id="foto-content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card block-ui">
                    <div class="card-header">
                        <h4>Detail Pembelian</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-table"></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <b>Total</b>
                                        </td>
                                        <td class="text-center" id="total_jumlah">0</td>
                                        <td colspan="2" id="total_harga">Rp0,00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {!! Form::open(['route' => 'kasir.ajax.store', 'id' => 'submit-cart']) !!}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('pembayaran', 'Pembayaran') !!}
                                    {!! Form::text('pembayaran', null, ['class' => 'form-control', 'val' => 0, 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('uang_kembali', 'Uang Kembalian') !!}
                                    {!! Form::text('uang_kembali', null, ['class' => 'form-control', 'disabled' => 'true', 'value' => 'Rp0,00']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-edit-cart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <div class="input-group">
                        <input disabled type="text" class="form-control" id="modal-nama-barang">
                    </div>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="modal-jumlah-barang">
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <div class="input-group">
                        <input disabled type="text" class="form-control" id="modal-harga-barang">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save-edit-cart">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/jquery-ui-smoothness/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/jquery-ui-smoothness/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/blockui-2.70/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
@endpush

@push('javascript-custom')

<script>
    new Cleave('#pembayaran', {
        numeralDecimalMark: ','
        , delimiter: '.'
        , numeral: true
    });
    var nama_barang_cbx = $('#nama-barang-combobox')
    var stok_barang = $('#stok-barang')
    var harga_barang = $('#harga-barang')
    var nama_barang = $('#nama_barang')
    var deskripsi = $('#deskripsi-content')
    var foto = $("#foto-content")
    var jumlah = $("#jumlah")

    $("#kategori").on('select2:select', function(e) {
        foto.html('')
        jumlah.val(0)
        stok_barang.slideUp();
        harga_barang.slideUp();
        nama_barang.val('').trigger('change')
        deskripsi.html('').css('height', 0).getNiceScroll().remove()

        var data = e.params.data.id;
        var url = "{{ route('kasir.ajax.getBarangByKategori', ':id') }}"
        url = url.replace(':id', data);
        if (data) {
            nama_barang_cbx.slideDown()
            nama_barang.select2({
                ajax: {
                    // delay: 500
                    url: url
                    , processResults: function(response) {
                        return {
                            results: response.message.data
                        }
                    }
                }
            })
        } else {
            nama_barang_cbx.slideUp()
            nama_barang.select2('destroy')
        }
    })

    nama_barang.on('select2:select', function(e) {
        foto.html('');
        jumlah.val(0)
        stok_barang.slideUp();
        harga_barang.slideUp();
        var data = e.params.data.id
        if (data) {
            var url = "{{ route('kasir.ajax.getDetailBarang', ':id') }}"
            url = url.replace(':id', data);
            $.ajax({
                url: url
                , beforeSend: function() {
                    $('.block-ui').block({
                        theme: true
                        , message: null
                    })
                }
                , complete: function() {
                    $('.block-ui').unblock()
                }
                , success: function(response) {
                    var data = response.message.data;
                    stok_barang.slideDown();
                    $('#stok').val(data.stok)
                    harga_barang.slideDown();
                    $('#harga').val(convertToRupiah(data.harga))
                    deskripsi.html(data.deskripsi).css({
                        height: 380
                    }).niceScroll();
                    if (data.foto.length >= 1) {
                        foto.append('<div class="owl-carousel owl-theme slider"></div>')
                        for (var i = 0; i < data.foto.length; i++) {
                            $('.owl-carousel').append('<div><img class="img-cover" src="storage/barang/' + data.foto[i] + '"/></div>')
                        }
                        $('.owl-carousel').owlCarousel({
                            loop: true
                            , autoplay: true
                            , autoplayTimeout: 3000
                            , items: 1
                            , nav: true
                            , navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
                        });
                    } else {
                        foto.append('<p>Barang belum memiliki foto.</p>')
                    }
                }
            })
        } else {
            stok_barang.slideUp();
            harga_barang.slideUp();
            deskripsi.html('').css('height', 0).getNiceScroll().remove()
            foto.html('')
        }
    })
</script>

<script>
    let cart = JSON.parse(localStorage.getItem('cartKasir'))
    let detail_table = $('#detail-table')
    var i = 0;
    var total_harga = 0
    var total_jml = 0;
    $(window).on('load', function() {
        if (!Array.isArray(cart) || cart == null) {
            cart = [];
        }
        reloadDataOnTable(cart)
    })

    $('#add-barang').on('click', function() {
        if (nama_barang.val()) {
            if (jumlah.val() > 0) {
                var checkIfBarangExists = cart.filter(c => c.id == nama_barang.val());
                if (!checkIfBarangExists.length) {
                    if (!cart || !cart.length) {
                        cart = [];
                    }
                    var url = "{{ route('kasir.ajax.getDetailBarang', ':id') }}"
                    url = url.replace(':id', nama_barang.val());
                    $.ajax({
                        url: url
                        , complete: function() {
                            jumlah.val(0);
                            nama_barang.val(null).trigger('change');
                            deskripsi.html('').css('height', 0).getNiceScroll().remove()
                            foto.html('')
                            stok_barang.slideUp();
                            $('#stok').val('')
                            harga_barang.slideUp();
                            $('#harga').val('')
                        }
                        , success: function(response) {
                            var data = response.message.data;
                            i++;
                            detail_table.append('<tr>' +
                                '<td class="p-0 text-center">' + i + '</td>' +
                                '<td>' + data.nama + '</td>' +
                                '<td class="p-0 text-center">' + jumlah.val() + '</td>' +
                                '<td>' + convertToRupiah(data.harga) + '</td>' +
                                '<td class = "p-0 text-center">' +
                                '<button class="btn btn-primary btn-icon mr-1 edit-modal" data-id="' + nama_barang.val() + '" data-toggle="tooltip" title="Ubah">' +
                                '<i class="fas fa-pen"></i>' +
                                '</button>' +
                                '<button class="btn btn-danger btn-icon delete" data-id="' + nama_barang.val() + '" data-toggle="tooltip" title="Hapus">' +
                                '<i class="fas fa-times"></i>' +
                                '</button>' +
                                '</td></tr>');
                            cart.push({
                                id: nama_barang.val()
                                , text: data.nama
                                , jumlah: parseInt(jumlah.val())
                                , harga: data.harga
                            });
                            getTotalJumlahAndHarga(cart);
                            updateCart(cart);
                            deleteEditModal();
                        }
                    })
                } else {
                    swal('Gagal', 'Barang sudah ditambahkan dibawah.', 'error')
                }
            } else {
                swal('Gagal', 'Jumlah barang minimal 1.', 'error')
            }
        }
    })

    $('#modal-edit-cart').on('hidden.bs.modal', function(event) {
        $(this).removeAttr('data-id');
        $('#modal-nama-barang').val('')
        $('#modal-jumlah-barang').val('')
        $('#modal-harga-barang').val('')
    })

    $('#save-edit-cart').on('click', function() {
        var newJumlah = $('#modal-jumlah-barang').val();
        var id = $(this).parent().parent().parent().parent().data('id');
        if (newJumlah >= 1 && id) {
            var current = cart.filter(c => c.id == id)[0];
            current.jumlah = newJumlah;
            cart.forEach(function(data, index) {
                if (cart[index].id == id) {
                    cart[index] = current;
                }
            })
            updateCart(cart)
            reloadDataOnTable(cart)
            $('#modal-edit-cart').modal('hide');
            swal('Sukses', 'Data berhasil diubah.', 'success');
        } else {
            swal('Gagal', 'Jumlah barang minimal 1.', 'error');
        }
    })

    $('#pembayaran').on('keyup', function() {
        var pembayaran = $(this).val().replace(/[^0-9]+/g, '');
        var kembali = pembayaran - total_harga;
        if (kembali >= 0) {
            $('#uang_kembali').val(convertToRupiah(kembali));
        } else {
            $('#uang_kembali').val('Rp0,00')
        }
    })

    $('#submit-cart').on('submit', function(e) {
        e.preventDefault();
        var pembayaran = toNumber($('#pembayaran').val());
        var total = getTotal(cart)
        if (cart.length && total > 0) {
            if (Number.isInteger(pembayaran) && pembayaran >= total) {
                var url = $(this).attr('action');
                var csrf_token = $(this).find('input[name=_token]').val();
                $.ajax({
                    url: url
                    , data: {
                        cart: cart
                    }
                    , type: 'POST'
                    , headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                    , dataType: 'json'
                    , beforeSend: function() {
                        $('.block-ui').block({
                            theme: true
                            , message: null
                        })
                    }
                    , complete: function() {
                        $('.block-ui').unblock()
                    }
                    , success: function(response) {
                        resetCart();
                        let uuid = response.msg.uuid
                        var urlLaporan = "{{ route('kasir.laporan.show', ':uuid') }}";
                        urlLaporan = urlLaporan.replace(':uuid', uuid);
                        swal({
                                icon: 'success'
                                , title: 'Sukses!'
                                , text: 'Transaksi berhasil dilakukan.'
                            })
                            .then((result) => {
                                if (result) {
                                    window.open(urlLaporan)
                                }
                            })
                    }
                    , error: function(xhr, status, error) {
                        if (xhr.responseText != "") {
                            var err = JSON.parse(xhr.responseText)
                            swal({
                                icon: 'error'
                                , title: "Terjadi Kesalahan!"
                                , text: err.msg || ''
                            });
                        }
                    }
                })
            }
        }
    })

    const resetCart = () => {
        cart = [];
        updateCart(cart);
        reloadDataOnTable(cart)
        $('#uang_kembali').val('');
        $('#pembayaran').val('')
    }

    const getTotal = (arr) => {
        total_harga = 0;
        total_jml = 0;
        if (arr.length) {
            arr.forEach(function(data) {
                total_harga += data.harga * parseInt(data.jumlah);
            })
        }
        return total_harga;
    }

    const getTotalJumlahAndHarga = (arr) => {
        total_harga = 0;
        total_jml = 0;
        if (arr.length) {
            arr.forEach(function(data) {
                total_jml += parseInt(data.jumlah);
                total_harga += data.harga * parseInt(data.jumlah);
            })
            $('#total_jumlah').html(total_jml);
            $('#total_harga').html(convertToRupiah(total_harga));
        } else {
            $('#total_jumlah').html(0);
            $('#total_harga').html('Rp0,00');
            $('#pembayaran').val(0);
            $('#uang_kembali').val('Rp0,00');
        }
    }

    const updateCart = (arr) => localStorage.setItem('cartKasir', JSON.stringify(arr));

    const reloadDataOnTable = (arr) => {
        i = 0;
        detail_table.html('');
        if (arr.length) {
            arr.forEach(function(data, index) {
                i++;
                detail_table.append('<tr>' +
                    '<td class="p-0 text-center">' + i + '</td>' +
                    '<td>' + data.text + '</td>' +
                    '<td class="p-0 text-center">' + data.jumlah + '</td>' +
                    '<td>' + convertToRupiah(data.harga) + '</td>' +
                    '<td class = "p-0 text-center">' +
                    '<button class="btn btn-primary btn-icon mr-1 edit-modal" data-id="' + data.id + '" data-toggle="tooltip" title="Ubah">' +
                    '<i class="fas fa-pen"></i>' +
                    '</button>' +
                    '<button class="btn btn-danger btn-icon delete" data-id="' + data.id + '" data-toggle="tooltip" title="Hapus">' +
                    '<i class="fas fa-times"></i>' +
                    '</button>' +
                    '</td></tr>');
            })
            deleteEditModal();
        }
        getTotalJumlahAndHarga(arr);
    }

    const deleteEditModal = () => {
        $('.edit-modal').on('click', function() {
            var id = $(this).data('id');
            var modal_data = cart.filter(c => c.id == id)[0];
            $('#modal-nama-barang').val(modal_data.text)
            $('#modal-jumlah-barang').val(modal_data.jumlah)
            $('#modal-harga-barang').val(convertToRupiah(modal_data.harga))
            $('#modal-edit-cart').modal('show');
            $("#modal-edit-cart").attr('data-id', id);
        });

        $('.delete').on('click', function() {
            let $this = $(this);
            swal({
                    title: 'Hapus barang ini?'
                    , icon: 'warning'
                    , dangerMode: true
                    , buttons: true
                })
                .then((result) => {
                    if (result) {
                        cart = cart.filter(c => c.id != $this.data('id'));
                        updateCart(cart)
                        reloadDataOnTable(cart)
                        swal('Sukses', 'Barang berhasil dihapus.', 'success');
                    }
                })
        })
    }

    const convertToRupiah = (angka) => {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return 'Rp' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    const toNumber = (num) => parseInt(num.replace(/,.*|[^0-9]/g, ''), 10);
</script>

@endpush