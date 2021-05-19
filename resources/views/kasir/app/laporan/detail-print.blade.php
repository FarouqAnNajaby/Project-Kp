<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Kasir Lamongan Mart</title>

    @include('admin.partials.stylesheet')
</head>


<body>
    <section class="section">
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
                            @if($data->jenis == 'online')
                            <div class="col-md-6">
                                <address>
                                    <strong>Pemesan:</strong><br>
                                    {{ $data->User->nama }}<br>
                                    {{ $data->User->email }}<br>
                                    {{ $data->User->nomor_telepon }}
                                </address>
                            </div>
                            @endif
                            <div class="col-md-6 ml-auto text-md-right">
                                <address>
                                    <strong>Tanggal Transaksi:</strong><br>
                                    {{ $data->formatted_tanggal }}<br><br>
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
                                        <td class="text-right">
                                            {{ $item->total }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            @if($data->jenis == 'online')
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
                            <div class="col-lg-4 col-md-4 col-12 text-right ml-auto">
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
    </section>
    @include('admin.partials.js')
    <script>
        window.onload = function() {
            window.print();
            setTimeout(window.close, 0);
        }
    </script>
</body>
</html>