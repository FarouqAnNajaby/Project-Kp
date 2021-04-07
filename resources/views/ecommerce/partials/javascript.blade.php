<!-- Jquery -->
<script src="{{ asset('assets/ecommerce/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/slicknav.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/nicesellect.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/flex-slider.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/ecommerce/js/scrollup.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/autoNumeric.min.js')}}"></script>
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
@stack('javascript')
<script src="{{ asset('assets/ecommerce/js/active.js')}}"></script>
<script>
    new AutoNumeric.multiple('.format-number', {
        allowDecimalPadding: false
        , decimalCharacter: ","
        , digitGroupSeparator: "."
        , currencySymbol: "Rp. "
    , })
</script>
@stack('javascript-custom')