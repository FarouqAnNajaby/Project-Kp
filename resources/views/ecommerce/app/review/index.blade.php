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
                            <a href="{{ route('ecommerce.history') }}">Riwayat Transaksi<i class="ti-arrow-right"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('ecommerce.history.show', $transaksi->kode) }}">Transaksi #{{ $transaksi->kode }}<i class="ti-arrow-right"></i></a>
                        </li>
                        <li class="active">
                            <a href="{{ route('ecommerce.review.index', $transaksi->kode) }}">Penilaian</a>
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
                                <th class="text-center">PENILAIAN</th>
                                <th class="text-center">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td data-title="Nama Barang">
                                    <a href="{{ route('ecommerce.review.create', [$transaksi->kode, $item->uuid]) }}" class="text-primary">
                                        {!! Str::limit($item->Barang->nama, 30, '<p class="d-inline-block" data-toggle="tooltip" title="'. $item->Barang->nama . '">...</p>') !!}
                                    </a>
                                </td>
                                <td class="total-amount" data-title="Penilaian">
                                    {{ $item->Review->nilai ?? 'Belum Dinilai' }}
                                </td>
                                <td class="text-center" data-title="Tanggal">
                                    {{ $item->Review->formatted_tanggal ?? '-' }}
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