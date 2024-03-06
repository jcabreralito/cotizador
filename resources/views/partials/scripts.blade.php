<script>
    var URLactual = window.location;
    if (URLactual.hostname == '127.0.0.1') {
        base_path = "/";
    } else {
        base_path=`/${URLactual.pathname.split("/")[1]}/`;
    }
</script>
<script src="js/jquery-3.7.0.min.js"></script>
{{-- <script src="vendor/jquery-3.5.1.js"></script> --}}
<script src="vendor/Bootstrap4/js/bootstrap.min.js"></script>





{{-- <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.3.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script> --}}





<script type="text/javascript" src="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>

<script src="https://cdn.datatables.net/scroller/2.3.0/js/dataTables.scroller.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.5/dist/lazyload.min.js"></script>
<script src="vendor/moment/moment.min.js"></script>
<script src="vendor/moment/locale/es-mx.js"></script>
<script src="vendor/datetime.js" charset="utf8"></script>
<script src="vendor/jquery-ui/jquery-ui.js"></script>
<script src="vendor/font-awesome/js/all.min.js"></script>
<script src="js/script.js"></script>
<script src="vendor/datetimepicker/jquery.simple-dtpicker.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<script src="vendor/sweetalert2/sweetalert2.all.js"></script>
<script src="vendor/jquery.ui.timepicker.js"></script>
<script src="vendor/select2.min.js"></script>
<script src="vendor/jsPDF-1.3.2/dist/jspdf.min.js"></script>
<script src="vendor/DataStream.js"></script>
{{-- <script src="vendor/full-calendar/theme-chooser.js"></script>
<script src="vendor/full-calendar/main.js"></script>
<script src="vendor/full-calendar/popper.min.js"></script>
<script src="vendor/full-calendar/tooltip.min.js"></script> --}}
<script src="vendor/mobile-detect.min.js"></script>
<script src="vendor/date.format.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
