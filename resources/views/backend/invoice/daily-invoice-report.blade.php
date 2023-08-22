@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              	<div class="card-header">
                	<h3>Select Criteria
                		<!-- <a href="{{route('invoice.view')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Invoice List</a> -->
                	</h3>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                   <form action="{{route('invoice.daily.report.pdf')}}" method="GET" target="_blank" id="myForm">
                      <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">Start Date</label>
                        <input type="date" id="start_date" name='start_date' class="input-group form-control">
                      </div> 
                      <div class="form-group col-md-4">
                        <label for="">End Date</label>
                        <input type="date" id="end_date" name='end_date' class="input-group form-control">
                      </div> 
                      <div class="form-group col-md-2" style="padding-top: 35px;">
                       <button type="submit" class="btn btn-primary btn-sm  form-contorl" ><i class="fa fa-eye"></i> Search</button>
                      </div>
                    </div>
                   </form>
              </div>
                
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>

<script>
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
    $('#myForm').validate({
      rules: {
        start_date: {
          required: true,
          start_date: true,
        }, 
        end_date: {
          required: true,
          end_date: true,
        }
      },
      messages: {
        
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
  <!-- /.content-wrapper -->
@endsection