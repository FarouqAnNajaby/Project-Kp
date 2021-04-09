@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li>
                            <a href="{{ route('ecommerce.index') }}">Home<i class="ti-arrow-right"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('ecommerce.history') }}">Riwayat Transaksi<i class="ti-arrow-right"></i></a></a>
                        </li>
                        <li class="active">
                            <a href="{{ route('ecommerce.history.show', $transaksi->kode) }}">Transaksi #{{ $transaksi->kode }}</a>
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
                                <th class="text-center">NAMA BARANG</th>
                                <th class="text-center">JUMLAH</th>
                                <th class="text-center">HARGA</th>
                                <th class="text-center">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td data-title="Nama Barang">
                                    <a href="{{ route('ecommerce.barang.show', [$item->Barang->kode, $item->Barang->slug]) }}" class="text-primary">
                                        {!! Str::limit($item->Barang->nama, 30, '<p class="d-inline-block" data-toggle="tooltip" title="'. $item->Barang->nama . '">...</p>') !!}
                                    </a>
                                </td>
                                <td class="total-amount" data-title="Jumlah">
                                    {{ $item->jumlah }}
                                </td>
                                <td class="text-center" data-title="Harga">
                                    {{ $item->rp_harga }}
                                </td>
                                <td class="text-center" data-title="Total">
                                    {{ $item->total }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="font-weight-bold">Total</td>
                                <td class="font-weight-bold text-center">
                                    {{ number_format($data->sum('jumlah'), 0, '', '.') }}
                                </td>
                                <td class="font-weight-bold text-center">
                                    {{ 'Rp' . number_format($data->sum('harga'), 2, ',', '.') }}
                                </td>
                                <td class="font-weight-bold text-center">
                                    {{ 'Rp' . number_format($data->sum(function($query){ 
										return $query->jumlah * $query->harga; 
									}), 2, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @if($transaksi->status == 'selesai')
                <a href="{{ route('ecommerce.review.index', $transaksi->kode) }}" class="btn text-white">Beri Penilaian</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection