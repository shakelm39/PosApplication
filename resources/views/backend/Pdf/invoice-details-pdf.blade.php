@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Invoice Details PDF
                      <button class="btn btn-success" id="invBtn"><i class="fa fa-print"></i>Print</button>
                    </h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row" id="invDetails">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <table width="100%">
                                      <tbody>
                                        <tr>
                                          <td></td>
                                          <td><img src="{{asset('header.png')}}" alt=""></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td width="30%"><strong>Invoice No # {{$payment['invoice']['invoice_no']}}</strong></td>
                                          <td width="40%"><span style="font-size:20px;">Spk Electronics <br></span>Gotia,Puthia, Rajshahi.</td>
                                          <td width="30%"><span>Shop No:101 <br>Owner Mobile:01831603111</span></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <hr style="margin-bottom: 0px; margin-top: 20px;">
                                    <table>
                                      <tbody>
                                        <tr>
                                          <td width="30%"></td>
                                          <td><u><strong><span style="font-size:18px">Customer Invoice Details</span></strong></u></td>
                                          <td width="30%"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <table width="100%">
                                        <tbody>
                                          <tr>
                                            <td><strong>Customer Info</strong></td>
                                          </tr>
                                          <tr>
                                            <td width="35%"><strong>Name: </strong>{{$payment['customer']['name']}}</td>
                                            <td width="25%"><strong>Mobile: </strong>{{$payment['customer']['mobile_no']}}</td>
                                            <td width="40%"><strong>Address: </strong>{{$payment['customer']['address']}}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                  <div class="col-md-12">
                                    <table width="100%" class="table table-bordered" style="width:100%">
                                      <thead class="bg-info text-white">
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
                                        <tr style="text-align: center;">
                                          <td style="text-align: center;">{{$key+1}}</td>
                                          <td>{{$details['category']['name']}}</td>
                                          <td>{{$details['product']['name']}}</td>
                                          <td style="text-align: center;">{{$details->selling_qty}}</td>
                                          <td style="text-align: center;">{{$details->unit_price}}</td>
                                          <td style="text-align: center;">{{$details->selling_price}}</td>
                                        </tr>
                                          @php 
                                            $total_sum +=$details->selling_price;
                                          @endphp
                                          @endforeach
                                          <tr style="text-align: center;">
                                            <td colspan='5' style="text-align: right;"><strong>Sub Total = </strong></td>
                                            <td style="text-align: center;">{{$total_sum}}/-Tk</td>
                                          </tr>
                                          <tr>
                                            <td colspan='5' style="text-align: right;"><strong>Discount = </strong></td>
                                            <td style="text-align: center;">{{$payment->discount_amount}}/-Tk</td>
                                          </tr>
                                          <tr>
                                            <td colspan='5' style="text-align: right;"><strong>Grand Total = </strong></td>
                                            <td style="text-align: center;">{{$payment->total_amount}}/-Tk</td>
                                          </tr>
                                          <tr>
                                            <td colspan='5' style="text-align: right;"><strong>Paid Amount = </strong></td>
                                            <td style="text-align: center;">{{$payment->paid_amount}}/-Tk</td>
                                          </tr>
                                          <tr>
                                            <td colspan='5' style="text-align: right;"><strong>Due Amount = </strong></td>
                                            <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                            <td class="text-center bg-warning ">{{$payment->due_amount}}/-Tk</td>
                                          </tr>
                                          <tr>
                                            <th colspan="6" class="text-center fw-bold bg-info text-white">Paid Summary</th>
                                          </tr>
                                          <tr>
                                            <td colspan="3" style="text-align: center;"><strong>Date</strong></td>
                                            <td colspan="3" style="text-align: center;"><strong>Amount</strong></td>
                                          </tr>
                                          @php
                                            $payment_details = App\Models\PaymentDetails::where('invoice_id',$payment->invoice_id)->get();
                                          @endphp
                                          @foreach ($payment_details as $dtl)
                                          <tr>
                                            <td colspan="3" style="text-align: center;">{{date('j-F-Y',strtotime($dtl->date))}}</td>
                                            <td colspan="3" style="text-align: center;">{{$dtl->current_paid_amount}}/- Tk</td>
                                          </tr>

                                          @endforeach
                                      </tbody>
                                    </table>
                                    @php
                                      $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                    @endphp
                                    <i>Printing time : {{$date->format('F j,Y, g:i a')}}</i>
                                  </div>
                                </div>
                                <div class="row mt-5 py-5">
                                  <div class="col-md-12">
                                    <hr style="margin-bottom: 0px; margin-top: 20px;">
                                    <table border="0" width="100%">
                                      <tbody>
                                        <tr>
                                          <td style="width:40%">
                                            <p style="text-align: center; margin-left: 20px;">Customer Signature</p>
                                          </td>

                                          <td style="width:20%"></td>
                                          <td style="width:20%; text-align: center;">
                                            <p style="text-align: center;">Seller Signature</p>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
   <script>
    
    $(document).ready(function(){

        $(document).on('click','#invBtn', function(e){
          e.preventDefault();
          var printArea = document.getElementById('invDetails').innerHTML;
          var originalContent = document.body.innerHTML;
          document.body.innerHTML = printArea;
          window.print();
          document.body.innerHTML = originalContent;
        });
    });  
   </script>
<!-- /page content -->
@endsection