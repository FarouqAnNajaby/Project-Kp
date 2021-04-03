<script src="{{ asset('assets/admin/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/popper.js') }}"></script>
<script src="{{ asset('assets/admin/tooltip.js') }}"></script>
<script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/admin/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/stisla.js') }}"></script>

{{-- <script src="{{ asset('assets/admin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/admin/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script> --}}
@stack('javascript')
<script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
@stack('javascript-custom')