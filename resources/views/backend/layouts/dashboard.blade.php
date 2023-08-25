@extends('backend.layouts.master')

@section('main-content')

 <!-- page content -->
 <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">
                    

                    <div class="row top_tiles" style="margin: 10px 0;">
                      <div class="col-md-3 tile">
                        <span>Total User</span>
                        @php 
                          $user_count = App\Models\User::where('usertype','user')->count();
                        @endphp
                        <h2>{{ $user_count }}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      <div class="col-md-3 tile">
                        <span>Total Supplier</span>
                        @php $supplier = App\Models\Supplier::all()->count();@endphp
                        <h2>{{ $supplier }}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      @php $customer = App\Models\Customer::all()->count();@endphp
                      <div class="col-md-3 tile">
                        <span>Total Customer</span>
                        <h2>{{$customer}}</h2>
                        <span class="sparkline_three" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      <div class="col-md-3 tile">
                        <!-- <span>Total Due</span> -->
                        <h2></h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">
                    

                    <div class="row top_tiles" style="margin: 10px 0;">
                      <div class="col-md-3 tile">
                        <span>Total Invest</span>
                        @php
                          $invest = App\Models\Purchase::all();
                          $total_sum='0';
                        @endphp
                        @foreach($invest as $key => $purchase)
                          @php 
                            $total_sum +=$purchase->buying_price;
                          @endphp
                        @endforeach
                        <h2>{{ $total_sum }}Tk</h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      <div class="col-md-3 tile">
                        <span>Total Sales</span>
                        @php
                          $allData = App\Models\InvoiceDetails::all();
                          $total_sale='0';
                        @endphp
                        @foreach($allData as $key => $sale)
                          @php 
                            $total_sale +=$sale->selling_price;
                          @endphp
                        @endforeach
                        <h2>{{$total_sale}}Tk</h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      @php 
                      $data = App\Models\Payment::all();
                        $total_pay ='0';
                        $total_due = 0;
                      @endphp
                      @foreach($data as $payment)
                        @php
                        $total_pay += $payment->paid_amount;
                        $total_due += $payment->due_amount;
                        @endphp
                      @endforeach
                      <div class="col-md-3 tile">
                        <span>Total Payment</span>
                        <h2>{{$total_pay}}Tk</h2>
                        <span class="sparkline_three" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                      <div class="col-md-3 tile">
                        <span>Total Due</span>
                        <h2>{{$total_due}}</h2>
                        <span class="sparkline_two" style="height: 160px;">
                          <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                        </span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection