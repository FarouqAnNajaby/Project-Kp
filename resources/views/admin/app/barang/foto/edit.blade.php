@extends('admin.layout.app')

@section('content')

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Ubah Foto Barang" backUrl="{{ route('admin.barang.foto.index',$data->uuid) }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.index') }}">Data Barang</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.foto.index', $data->uuid) }}">Foto Barang</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.barang.foto.edit', [$data->uuid, $foto->uuid]) }}">Ubah Foto Barang</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Formulir</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($foto, ['route' => ['admin.barang.foto.update', [$data->uuid, $foto->uuid]], 'files' => true, 'method' => 'patch']) !!}
                        <div class="form-group row mb-4">
                            {!! Form::label('foto', 'Foto Barang <i class="fas fa-info-circle" data-toggle="tooltip" title="Ukuran file maksimal 3MB & ekstensi berupa jpeg, jpg, png."></i>', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3'], false) !!}
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-file">
                                    {!! Form::file('foto', ['class' => 'custom-file-input', 'id'=>'foto', 'accept' => 'image/jpeg,image/png']) !!}
                                    {!! Form::label('foto', 'Pilih foto', ['class' => 'custom-file-label']) !!}
                                </div>
                                <div class="preview-image mt-4"></div>
                                @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            {!! Form::label('is_highlight', 'Highlight*', ['class' => 'col-form-label text-md-right col-12 col-md-3 col-lg-3']) !!}
                            <div class="col-sm-12 col-md-7">
                                {!! Form::select('is_highlight', [1 => 'Ya', 0 => 'Tidak'], null, ['class' => 'form-control', 'required']) !!}
                                @error('is_highlight')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-9 offset-md-3">
                                {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        (<b>*</b>) = Wajib diisi
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/modules/freezeui/freeze-ui.min.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/freezeui/freeze-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
@endpush

@push('javascript-custom')
<script>
    const logo = $("#foto")
    const defaultLogo = () => $('.preview-image').css('background-image', 'url({{ asset($foto->file) }})');
    const maxAllowedSize = 3 * 1024 * 1024;
    const invalidMaxSizeAlert = () => swalAlert('Ukuran foto maksimal 3MB.')
    const invalidExtAlert = () => swalAlert('Ekstensi file hanya boleh berupa jpeg, jpg dan png.')
    const resetLogoInput = () => {
        defaultLogo()
        $("#foto").val('').next('label').html('Pilih foto');
    }
    const swalAlert = (text) => {
        swal({
            title: 'Terjadi Kesalahan'
            , text: text
            , icon: 'error'
        })
    }
    $.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$', "i")).test($(this).val());
    }

    $(document).ready(function() {

        $('form').on('submit', function(e) {
            FreezeUI({
                selector: 'form'
            })
            $('input.form-control').attr('readonly', true)
            $('input[type=submit]').attr('disabled', true)
            $('.select2').attr("readonly", true)
        })

        bsCustomFileInput.init()
        defaultLogo()

        logo.on('change', function() {
            const $this = this
            if (this.files && this.files[0]) {
                if (logo.hasExtension(['.jpeg', '.jpg', '.png'])) {
                    if ($this.files[0].size < maxAllowedSize) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.preview-image').css('background-image', 'url(' + e.target.result + ')');
                        }
                        reader.readAsDataURL(this.files[0]);
                    } else {
                        invalidMaxSizeAlert()
                        resetLogoInput()
                    }
                } else {
                    invalidExtAlert()
                    resetLogoInput()
                }
            } else {
                defaultLogo()
            }
        })
    })
</script>
@endpush