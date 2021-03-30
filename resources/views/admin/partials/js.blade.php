<script src="{{ asset('assets/admin/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/popper.js') }}"></script>
<script src="{{ asset('assets/admin/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/admin/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/stisla.js') }}"></script>

{{-- <script src="{{ asset('assets/admin/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script> --}}
@stack('javascript')
<script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
@stack('javascript-custom')