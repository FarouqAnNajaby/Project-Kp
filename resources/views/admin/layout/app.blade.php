<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>{{ request()->segment(1) == 'admin' ? 'Admin' : 'Kasir' }} Lamongan Mart</title>

    @include('admin.partials.stylesheet')
</head>

<body>

    <div class="main-wrapper main-wrapper-1">

        @if(request()->segment(1) == 'admin')

        @include('admin.partials.navbar')

        @include('admin.partials.sidebar')

        @else

        @include('kasir.partials.navbar')

        @include('kasir.partials.sidebar')

        @endif

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    @include('admin.partials.footer')

    @include('admin.partials.js')

    @include('sweet::alert')

</body>

</html>