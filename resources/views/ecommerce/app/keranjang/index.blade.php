@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('ecommerce.index') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="{{ route('ecommerce.cart.index') }}">Keranjang</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUK</th>
                            <th>NAMA</th>
                            <th class="text-center">HARGA</th>
                            <th class="text-center">JUMLAH</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalOut = 0;
                        @endphp
                        @forelse ($data as $index => $item)
                        @if($item->Barang->stok > 0)
                        @php
                        $total += $item->Barang->harga * $item->jumlah;
                        @endphp
                        @elseif($item->Barang->stok == 0)
                        @php
                        $totalOut++;
                        $outOfStock = true;
                        @endphp
                        @endif
                        <tr @if($item->Barang->stok == 0)data-toggle="tooltip" title="Stok Kosong"@endif>
                            <td class="image" data-title="Produk">
                                @if($item->Barang->stok == 0)
                                <img src="{{ asset('storage/barang/' . $item->Barang->Foto()->where('is_highlight', 1)->first()->file) }}" alt="{{ $item->Barang->nama }}" class="img-grey">
                                @else
                                <a href="{{ route('ecommerce.barang.show', [$item->Barang->kode, $item->Barang->slug]) }}" target="_blank">
                                    <img src="{{ asset('storage/barang/' . $item->Barang->Foto()->where('is_highlight', 1)->first()->file) }}" alt="{{ $item->Barang->nama }}">
                                </a>
                                @endif
                            </td>
                            <td class="product-des" data-title="Nama">
                                @if($item->Barang->stok == 0)
                                <a href="javascript:;" class="font-weight-bold text-strikethrough">
                                    {!! $item->Barang->name_limitted2 !!}
                                </a>
                                @else
                                <a href="{{ route('ecommerce.barang.show', [$item->Barang->kode, $item->Barang->slug]) }}" class="font-weight-bold" target="_blank">
                                    {!! $item->Barang->name_limitted2 !!}
                                </a>
                                @endif
                            </td>
                            <td class="price" data-title="Price">
                                @if($item->Barang->stok == 0)
                                <span class="text-strikethrough">{{ $item->Barang->rp_harga }}</span>
                                @else
                                <span>{{ $item->Barang->rp_harga }}</span>
                                @endif
                            </td>
                            <td class="qty text-center" data-title="Qty">
                                @if($item->Barang->stok == 0)
                                <span class="text-danger font-weight-bold">Stok Kosong</span>
                                @else
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number minus-jumlah" data-type="minus" data-field="quantity[{{ $index }}]" data-uuid="{{ $item->uuid }}" data-max="{{ $item->Barang->stok }}">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity[{{ $index }}]" class="input-number" data-min="1" data-max="{{ $item->Barang->stok }}" value="{{ $item->jumlah }}" data-uuid="{{ $item->uuid }}" autocomplete="off">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number plus-jumlah" data-type="plus" data-field="quantity[{{ $index }}]" data-uuid="{{ $item->uuid }}" data-max="{{ $item->Barang->stok }}">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td class="total-amount" data-title="Total">
                                @if($item->Barang->stok == 0)
                                <span>Rp0,00</span>
                                @else
                                <span class="sub-total">{{ $item->sub_total }}</span>
                                @endif
                            </td>
                            <td class="action" data-title="Remove">
                                {!! Form::open(['route' => 'ecommerce.cart.destroy', 'method' => 'delete']) !!}
                                {!! Form::hidden('uuid', $item->uuid) !!}
                                <a href="javascript:;" class="delete-cart"><i class="ti-trash remove-icon"></i></a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">Keranjang Kamu Masih Kosong...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-4 col-md-7 col-12 ml-auto">
                            <div class="right">
                                @if($total > 0)
                                <ul>
                                    <li>Subtotal<span id="subtotal">Rp{{ number_format($total, 2, ',', '.') }}</span></li>
                                </ul>
                                <div class="button5">
                                    @if($outOfStock)
                                    <button class="btn out-of-stock">Checkout</button>
                                    @else
                                    <a href="{{ route('ecommerce.checkout.index') }}" class="btn">Checkout</a>
                                    @endif
                                    <a href="{{ route('ecommerce.index') }}" class="btn">Lanjutkan Belanja</a>
                                </div>
                                @else
                                <div class="button5">
                                    <a href="{{ route('ecommerce.index') }}" class="btn">Lanjutkan Belanja</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript-custom')
<script>
    $('.delete-cart').on('click', function(e) {
        e.preventDefault();
        let $this = $(this)
        swal({
                icon: 'warning'
                , title: 'Hapus'
                , text: 'Hapus barang ini dari Keranjang?'
                , dangerMode: true
                , buttons: true
            })
            .then((result) => {
                if (result) {
                    $this.parent().submit();
                }
            })
    })
    let csrf_token = $('meta[name=csrf-token]').attr('content');
    let url = "{{ route('ecommerce.cart.update') }}";
    let timeout = null
    $('.minus-jumlah, .plus-jumlah').on('click', function() {
        let uuid = $(this).data('uuid')
        let jumlah = $(this).parent().parent().find('input[class=input-number]').val();
        let subTotal_el = $(this).parent().parent().parent().next().find('.sub-total');
        let max_stok = $(this).data('max');
        if (jumlah <= 0 || jumlah > max_stok) {
            return false;
        }
        ajaxRequest(uuid, jumlah, subTotal_el);
    });
    $('.input-number').on('keyup', function() {
        clearTimeout(timeout);
        let uuid = $(this).data('uuid')
        let jumlah = $(this).val();
        let max_stok = $(this).data('max');
        let subTotal_el = $(this).parent().parent().next().find('.sub-total');
        if (jumlah <= 0 || jumlah > max_stok) {
            return false;
        }
        timeout = setTimeout(function() {
            ajaxRequest(uuid, jumlah, subTotal_el);
        }, 1000);
    })
    const ajaxRequest = (uuid, jumlah, subTotal_el) => {
        $.ajax({
            url: url
            , data: {
                uuid: uuid
                , jumlah: jumlah
            }
            , type: 'PATCH'
            , headers: {
                'X-CSRF-TOKEN': csrf_token
            }
            , dataType: 'json'
            , beforeSend: function() {
                $('button, input').attr('disabled', true);
            }
            , complete: function() {
                $('button, input').removeAttr('disabled');
            }
            , success: function(response) {
                subTotal_el.html(response.msg.sub_total);
                $('#subtotal').html(response.msg.total);
            }
            , error: function(xhr, status, error) {
                if (xhr.responseText != "") {
                    var err = JSON.parse(xhr.responseText)
                    swal({
                        icon: 'error'
                        , title: xhr.status == 403 ? 'Gagal' : "Terjadi Kesalahan!"
                        , text: err.msg.jumlah ? err.msg.jumlah[0] : (err.msg || '')
                    });
                }
            }
        })
    }
    @if($outOfStock)
    $('.out-of-stock').click(function(e) {
        e.preventDefault()
        e.stopPropagation();
        let url = "{{ route('ecommerce.checkout.index') }}";
        let text = "Terdapat {{ $totalOut }} barang yang tidak dapat diproses.";
        console.log(text);
        swal({
                icon: 'warning'
                , title: 'Apakah anda yakin?'
                , text: text
                , buttons: true
            })
            .then((result) => {
                if (result) {
                    window.location.href = url
                }
            })
    });
    @endif
</script>
@endpush