@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Daily Purchase List
						<span class="float-right">
							<button type="button" class="btn btn-sm btn-success printBtn"> <i class="fa fa-print"></i> Print</button>
						</span>
					</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row" id="printDiv">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
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
							<div class="col-md-12">
								<hr class="mt-2">
								<table>
									<tbody>
										<tr>
											<td width="10%"></td>
											<td><u><strong><span style="font-size:18px">Daily Purchase Report({{date('d-m-Y',strtotime($start_date))}} To {{date('d-m-Y',strtotime($end_date))}})</span></strong></u></td>
											<td width="10%"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-12">
								<table width="100%" class="table table-bordered table-responsive">
									<thead>
										<tr>
											<th style="width:5%;">Sl</th>
											<th style="width:15%;">Date</th>
											<th style="width:5%;">Purchase No</th>
											<th style="width:10%;">Brand Name</th>
											<th style="width:10%;">Product Name</th>
											<th style="width:5%;">Qty</th>
											<th style="width:5%;">Unit Price</th>
											<th style="width:5%;">Total Price</th>  
										</tr>
									</thead>
									<tbody>
										@php
											$total_sum = '0';
										@endphp
										@foreach($allData as $key => $purchase)

											<tr>
												<td>{{$key+1}}</td>
												<td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
												<td>{{$purchase->purchase_no}}</td>
												<td>{{$purchase['brand']['name']}}</td>
												<td>{{$purchase['product']['name']}}</td>
												
												<td>
													{{$purchase->buying_qty}}
													{{$purchase['product']['unit']['name']}}
												</td>
												<td>{{$purchase->unit_price}}</td>
												<td>{{$purchase->buying_price}}</td>
											@php
												$total_sum+=$purchase->buying_price;

											@endphp
											</tr>
										@endforeach
											<tr>
												
												<td colspan="5" class="text-center">
													<strong>In Word: </strong>
													@php 
														echo NumConvert::word($total_sum); 
													@endphp
													taka
												</td>
												<td style="text-align: right;" colspan="2"><strong>Grand Total=</strong></td>
												<td >{{$total_sum}}/-Tk</td>
											</tr>
									</tbody>
								</table>
								@php
									$date = new DateTime('now', new DateTimezone('Asia/dhaka'));
								@endphp
								<i>Printing time : {{$date->format('F j,Y,g:i a')}}</i>
							</div>
							<div class="col-md-12 mt-7 py-4">
								 <hr class="pt-8 mb-2">
								<table border="0" width="100%" class="mt-6" >
									<tbody>
										<tr>
											<td style="width:40%">
												<!-- <p style="text-align: center; margin-left: 20px;">Customer Signature</p> -->
											</td>

											<td style="width:20%"></td>
											<td style="width:40%; text-align: center;">
												<p class="text-center">Owner Signature</p>
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
    <!-- print scrip -->
	<script>
		$(document).ready(function(){
			$('.printBtn').on('click',function(e){
				e.preventDefault();
				
			var printContent = document.getElementById('printDiv').innerHTML;
			var originalContent = document.body.innerHTML;
			document.body.innerHTML = printContent;
			window.print();
			document.body.innerHTML = originalContent;
			});

		});

	</script>
<!-- /page content -->
@endsection