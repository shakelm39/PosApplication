<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Report PDF</title>
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
              <td width="60%"></td>
              <td><u><strong><span style="font-size:18px">Stock Report</span></strong></u></td>
              <td width="10%"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
    <div class="col-md-12">
      <table border="1" width="100%">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Supplier Name</th>
                      <th>Brand Name</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Purchase Qty</th>
                      <th>Sell Qty</th>
                      <th>Stock Qnty</th>
                      <th>Unit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $product)
                    @php
                      $buying_total = App\Models\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->sum('buying_qty');
                      $selling_total = App\Models\InvoiceDetails::where('category_id',$product->category_id)->where('product_id',$product->id)->sum('selling_qty');
                    @endphp
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$product['supplier']['name']}}</td>
                      <td>{{$product['brand']['name']}}</td>
                      <td>{{$product['category']['name']}}</td>
                      <td>{{$product->name}}</td>
                      <td style="text-align: center;">{{$buying_total}}</td>
                      <td style="text-align: center;">{{$selling_total}}</td>
                      <td style="text-align: center;">{{$product->quantity}}</td>
                      <td>{{$product['unit']['name']}}</td>
                      
                    </tr>
                    @endforeach
                  </tbody>
      </table>
      @php
        $date = new DateTime('now', new DateTimezone('Asia/dhaka'));
      @endphp
      <i>Printing time : {{$date->format('F j,Y,g:i a')}}</i>
    </div>  
    </div>
    <div class="row" style="margin-bottom: 80vh;">
      <div class="col-md-12">
        <!-- <hr style="margin-bottom: 0px; margin-top: 20px;"> -->
        
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
              <td style="width:40%; text-align: center; ">
                <p style="text-align: center; border-bottom:1px solid #000; margin-top:50px;">Owner Signature</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>