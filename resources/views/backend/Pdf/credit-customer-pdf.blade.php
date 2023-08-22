<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credit Customer Report PDF</title>
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
              <td></td>
              <td width="40%"><u><strong><span style="font-size:18px">Credit Customer Report</strong></u></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
    <div class="col-md-12">
      <table width="100%" border="1">
        <thead>
          <tr>
            <th>Sl</th>
            <th>Customer Name</th>
            <th>Invoice No</th>
            <th>Date</th>
            <th>Amount</th>
            
          </tr>
        </thead>
        <tbody>
          @php
            $total_due ='0';
          @endphp
          @foreach($allData as $key => $payment)
          <tr>
            <td>{{$key+1}}</td>
            <td>
              {{$payment['customer']['name']}}<br>
              ({{$payment['customer']['mobile_no']}}-{{$payment['customer']['address']}})
            </td>
            <td>Invoice No # {{$payment['invoice']['invoice_no']}}</td>
            <td>{{date('j-F-Y',strtotime($payment['invoice']['date']))}}</td>
            <td>{{$payment->due_amount}}/- Tk</td>
            @php
              $total_due+=$payment->due_amount;
            @endphp
          </tr>
          @endforeach
          <tr>
            <td colspan='4' style="text-align:right; font-weight: bold;">Grand Total =</td>
            <td >{{$total_due}}/- Tk</td>
          </tr>
        </tbody>
      </table>
      @php
         $date = new DateTime('now', new DateTimezone('Asia/dhaka'));
      @endphp
      <i>Printing time : {{$date->format('j-F-Y,g:i a')}}</i>
    </div>  
    </div>
    <div class="row" style="margin-top: 50px;">
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