@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li>
                            <a href="/index.php">Home<i class="ti-arrow-right"></i></a>
                        </li>
                        <li class="active">
                            <a href="/history.php">Riwayat Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="shopping-cart section bg-white">
    <div class="container">
        <div class="row">
            @include('ecommerce.partials.sidebar')
            <div class="col-lg-9 col-sm-9 col-12">
                <div class="table-responsive">
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th class="text-center">KODE TRANSAKSI</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">JUMLAH BARANG</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center">TANGGAL TRANSAKSI</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="product-des" data-title="Kode Transaksi">
                                    <a href="{{ route('ecommerce.history.show', $item->kode) }}" class="text-primary">#{{ $item->kode }}</a>
                                </td>
                                <td class="text-center" data-title="Status">
                                    <span class="badge badge-{{ $item->status == 'selesai' ? 'success' : ($item->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td class="text-center" data-title="Jumlah">
                                    {{ $item->TransaksiBarang()->count() }}
                                </td>
                                <td class="total-amount" data-title="Total">
                                    {{ $item->rp_total }}
                                </td>
                                <td class="text-center" data-title="Tanggal Transaksi">
                                    {{ $item->formatted_tanggal_ecommerce }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection