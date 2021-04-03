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
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama UMKM</th>
                <th>Kategori</th>
                <th>Nama Pemilik</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        @php
        $search = request()->search['value'];
        $kategori = request()->kategori;
        $data = new \App\Models\UMKM;
        if($search) {
        $data = $data->where(function($query) use($search) {
        $query->orWhere('nama', 'LIKE', "%$search%")
        ->orWhere('nomor_telp', 'LIKE', "%$search%")
        ->orWhere('nama_pemilik', 'LIKE', "%$search%");
        });
        }
        if($kategori) {
        $data = $data->where('uuid_umkm_kategori', $kategori);
        }
        $data = $data->get();
        @endphp
        @foreach($data as $row)
        <tr>
            <td class="text-center">
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->UMKM_Kategori->nama }}</td>
            <td>{{ $row->nama_pemilik }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ \Propaganistas\LaravelPhone\PhoneNumber::make($row->nomor_telp)->formatNational() }}</td>
            <td>{{ $row->alamat }}</td>
        </tr>
        @endforeach
    </table>
    {{-- <script>
        window.print();
    </script> --}}
</body>

</html>