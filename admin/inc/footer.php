  <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023-2030 Shohanur Rahman Shohan.</strong> 
       All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
       
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>

  <!-- Ck editor js -->
  <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>

  <!-- Data Table Jquery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- Data Table Js -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
        $('#dataSearch').DataTable();
    });
  </script> 

  <!-- JQuery UI js -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker1" ).datepicker();
        } );
    </script>

    <script>
        $( function() {
            $( "#datepicker2" ).datepicker();
        } );
    </script>



  <?php  
    ob_end_flush();
  ?>
  </body>
</html>
