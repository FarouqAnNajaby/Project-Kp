<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('ecommerce.partials.head')

<body>
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
    @include('ecommerce.partials.navbar')

        <!-- Main Content -->
        @yield('content')
    
    @include('ecommerce.partials.footer')
    @include('ecommerce.partials.javascript')
</body>

</html>