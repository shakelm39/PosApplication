@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Daily Invoice Report <i class="fa fa-file text-danger"></i></h3>
					 <!-- this row will not appear when printing --> 
					 	
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <section class="content" id ="invArea">
						<!-- card  -->
                      <div class="card">
						<!-- card body  -->
                        <div class="card-body">
							<!-- row start  -->
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
												<td width="30%"></td>
												<td width="40%"><span style="font-size:20px;">Spk Electronics <br></span>Gotia,Puthia, Rajshahi.</td>
												<td width="30%"><span>Shop No:101 <br>Owner Mobile:01831603111</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- row end  -->
							<!-- row start -->
							<div class="row">
								<div class="col-md-12">
									<hr style="margin-bottom: 0px; margin-top: 20px;">
									<table class="mb-2">
										<tbody>
											<tr>
												<td width="10%"></td>
												<td><u><strong><span style="font-size:18px">Daily Invoice Report({{date('d-m-Y',strtotime($start_date))}} To {{date('d-m-Y',strtotime($end_date))}})</span></strong></u></td>
												<td width="10%"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- row end -->
							<!-- row start -->
							<div class="row">
								<div class="col-md-12">
									<table  width="100%" class="table table-bordered">
										<thead>
										<tr>
											<th>Sl</th>
											<th>Date</th>
											<th>Invoice No</th>
											<th>Customer Name</th>
											<th>Description</th>
											<th>Amount</th>
										</tr>
										</thead>
										<tbody>
											@php
											$total_sum ="0";
											@endphp
											@foreach($allData as $key=> $invoice)
											<tr>
											<td>{{$key+1}}</td>
											<td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
											<td>Invoice No#{{$invoice['payment']['invoice_id']}}</td>
											<td>
												{{$invoice['payment']['customer']['name']}}
												({{$invoice['payment']['customer']['mobile_no']}}-{{$invoice['payment']['customer']['address']}})
											</td>
											<td>{{$invoice->description}}</td>
											<td>{{$invoice['payment']['total_amount']}}</td>
											</tr>
											@php 
											$total_sum +=$invoice['payment']['total_amount'];
											@endphp
											@endforeach
											
											<tr>
											<td colspan="5" style="text-align: right;">Grand Total =</td>
											<td style="text-align: center;">{{$total_sum}}/-Tk</td>
											</tr>
										</tbody>
									</table>
								</div>  
							</div>
							<!-- row end -->
							<!-- row start -->
							<div class="row mt-5 py-5">
								<div class="col-md-12">
									<!-- <hr style="margin-bottom: 0px; margin-top: 20px;"> -->
									<table border="0" width="100%">
										<tbody>
											<tr>
												<td style="width:40%">
													<!-- <p style="text-align: center; margin-left: 20px;">Customer Signature</p> -->
												</td>

												<td style="width:20%"></td>
												<td style="width:40%; text-align: center;">
													<p style="text-align: center; border-top:1px solid #000;">Owner Signature</p>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- row end -->
                        </div>
						<!-- card body end  -->
                      </div>
					  <!-- card end  -->
                    </section>
					<section>
						<div class="row pull-right mt-4">
							<button class="btn btn-success" id="invoicebtn"><i class="fa fa-print"></i>Print</button> 
						</div>
					</section>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<!-- /page content -->
<script>
	$(function(){
		$(document).on('click','#invoicebtn', function(e){
			e.preventDefault();
			var inv = document.getElementById('invArea').innerHTML;
			var content = document.body.innerHTML;
			document.body.innerHTML = inv;
			window.print();
			document.body.innerHTML =content;
		});
	});
</script>
@endsection