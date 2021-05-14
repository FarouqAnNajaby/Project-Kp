<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <style>
        body {
            margin: 20px
        }
    </style>
</head>

<body>
    <h4 class="text-center mb-4">LAPORAN TRANSAKSI LAMONGAN MART</h4>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Status</th>
                <th>Total Pembelian</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        @php
        $search = request()->search['value'];
        $kategori = request()->kategori;
        $status = request()->status;
        $bulan = request()->bulan;
        $tahun = request()->tahun;
        $hari = request()->hari;
        $data = new \App\Models\Transaksi;
        if($search) {
        $data = $data->where(function($query) use($search) {
        $search = preg_replace("/[^0-9]/", "", trim($search, 0));
        if (filter_var($search, FILTER_VALIDATE_INT)) {
        $query->where('total', 'LIKE', "%$search%");
        }
        });
        }
        if($kategori) {
        $data = $data->where('uuid_umkm_kategori', $kategori);
        }
        if ($status) {
        $data = $data->where('status', $status);
        }
        if ($bulan) {
        $data = $data->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
        $data = $data->whereYear('created_at', $tahun);
        }
        if ($hari) {
        $data = $data->whereDate('created_at', "$tahun-$bulan-$hari");
        }
        $data = $data->get();
        @endphp
        @foreach($data as $row)
        <tr>
            <td>
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->kode }}</td>
            <td>{{ ucfirst($row->status) }}</td>
            <td>{{ 'Rp' . number_format($row->total, 2, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($row->created_at)->isoFormat('dddd, Do MMMM YYYY') }}</td>
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>