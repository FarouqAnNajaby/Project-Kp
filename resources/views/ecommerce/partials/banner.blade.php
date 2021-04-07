<section class="hero-area4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="home-slider-4">
                    @foreach ($data as $item)
                    <div class="big-content" style="background-image: url('{{ asset('storage/banner/' . $item->foto) }}');">
                        <div class="inner">
                            <h4 class="title">{!! $item->judul !!}</h4>
                            <p class="des">{!! $item->deskripsi !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>