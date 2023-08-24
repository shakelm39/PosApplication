@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Product Stock List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <div class="card-header">
                              <h3>Product
                                <a href="{{route('stock.report.pdf')}}" target="_blank" class="btn btn-success float-right btn-sm"><i class="fa fa-download"></i> Download PDF</a>
                              </h3>
                            </div>
                            <table class="table table-bordered table-hover" id="example1">
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
                                  $buying_total = App\Models\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                                  $selling_total = App\Models\InvoiceDetails::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                                @endphp
                                <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$product['supplier']['name']}}</td>
                                  <td>{{$product['brand']['name']}}</td>
                                  <td>{{$product['category']['name']}}</td>
                                  <td>{{$product->name}}</td>
                                  <td>{{$buying_total}}</td>
                                  <td>{{$selling_total}}</td>
                                  <td>{{$product->quantity}}</td>
                                  <td>{{$product['unit']['name']}}</td>
                                  
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
    
<!-- /page content -->
@endsection