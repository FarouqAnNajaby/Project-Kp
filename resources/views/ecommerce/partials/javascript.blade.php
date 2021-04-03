<!-- Jquery -->
<script src="{{ asset('assets/ecommerce/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/jquery-ui.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/ecommerce/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/bootstrap.min.js')}}"></script>
<!-- Slicknav JS -->
<script src="{{ asset('assets/ecommerce/js/slicknav.min.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{ asset('assets/ecommerce/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{ asset('assets/ecommerce/js/scrollup.js')}}"></script>
<script src="{{ asset('assets/ecommerce/js/autoNumeric.min.js')}}"></script>
<!-- Active JS -->
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