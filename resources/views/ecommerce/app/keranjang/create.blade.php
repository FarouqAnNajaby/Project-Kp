@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li>
                            <a href="{{ route('ecommerce.index') }}">
                                Home<i class="ti-arrow-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ecommerce.cart.index') }}">
                                Keranjang<i class="ti-arrow-right"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('ecommerce.checkout.index') }}">Checkout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="shop checkout section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="checkout-form">
                    <h2>Pembayaran </h2>
                    <p>Untuk menyelesaikan pembayaran, silahkan transfer ke nomor rekening yang tertera dan mengunggah foto bukti pembayaran.</p>
                    <div class="text-center my-5">
                        <h1>629301009456536</h1>
                        <h6>BRI A/N Intan Juniarti Puspita Sari</h6>
                    </div>
                    <div class="order-details mb-5">
                        <div class="single-widget">
                            <h2>BARANG</h2>
                            <div class="content">
                                <ul>
                                    @foreach ($data as $item)
                                    @php
                                    $total += $item->harga * $item->jumlah;
                                    @endphp
                                    <li>
                                        <a href="{{ route('ecommerce.barang.show', [$item->kode, $item->slug]) }}" target="_blank">
                                            {{ $item->nama }}
                                        </a>
                                        <span>Rp{{ number_format($item->harga, 2, ',', '.') }}</span>
                                    </li>
                                    @endforeach
                                    <li class="last	">
                                        Total yang harus di bayar
                                        <span class="font-weight-bold">Rp{{ number_format($total, 2, ',', '.') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="checkout-form">
                    <h2>Pembayaran </h2>
                    <p>Unggah foto bukti pembayaran anda di bawah ini.<br>Bila terjadi kesalahan dalam jumlah pembayaran, silahkan hubungi nomor yang tertera dibawah.</p>
                    {!! Form::open(['route' => 'ecommerce.checkout.store','files' => true]) !!}
                    <div class='row'>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3" id="bukti-transfer-col">
                                <div id="img-bukti-transfer"></div>
                            </div>
                            <div class="single-widget mb-3">
                                <div class="content">
                                    <div class="button">
                                        {!! Form::file('bukti_transfer', ['class' => 'd-none', 'accept' => 'image/jpeg,image/png', 'required']) !!}
                                        @error('bukti_transfer')
                                        <p class="text-danger my-0 text-small">{{ $message }}</p>
                                        @enderror
                                        <button class="btn" id="choose-file">Pilih Foto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-2 col-12 ml-auto">
                            <div class="single-widget get-button px-0">
                                <div class="content">
                                    <div class="button">
                                        <button class="btn" id="sendValidation">Kirim Validasi Pembayaran</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('javascript-custom')
<script>
    const bukti_transfer_col = $("#bukti-transfer-col")
    const bukti_transfer = $("input[name=bukti_transfer]")
    const maxAllowedSize = 3 * 1024 * 1024;
    const invalidMaxSizeAlert = () => swalAlert('Ukuran foto maksimal 3MB.')
    const invalidExtAlert = () => swalAlert('Ekstensi file hanya boleh berupa jpeg, jpg dan png.')
    const resetLogoInput = () => {
        bukti_transfer_col.slideUp();
        $('#img-bukti-transfer').css('background-image', '');
    }
    const swalAlert = (text) => swal('Terjadi Kesalahan', text, 'error');

    $.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$', "i")).test($(this).val());
    }
    $('#choose-file').on('click', function(e) {
        e.preventDefault();
        bukti_transfer.click();
    });

    bukti_transfer.on('change', function() {
        const $this = this
        if (this.files && this.files[0]) {
            if (bukti_transfer.hasExtension(['.jpeg', '.jpg', '.png'])) {
                if ($this.files[0].size < maxAllowedSize) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        bukti_transfer_col.slideDown();
                        $('#img-bukti-transfer').css('background-image', 'url(' + e.target.result + ')');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    invalidMaxSizeAlert()
                    resetLogoInput()
                }
            } else {
                invalidExtAlert()
                resetLogoInput()
            }
        } else {
            resetLogoInput()
        }
    });

    $('#sendValidation').on('click', function(e) {
        e.preventDefault();
        if (bukti_transfer[0].files.length == 0) {
            swal('Gagal!', 'Bukti Transfer wajib dipilih.', 'error');
            return false;
        }
        $(this).form().submit();
    });
</script>
@endpush