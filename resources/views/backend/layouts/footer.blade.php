<footer>
          <div class="pull-right">
           &copy; Copyright {{date('Y')}} || Allrights reserved By <strong>Shakel</strong>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public/backend')}}/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('public/backend')}}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{asset('public/backend')}}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{asset('public/backend')}}/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{asset('public/backend')}}/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{asset('public/backend')}}/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('public/backend')}}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{asset('public/backend')}}/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{asset('public/backend')}}/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="{{asset('public/backend')}}/vendors/Flot/jquery.flot.js"></script>
    <script src="{{asset('public/backend')}}/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="{{asset('public/backend')}}/vendors/Flot/jquery.flot.time.js"></script>
    <script src="{{asset('public/backend')}}/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="{{asset('public/backend')}}/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="{{asset('public/backend')}}/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{asset('public/backend')}}/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="{{asset('public/backend')}}/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{asset('public/backend')}}/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{asset('public/backend')}}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{asset('public/backend')}}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('public/backend')}}/vendors/moment/min/moment.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="{{asset('public/backend')}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{asset('public/backend')}}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{asset('public/backend')}}/vendors/pdfmake/build/vfs_fonts.js"></script>
       <!-- Datatables end-->
    <!-- Custom Theme Scripts -->
    <script src="{{asset('public/backend')}}/build/js/custom.min.js"></script>
    <!-- custom main js  -->
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    
    <!-- approved sweet alert -->
    <script>
      $(function(){
        $(document).on('click','#approveBtn',function(e){
          e.preventDefault();
          var link = $(this).attr("href");
          Swal.fire({
          title: 'Are you sure?',
          text: "Approve this data!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire(
              'Approved!',
              'Your file has been approved.',
              'success'
            )
          }
        })
        });
      });
    </script>

    <!-- image showing script  -->
    <script>
      $(document).ready(function(){
        $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
            $("#showImage").attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
        });
      });
    </script>
    <!-- image showing script end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- Tostr alert -->
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <!-- {!! Toastr::message() !!} -->
        <script src="{{asset('public/backend')}}/build/js/main.js"></script>

  </body>
</html>
