@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
<div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Product List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                           <div class="text-center">
                                <!-- @if(session('success'))
                                   <span class="alert alert-success">{{session('success')}}</span>
                                  
                                @endif -->
                           </div>
                            <br />
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#productModal">Add Product</button>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                    <th>Sl</th>
                                    <th>Supplier Name</th>
                                    <th>Brand Name</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData as $key => $product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$product['supplier']['name']}}</td>
                                            <td>{{$product['brand']['name']}}</td>
                                            <td>{{$product['category']['name']}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product['unit']['name']}}</td>
                                            @php
                                                $count_product = App\Models\Purchase::where('product_id',$product->id)->count();
                                            @endphp
                                            <td><a title="edit" href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @if($count_product<1)
                                                <a title="delete" onclick="return confirm('Are you sure to delte this data?')" id="delete" href="{{route('products.delete',$product->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            @endif
                                            </td>
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

    <!-- product add modal  -->

        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModal">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMsg"></div>
                        <!-- product form start  -->
                        <form method="post" action="{{route('products.store')}}" id="myForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="supplier_id">Supplier Name</label>
                                        <select name="supplier_id" class="form-control" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        @endforeach
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label for="brand_id">Brand Name</label>
                                        <select name="brand_id" class="form-control" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="unit_id">Unit</label>
                                        <select name="unit_id" class="form-control" required>
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            
                        </form>
                        <!-- product form end -->
                    </div>
                
                </div>
            </div>
        </div>
    <!-- add modal end  -->

    

@endsection