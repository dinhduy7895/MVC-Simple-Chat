<footer class="main-footer">
    <div class="pull-right hidden-xs">
     
    </div>
      
  </footer>

  

</div>
<!-- jQuery 2.2.3 -->
<!-- Bootstrap 3.3.6 -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="plugins/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="plugins/dist/js/demo.js"></script>
<script src="plugins/multiselect/bootstrap-multiselect.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
     
      "searching": false,
      
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#select').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            selectAllJustVisible: false
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#select1').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            selectAllJustVisible: false
        });
    });
</script>
  <script src="plugins/myJs/login.js"></script>

</body>
</html>