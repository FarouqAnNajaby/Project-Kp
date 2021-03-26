<div class="section-header">

    @if ($attributes->has('backBtn'))
    <div class="section-header-back">
        <a href="{{ $attributes->get('backUrl') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    @endif

    <h1>{{ $attributes->get('title') }}</h1>

    @if($attributes->has('addBtn'))
    <div class="section-header-button">
        <a href="{{ $attributes->get('addUrl') }}" class="btn btn-primary">Tambah {{ $attributes->get('title') }}</a>
    </div>
    @endif

    <div class="section-header-breadcrumb">
        @if(request()->segment(1) == 'admin')
        <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
        @endif
        {{ $breadcrumbItem }}
    </div>
</div>