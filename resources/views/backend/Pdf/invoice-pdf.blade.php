@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>
						Manage Invoice
						<button class="btn btn btn-success printBtn"><i class="fa fa-print text-center"></i>Print</button>
					</h3>
					 <!-- this row will not appear when printing -->  	
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  
                  <div class="x_content">

                    <section class="content invoice" id="invoice">
                      <!-- title row -->
                      <div class="row mb-4">
                        <div class="invoice-header">
                          <img src="{{asset('header.png')}}" alt="">
                          <h2>
                            Invoice.
                            <small><Strong>Date: </Strong> {{date('d-m-Y',strtotime($invoice->date))}}</small>
                          </h2>
                          
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          	<address>
                              <strong>Spk Electronics</strong>
                              <br>Shop No:101
                              <br>Gotia,Puthia, Rajshahi
                              <br>Phone: 01831603111
                              <br>Email: spk@gmail.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                            @php
                              $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first();
                            @endphp
                          <address>
                            <strong>{{$payment['customer']['name']}}</strong>
                            <br>{{$payment['customer']['address']}}
                            <br>{{$payment['customer']['mobile_no']}}
                            <br>{{$payment['customer']['email']}}
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice # {{$invoice->invoice_no}}</b>
                          <br>
                          <br>
                          <b>Order ID:</b> 
                          <br>
                          <b>Payment Due:</b> {{$payment->due_amount}}/-Tk
                          <br>
                          <b>Account:</b> 
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="  table">
                          <table class="table table-striped">
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
                              @endphp
                              @foreach($invoice['invoice_details'] as $key => $details)
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
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-6">
                          <!-- <p class="lead">Payment Methods:</p>
                          <img src="{{asset('public/backend/images/visa.png')}}" alt="Visa">
                          <img src="{{asset('public/backend/images/mastercard.png')}}" alt="Mastercard">
                          <img src="{{asset('public/backend')}}/images/american-express.png" alt="American Express">
                          <img src="{{asset('public/backend')}}/images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p> -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <p class="lead">Amount Due {{$payment->due_amount}}/-Tk</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>{{$total_sum}}/-Tk</td>
                                </tr>
                                <tr>
                                  <th>Discount</th>
                                  <td>{{$payment->discount_amount}}/-Tk</td>
                                </tr>
								                <tr>
                                  <th>Grand Total:</th>
                                  <td>{{$payment->total_amount}}/-Tk</td>
                                </tr>
                                <tr>
                                  <th>Paid Amount:</th>
                                  <td>{{$payment->paid_amount}}/-Tk</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      @php
                        $date = new DateTime('now', new DateTimezone('Asia/dhaka'));
                      @endphp
                      <i>Printing time : {{$date->format('F j,Y. g:i a')}}</i>
                    </section>
                      
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<!-- /page content -->
 <script>
	$(document).ready(function(){
		$(document).on('click','.printBtn', function(e){
			e.preventDefault();
			var printArea = document.getElementById('invoice').innerHTML;
			var originalContent = document.body.innerHTML;
			document.body.innerHTML = printArea;
			window.print();
			document.body.innerHTML = originalContent;
		
		});
	});
 </script>
@endsection