<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice PDF</title>
	<!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <style>
  img{
  	width: 180px;
  	height: 60px;
  	text-align: center;
  }
  </style>
</head>
<body>
	<div class="container">
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
							<td width="30%"><strong>Invoice No #{{$invoice->invoice_no}}</strong></td>
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
							<td width="40%"></td>
							<td><u><strong><span style="font-size:18px">Customer Invoice</span></strong></u></td>
							<td width="30%"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@php
          $payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
        @endphp
          <table width="100%">
                	<tbody>
                		<tr>
                			<td width="35%"><strong>Name: </strong>{{$payment['customer']['name']}}</td>
                			<td width="25%"><strong>Mobile: </strong>{{$payment['customer']['mobile_no']}}</td>
                			<td width="40%"><strong>Address: </strong>{{$payment['customer']['address']}}</td>
                		</tr>
                	</tbody>
          </table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table width="100%" border="1" style="border-collapse:collapse;">
          <thead>
                     <tr class="text-center">
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
                       <td colspan='5' style="text-align: right;"><strong>Sub Total</strong></td>
                       <td style="text-align: center;">{{$total_sum}}/-Tk</td>
                     </tr>
                     <tr>
                       <td colspan='5' style="text-align: right;"><strong>Discount</strong></td>
                       <td style="text-align: center;">{{$payment->discount_amount}}/-Tk</td>
                     </tr>
                     <tr>
                       <td colspan='5' style="text-align: right;"><strong>Grand Total</strong></td>
                       <td style="text-align: center;">{{$payment->total_amount}}/-Tk</td>
                     </tr>
                     <tr>
                       <td colspan='5' style="text-align: right;"><strong>Paid Amount</strong></td>
                       <td style="text-align: center;">{{$payment->paid_amount}}/-Tk</td>
                     </tr>
                     <tr>
                       <td colspan='5' style="text-align: right;"><strong>Due Amount</strong></td>
                       <td style="text-align: center;">{{$payment->due_amount}}/-Tk</td>
                     </tr>
                   </tbody>
        </table>
              @php
                $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
              @endphp
              <i>Printing time : {{$date->format('F j,Y, g:i a')}}</i>
			</div>
		</div>
		<div class="row" style="margin-top: 50vh;">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px; margin-top: 20px;">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width:40%">
								<p style="text-align: center; margin-left: 20px;">Customer Signature</p>
							</td>

							<td style="width:20%"></td>
							<td style="width:40%; text-align: center;">
								<p style="text-align: center;">Seller Signature</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>