<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily Invoice Report PDF</title>
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
							<td width="30%"></td>
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
							<td width="10%"></td>
							<td><u><strong><span style="font-size:18px">Daily Invoice Report({{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}})</span></strong></u></td>
							<td width="10%"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
    <div class="col-md-12">
      <table border="1" style="margin-bottom: 50px;" width="100%">
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
		<div class="row">
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
								<p style="text-align: center; border-bottom:1px solid #000;">Owner Signature</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>