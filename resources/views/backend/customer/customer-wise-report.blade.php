@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Customer Wise Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                		<!-- <a href="{{route('stock.report.pdf')}}" target="_blank" class="btn btn-success float-right btn-sm"><i class="fa fa-download"></i> Download PDF</a> -->
                	</h3>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <!-- usertable -->
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <strong>Customer Wise Credit Report</strong>
                    <input type="radio" name="custome_wise_report" value="customer_wise_credit" class="search_value"> &nbsp;&nbsp;
                    <strong>Customer Wise Paid Report</strong>
                    <input type="radio" name="custome_wise_report" value="customer_wise_paid" class="search_value">
                  </div>
                </div>
                <div class="show_credit" style="display: none;">
                  <form action="{{route('customers.wise.credit.report')}}" method="GET" id="customerCredit" target="_blank">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <label for="">Customer Name</label>
                        <select name="customer_id" id="customer_id1" class="form-control select2bs4">
                          <option value="">Select Customer</option>
                          @foreach($customers as $customer)
                          <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                          @endforeach
                        </select>
                      </div>
                      
                        <div class="col-sm-4" style="margin-top: 30px;">
                         <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                      
                    </div>
                  </form>
                </div>
                <div class="show_paid" style="display: none;">
                  <form action="{{route('customers.wise.paid.report')}}" method="GET" id="customerPaid" target="_blank">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <label for="">Customer Name</label>
                        <select name="customer_id" id="customer_id" class="form-control select2bs4">
                          <option value="">Select Customer</option>
                           @foreach($customers as $customer)
                          <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}-{{$customer->address}})</option>
                          @endforeach
                        </select>
                      </div>
                      
                      <div class="col-sm-4" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                      
                    </div>
                  </form>
                </div>
                <!-- usertableend -->
              </div><!-- /.card-body -->
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
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).on('change','.search_value',function(){
      var search_value = $(this).val();
      if (search_value == 'customer_wise_credit') {
        $('.show_credit').show();
      }else{
        $('.show_credit').hide();
      }
      if (search_value == 'customer_wise_paid') {
        $('.show_paid').show();
      }else{
        $('.show_paid').hide();
      }

    });
  </script>
  <!-- validation -->
  <!-- Customer credit wise -->
<script>
  $(function () {
    
    $('#customerCredit').validate({
      rules: {
        customer_id: {
          required: true,
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
<!-- Customer paid wise validation -->
<script>
  $(function () {
    
    $('#customerPaid').validate({
      rules: {
        customer_id: {
          required: true,
        },
        product_id: {
          required: true,
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

@endsection