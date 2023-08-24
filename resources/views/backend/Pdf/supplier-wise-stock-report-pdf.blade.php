@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Supplier Wise Product List
                      <span class="float-right">
                        <button type="button" class="btn btn-sm btn-success printBtn"> <i class="fa fa-print"></i> Print</button>
                      </span>
                    </h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row" id="sup_wise_product_div_print_div">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                          <div class="col-md-12">
                            <table width="100%">
                              <tbody>
                                <tr>
                                  <td width="30%"></td>
                                  <td width="40%"><img src="{{asset('header.png')}}" alt=""></td>
                                  <td width="30%"></td>
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
                                  <td width="60%"></td>
                                  <td class="text-center"><u><strong><span style="font-size:18px">Supplier Wise Stock Report</span></strong></u></td>
                                  <td width="10%"></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div>
                              <strong>Supplier Name: </strong> {{$allData['0']['supplier']['name']}}<br>
                              <strong>Mobile: </strong> {{$allData['0']['supplier']['mobile_no']}}
                          </div>
                          
                          <table class="table table-bordered mt-2" width="100%">
                            <thead>
                              <tr>
                                <th>Sl</th>
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
                            
                                $buying_total = App\Models\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                                $selling_total = App\Models\InvoiceDetails::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                                        
                              @endphp
                              <tr>
                                <td>{{$key+1}}</td>
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
       
    

<script>
		$(document).ready(function(){
			$('.printBtn').on('click',function(e){
				e.preventDefault();
				
        var printContent = document.getElementById('sup_wise_product_div_print_div').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
			});

		});

	</script>
  <!-- /page content -->
@endsection