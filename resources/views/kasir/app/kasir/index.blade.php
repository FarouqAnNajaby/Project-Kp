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
            <div class="col-8 col-sm-7 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Barang</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open() !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('kategori_transaksi', 'Kategori', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::select('kategori_transaksi', ['pakaian'=>'Pakaian', 'makanan'=>'Makanan', 'minuman'=>'Minumam'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            {!! Form::label('nama_barang_transaksi', 'Nama Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::select('nama_barang_transaksi', ['Option 1'=>'Option 1', 'Option 2'=>'Option 2', 'Option 3'=>'Option 3'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            {!! Form::label('warna_transaksi', 'Warna', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::select('warna_transaksi', ['merah'=>'Merah', 'hijau'=>'Hijau', 'kuning'=>'Kuning'], null, ['placeholder'=>'Pilih', 'Class'=>'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('jumlah_barang_transaksi', 'Jumlah Barang', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-8">
                                {!! Form::number('jumlah_barang_transaksi', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#deskripsi-content">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#foto-content">Foto</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active text-justify" id="deskripsi-content">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab modi iusto esse quaerat cumque corporis itaque facilis. Reprehenderit veritatis nostrum ea repudiandae quaerat expedita totam! Quibusdam, sequi? Rerum consequatur pariatur dignissimos, ducimus atque commodi repellat aperiam delectus itaque assumenda quidem labore veniam fugit laboriosam ipsam adipisci officia doloribus expedita iusto veritatis quas mollitia facere! Velit asperiores, modi accusantium possimus tenetur dolor facere? Necessitatibus nesciunt assumenda sed. Ut dicta nostrum ullam molestiae? Architecto similique labore suscipit commodi. Perspiciatis, natus expedita. Qui reprehenderit fugiat quasi nostrum unde. Sequi nam tempora autem non unde doloremque? Maxime atque praesentium vitae placeat itaque aspernatur quisquam ea temporibus deserunt, nam earum. Eligendi, nemo sequi. Eos, voluptates, iusto eligendi quas officiis ipsum voluptatibus impedit magnam ipsam blanditiis praesentium nobis, modi voluptas incidunt numquam rem nostrum quisquam! Quae exercitationem corporis nulla incidunt optio recusandae natus aliquid facere necessitatibus dolor, aut culpa itaque vitae labore repellat aperiam harum at? Quae dolorum praesentium error illum dolore commodi pariatur ab amet voluptate deleniti accusamus saepe alias reiciendis, eaque repudiandae optio aliquam consequatur ipsam, aspernatur quaerat maxime similique! Incidunt reiciendis beatae, pariatur ullam iste voluptas accusamus laudantium magni, vero nisi dignissimos eligendi maiores ex iusto amet tempore earum veritatis ut reprehenderit quibusdam nesciunt sunt temporibus libero. Ducimus labore maxime amet dolorum ea fugiat, optio repellat est cumque tempore ullam beatae unde eos expedita assumenda modi error architecto itaque culpa nam. Sunt alias qui inventore! Ad voluptas reprehenderit cum exercitationem, fugiat placeat magnam eveniet repellendus esse soluta. Dolore dolorum qui animi, magnam tempora incidunt ad sed consequatur et, culpa impedit! Fugiat, minus ratione ipsa dolor beatae repellat incidunt reprehenderit, nulla tempore numquam est totam minima? Illo magni similique alias quod fugiat rem ratione natus asperiores exercitationem expedita harum quasi accusantium perspiciatis veritatis ducimus, earum accusamus, perferendis laudantium, repellendus sunt. Velit quod tenetur modi reprehenderit tempora nesciunt, animi atque ipsa nihil? Unde a corrupti libero, dolorem quibusdam, blanditiis, ipsa incidunt fugit delectus odit obcaecati nulla nobis exercitationem? Rerum maiores dolores ex illum quisquam aliquid similique officia sit aperiam repudiandae error iusto nostrum, laborum, voluptate possimus neque ipsum. Placeat repudiandae aliquam perspiciatis in. Possimus, sunt. Assumenda, rem sunt et porro minus voluptatum delectus velit! Sapiente, est! Cupiditate culpa suscipit exercitationem qui esse pariatur ad iste, delectus, nisi adipisci natus itaque possimus dolores repellendus. Recusandae ducimus voluptatibus consequatur assumenda autem quasi laborum perferendis nemo. Veniam laborum quo doloribus quisquam eius? Ullam debitis, et est ab dignissimos quidem consectetur sint, dicta perferendis voluptas esse at dolore iste soluta sequi quasi sunt magni fugit voluptatem corrupti voluptatibus id sed? Impedit iste enim voluptatem adipisci, quod eligendi eveniet, nulla eos porro consectetur, distinctio asperiores maxime. Odit fuga aliquid tempore beatae ducimus id tenetur obcaecati adipisci minima rem? Ipsam debitis quaerat nemo esse explicabo exercitationem error maiores, perspiciatis eius ducimus! Nemo officiis doloremque iusto voluptates autem fugiat. Delectus veritatis unde itaque dolor reiciendis natus vitae modi! Numquam natus officiis, aliquam ipsa facere veritatis necessitatibus tempore nulla pariatur omnis! Rerum, itaque obcaecati cupiditate facilis iure neque aliquam dolorum nobis ipsa blanditiis.
                            </div>
                            <div class="tab-pane fade pb-0" id="foto-content">
                                <div class="owl-carousel owl-theme slider" id="slider-foto">
                                    <div><img alt="image" src="https://via.placeholder.com/671x480"></div>
                                    <div><img alt="image" src="https://via.placeholder.com/671x480"></div>
                                    <div><img alt="image" src="https://via.placeholder.com/671x480"></div>
                                    <div><img alt="image" src="https://via.placeholder.com/671x480"></div>
                                </div>
                            </div>
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
                                    <th class="p-0 text-center">Name Barang</th>
                                    <th class="p-0 text-center">Jumlah</th>
                                    <th class="p-0 text-center">Harga</th>
                                    <th class="p-0 text-center">Action</th>
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
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" id="modal-5" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>

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
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>

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
                                    <td class="p-0 text-center">
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Batal"><i class="fas fa-times"></i></a>
                                        <button class="btn btn-primary" data-toggle="tooltip" title="Ubah"><i class="fas fa-pen"></i></button>
                                    </td>
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
                        {!! Form::open() !!}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('pembayaran_transaksi', 'Pembayaran') !!}
                                    {!! Form::number('pembayaran_transaksi', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('uang_kembali_transaksi', 'Uang Kembalian') !!}
                                    {!! Form::number('uang_kembali_transaksi', null, ['class' => 'form-control', 'disabled' => 'true']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<form class="modal-part" id="modal-login-part">
    <div class="form-group">
        <label>Nama Barang</label>
        <div class="input-group">
            <input disabled type="text" class="form-control" placeholder="Kunyit Asam Amanda" name="nama">
        </div>
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <div class="input-group">
            <input type="number" class="form-control" placeholder="1" name="jumlah">
        </div>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <div class="input-group">
            <input disabled type="text" class="form-control" placeholder="Rp. 5.000" name="jumlah">
        </div>
    </div>
</form>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
@endpush


@push('javascript-custom')

<script>
    $("#deskripsi-content").css({
        height: 315
    }).niceScroll();
    $("#slider-foto").owlCarousel({
        loop: true
        , autoplay: true
        , autoplayTimeout: 3000
        , items: 1
        , nav: true
        , navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
    });
    $("#modal-5").fireModal({
        title: 'Edit'
        , body: $("#modal-login-part")
        , footerClass: 'bg-whitesmoke'
        , autoFocus: false
        , onFormSubmit: function(modal, e, form) {
            // Form Data
            let form_data = $(e.target).serialize();
            console.log(form_data)

            // DO AJAX HERE
            let fake_ajax = setTimeout(function() {
                form.stopProgress();
                modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

                clearInterval(fake_ajax);
            }, 1500);

            e.preventDefault();
        }
        , shown: function(modal, form) {
            console.log(form)
        }
        , buttons: [{
            text: 'Simpan'
            , submit: true
            , class: 'btn btn-primary btn-shadow'
            , handler: function(modal) {}
        }]
    });
</script>

@endpush