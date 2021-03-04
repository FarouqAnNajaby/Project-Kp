@extends('admin.layout.app')

@section('content')

<section class="section">
	<x-admin-breadcrumb backBtn=true title="History Barang" url="{{ route('admin.barang.history.index') }}">
		<x-slot name="breadcrumbItem">
			<div class="breadcrumb-item">
				<a href="{{ route('admin.barang.history.index') }}">
					History Barang
				</a>
			</div>
			<div class=" breadcrumb-item">Detail Barang</div>
		</x-slot>
	</x-admin-breadcrumb>
	<div class="section-body">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail">Detail</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="deskripsi-tab" data-toggle="tab" href="#deskripsi">Deskripsi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="foto-barang-tab" data-toggle="tab" href="#foto-barang">Foto Barang</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="detail">
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Nama Barang :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->nama }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Tanggal Input :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->tanggal_input }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Stok Awal :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->stok_awal_formatted }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Harga Satuan :</label>
							<p class="col-form-label col-7 col-md-8">{{ $data->rp_harga }}</p>
						</div>
						<div class="form-group row mb-4">
							<label class="col-form-label text-md-right col-5 col-md-4">Nama UMKM :</label>
							<p class="col-form-label col-7 col-md-8">
								<a href="javascript:;">Kamila Collection</a>
							</p>
						</div>
					</div>
					<div class="tab-pane fade" id="deskripsi">
						<p class="text-justify">
							Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo doloribus nemo beatae perspiciatis ullam, dolorem quisquam debitis illum maiores molestias, quas nam esse voluptatibus earum quae alias dignissimos voluptatum, numquam maxime! Ut suscipit fuga aperiam quas cum. Ex molestias accusamus officia maxime a quidem nisi similique fugiat aliquam iste nam facilis dolorum nesciunt minus impedit dolor repellat quibusdam id, minima, nulla, veritatis molestiae! Autem, reiciendis. Distinctio corrupti qui animi saepe laborum facere libero nesciunt labore voluptatibus laudantium enim necessitatibus, fugit maiores, expedita non nihil placeat aliquid ad alias adipisci error. Laboriosam, eos ipsum cupiditate iste vitae nihil sapiente iusto reprehenderit numquam. Perspiciatis error provident excepturi consequatur sequi voluptates! Ea corporis asperiores aliquid, voluptatum quaerat iure doloribus aliquam cupiditate illo accusantium expedita dicta, atque nostrum numquam veniam repudiandae perferendis voluptatibus quos quis odio? Hic, expedita cupiditate corrupti praesentium doloremque, repellendus quia architecto atque dicta delectus aliquam mollitia in illum fuga ipsum. Dolorem perferendis eos aperiam, possimus inventore excepturi amet quas accusamus maxime officiis fugit quasi consequatur ut beatae itaque laudantium, eum dolores odio vero? Voluptas, atque neque assumenda qui numquam mollitia dolore, nisi vitae inventore autem provident ex ipsum quas minima, debitis ipsa maiores doloremque iste. Ullam quis earum et cupiditate.
						</p>
					</div>
					<div class="tab-pane fade" id="foto-barang">
						<div class="gallery gallery-md">
							<div class="gallery-item" data-image="{{ asset('assets/img/logoDinas.jpg') }}" data-title="Image 1"></div>
							<div class="gallery-item" data-image="{{ asset('assets/img/logoDinas.jpg') }}" data-title="Image 2"></div>
							<div class="gallery-item" data-image="{{ asset('assets/img/logoDinas.jpg') }}" data-title="Image 3"></div>
							<div class="gallery-item" data-image="{{ asset('assets/img/logoDinas.jpg') }}" data-title="Image 4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script type="text/javascript" src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush