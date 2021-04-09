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
                <div class="contact-us row">
                    <div class="col-12 mb-4">
                        <div class="form-main">
                            <div class="title">
                                <h3>Penilaian</h3>
                            </div>
                            @if($data->Review()->exists() && strtotime(now()) > strtotime('+1 week', strtotime($data->Review->created_at)))
                            {!! Form::open(['class' => 'form']) !!}
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nama Barang</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::text('nama', $data->Barang->nama, ['disabled']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nilai</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::select('nilai', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], $data->Review->nilai, ['class' => 'rating-bar', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Keterangan</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::textarea('keterangan', $data->Review->keterangan, ['disabled']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @else
                            {!! Form::open(['class' => 'form']) !!}
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nama Barang</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::text('nama', $data->Barang->nama, ['disabled']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Nilai</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::select('nilai', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], 0, ['class' => 'rating-bar']) !!}
                                    @error('nilai')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label col-12 col-md-4 col-lg-4">Keterangan</label>
                                <div class="col-sm-12 col-md-8">
                                    {!! Form::textarea('keterangan', null) !!}
                                    @error('keterangan')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group button">
                                    <button type="submit" class="btn ">Simpan</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/ecommerce/css/fontawesome-stars-o.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/ecommerce/js/jquery.barrating.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    $('select[name=nilai]').barrating({
        theme: 'fontawesome-stars-o'
        , initialRating: "{{ $data->Review->nilai ?? 5 }}"
		@if($data->Review()->exists() && strtotime(now()) > strtotime('+1 week', strtotime($data->Review->created_at)))
        , readonly: true
		@endif
    , })
</script>
@endpush