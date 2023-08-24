@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Credit Customer</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            
                            <br />
                            <div class="card">
                              <div class="card-header">
                                <h3>Edit Invoice (Invoice No # {{$payment['invoice']['invoice_no']}})
                                  <a href="{{route('customers.credit')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Credit Customer List</a>
                                </h3>
                              </div>
                              <div class="card-body">
                                <table width="100%">
                                  <tbody>
                                    <tr>
                                      <td><strong>Customer Info</strong></td>
                                    </tr>
                                    <tr>
                                      <td width="35%"><strong>Customer Name: </strong>{{$payment['customer']['name']}}</td>
                                      <td width="25%"><strong>Mobile: </strong>{{$payment['customer']['mobile_no']}}</td>
                                      <td width="40%"><strong>Address: </strong>{{$payment['customer']['address']}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                                <form action="{{route('customers.update.invoice',$payment->invoice_id)}}" method="POST" id="myForm">
                                  @csrf
                                  <table width="100%" class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Selling Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php 
                                        $total_sum ='0';
                                        $invoice_details = App\Models\InvoiceDetails::where('invoice_id',$payment->invoice_id)->get();
                                      @endphp
                                      @foreach($invoice_details as $key => $details)
                                      <tr>
                                        
                                        <td>{{$key+1}}</td>
                                        <td>{{$details['category']['name']}}</td>
                                        <td>{{$details['product']['name']}}</td>
                                        <td>{{$details->selling_qty}}</td>
                                        <td>{{$details->unit_price}}</td>
                                        <td>{{$details->selling_price}}</td>
                                      </tr>
                                        @php 
                                          $total_sum +=$details->selling_price;
                                        @endphp
                                      @endforeach
                                      <tr>
                                        <td colspan='5' style="text-align: right;"><strong>Sub Total = </strong></td>
                                        <td>{{$total_sum}}/-Tk</td>
                                      </tr>
                                      <tr>
                                        <td colspan='5' style="text-align: right;"><strong>Discount = </strong></td>
                                        <td>{{$payment->discount_amount}}/-Tk</td>
                                      </tr>
                                      <tr>
                                        <td colspan='5' style="text-align: right;"><strong>Grand Total = </strong></td>
                                        <td>{{$payment->total_amount}}/-Tk</td>
                                      </tr>
                                      <tr>
                                        <td colspan='5' style="text-align: right;"><strong>Paid Amount = </strong></td>
                                        <td>{{$payment->paid_amount}}/-Tk</td>
                                      </tr>
                                      <tr>
                                        <td colspan='5' style="text-align: right;"><strong>Due Amount = </strong></td>
                                        <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                        <td class="text-danger">{{$payment->due_amount}}/-Tk</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <div class="row col-md-12">
                                    <div class="form-group col-md-4">
                                      <label>Paid Status</label>
                                      <select name="paid_status" id="paid_status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="full_paid">Full Paid</option>
                                        <option value="partial_paid">Partial Paid</option>
                                      </select>
                                      @error ('paid_status') 
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                      <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="">Date</label>
                                      <input type="date" id="date" value="" name='date' class="datepicker input-group form-control">
                                        @error ('date') 
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror 
                                     
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top: 35px;">
                                      <button type="submit" class="btn btn-primary btn-sm">Update Invoice</button>    
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
  <script>
      $(document).on('change','#paid_status',function(){
        var paid_status = $(this).val();
        if (paid_status=='partial_paid') {
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }

      });
  </script>
  <script>
      $('.datepicker').datepicker({
        uiLibrary:'bootstrap4',
        format:'yyyy-mm-dd'
      });
  </script>
  <!-- supplier wise validation  -->
  <!-- <script>
    $(function () {
    
    $('#myForm').validate({
      rules: {
        paid_status: {
          required: true,
        },
        date: {
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
  </script> -->
<!-- /page content -->
@endsection