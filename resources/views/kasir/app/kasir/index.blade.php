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
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2">
                                    <option>Pilih</option>
                                    <option>Pakaian</option>
                                    <option>Makanan</option>
                                    <option>Minuman</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Barang</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Warna</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric">
                                    <option>Merah</option>
                                    <option>Hijau</option>
                                    <option>Kuning</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Barang</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
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
                                        <button class="btn btn-primary" id="modal-5" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
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
                                        <button class="btn btn-primary" id="modal-5" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
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
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Pembayaran</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Uang Kembalian</label>
                                    <input disabled type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary">Kirim</a>
                        </div>
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
