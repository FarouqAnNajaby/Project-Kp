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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <select class="form-control selectric">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="#" class="btn btn-primary">Tambah</a>
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
                                    <th>Name Barang</th>
                                    <th class="p-0 text-center">Jumlah</th>
                                    <th>Harga</th>
                                    <th>Action</th>
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
                                    <td><a href="#" class="btn btn-danger">Batal</a></td>
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
                                    <td><a href="#" class="btn btn-danger">Batal</a></td>
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
                                    <td><a href="#" class="btn btn-danger">Batal</a></td>
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
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="#" class="btn btn-primary">Kirim</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
