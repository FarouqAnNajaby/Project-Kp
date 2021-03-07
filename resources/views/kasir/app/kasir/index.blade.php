@extends('admin.layout.app')

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')

<section class="section">
    <x-admin-breadcrumb title="Kasir">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Kasir</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Barang</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open() !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori_transaksi', 'Kategori', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('kategori_transaksi', ['pakaian'=>'Pakaian', 'makanan'=>'Makanan', 'minuman'=>'Minumam'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            {!! Form::label('nama_barang_transaksi', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('nama_barang_transaksi', ['Option 1'=>'Option 1', 'Option 2'=>'Option 2', 'Option 3'=>'Option 3'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            {!! Form::label('warna_transaksi', 'Warna', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('warna_transaksi', ['merah'=>'Merah', 'hijau'=>'Hijau', 'kuning'=>'Kuning'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control selectric']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('jumlah_barang_transaksi', 'Jumlah Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::number('jumlah_barang_transaksi', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Pembelian</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th class="p-0 text-center">No</th>
                                    <th class="p-0 text-center">Name Barang</th>
                                    <th class="p-0 text-center">Jumlah</th>
                                    <th class="p-0 text-center">Harga</th>
                                    <th class="p-0 text-center">Action</th>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td>
                                        KUNYIT ASAM ANANDA
                                    </td>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td>
                                        Rp. 5.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" id="modal-5" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        2
                                    </td>
                                    <td>
                                        COKLAT TURQY
                                    </td>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td>
                                        Rp. 7.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        3
                                    </td>
                                    <td>
                                        LE MINERAL 600 ML
                                    </td>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td>
                                        Rp. 3.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <b>Total</b>
                                    </td>
                                    <td class="p-0 text-center">
                                        <b>3</b>
                                    </td>
                                    <td colspan="2">
                                        <b>Rp. 15.000</b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        {!! Form::open() !!}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('pembayaran_transaksi', 'Pembayaran') !!}
                                    {!! Form::number('pembayaran_transaksi', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('uang_kembali_transaksi', 'Uang Kembalian') !!}
                                    {!! Form::number('uang_kembali_transaksi', null, ['class' => 'form-control', 'disabled' => 'true']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form class="modal-part" id="modal-login-part">
    <div class="form-group">
        <label>Nama Barang</label>
        <div class="input-group">
            <input disabled type="text" class="form-control" placeholder="Kunyit Asam Amanda" name="nama">
        </div>
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <div class="input-group">
            <input type="number" class="form-control" placeholder="1" name="jumlah">
        </div>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <div class="input-group">
            <input disabled type="text" class="form-control" placeholder="Rp. 5.000" name="jumlah">
        </div>
    </div>
</form>

@endsection

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
@endpush


@push('javascript-custom')

<script>
    $("#modal-5").fireModal({
		title: 'Edit',
		body: $("#modal-login-part"),
		footerClass: 'bg-whitesmoke',
		autoFocus: false,
		onFormSubmit: function(modal, e, form) {
			// Form Data
			let form_data = $(e.target).serialize();
			console.log(form_data)

			// DO AJAX HERE
			let fake_ajax = setTimeout(function() {
				form.stopProgress();
				modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

				clearInterval(fake_ajax);
			}, 1500);

			e.preventDefault();
		},
		shown: function(modal, form) {
			console.log(form)
		},
		buttons: [{
			text: 'Simpan',
			submit: true,
			class: 'btn btn-primary btn-shadow',
			handler: function(modal) {}
		}]
	});
</script>

@endpush
