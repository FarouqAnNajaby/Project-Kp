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
    <h4 class="text-center mb-4">LOG BARANG LAMONGAN MART</h4>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        @php
        $search = request()->search['value'];
        $data = \App\Models\BarangLog::with('barang')
        ->select('barang_log.*');
        if($search) {
        $data = $data->where(function($query) use($search) {
        $search = preg_replace("/[^0-9,]/", "", $search);
        if (strpos($search, ',')) {
        $search = trim($search, 0);
        }
        $search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
        if (filter_var($search, FILTER_VALIDATE_INT)) {
        $query->orWhere('harga', 'LIKE', "%$search%");
        }
        });
        }
        $data = $data->get();
        @endphp
        @foreach($data as $row)
        <tr>
            <td class="text-center">
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->Barang->nama }}</td>
            <td>{{ number_format($row->stok, 0, '', '.') }}</td>
            <td>{{ 'Rp' . number_format($row->harga, 2, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($row->created_at)->isoFormat('dddd, Do MMMM YYYY') }}</td>
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>