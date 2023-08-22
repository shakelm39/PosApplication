@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Supplier Wise Product List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <div class="card">
                            <div class="card-body">
                                <!-- usertable -->
                                <div class="row">
                                  <div class="col-sm-12 text-center">
                                    <strong>Supplier Wise Report</strong>
                                    <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;
                                    <strong>Product Wise Report</strong>
                                    <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                                  </div>
                                </div>
                                <div class="show_supplier" style="display: none;">
                                  <form action="{{route('stock.report.supplier.wise.pdf')}}" method="GET" id="supplierForm" target="_blank">
                                    <div class="form-row">
                                      <div class="col-sm-8">
                                        <label for="">Supplier Name</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2bs4" required>
                                          <option value="">Select Supplier</option>
                                          @foreach($suppliers as $supplier)
                                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>

                                          @endforeach
                                        </select>
                                      </div>
                                      
                                        <div class="col-sm-4" style="margin-top: 30px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                      
                                    </div>
                                  </form>
                                </div>
                                <div class="show_product" style="display: none;">
                                  <form action="{{route('stock.report.product.wise.pdf')}}" method="GET" id="productForm" target="_blank">
                                    <div class="form-row">
                                      <div class="form-group col-md-2">
                                        <label for="">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-control select2bs4" style="width: 100%;" required>
                                          <option value="">Select Category</option>
                                          @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <!-- <div class="form-group col-md-2">
                                        <label>Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control select2bs4" style="width: 100%;">
                                          <option value="">Select Brand</option>
                                          @foreach ($brands as $brand)
                                          <option value="{{$brand->id}}">{{$brand->name}}</option>
                                          @endforeach
                                        </select>
                                      </div> -->
                                      <div class="form-group col-md-2">
                                        <label>Product Name</label>
                                        <select name="product_id" id="product_id" class="form-control select2bs4" style="width: 100%;" required>
                                          <option value="">Select Product</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-4" style="margin-top: 30px;">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                      </div>
                                      
                                    </div>
                                  </form>
                                </div>
                                <!-- usertableend -->
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
  <!-- /.content-wrapper -->
  <script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    });
  </script>
  <script type="text/javascript">
    $(document).on('change','.search_value',function(){
      var search_value = $(this).val();
      if (search_value == 'supplier_wise') {
        $('.show_supplier').show();
      }else{
        $('.show_supplier').hide();
      }
      if (search_value == 'product_wise') {
        $('.show_product').show();
      }else{
        $('.show_product').hide();
      }

    });
  </script>
  <!-- validation -->
  <!-- supplier wise -->
  
<!-- product wise validation -->

<!-- change product -->
<script>
    $(document).ready(function(){
      $(document).on('change','#category_id',function(e){
        e.preventDefault();
        var category_id = $(this).val();
        
        $.ajax({
          url:"{{route('purchase.get-product')}}",
          type:'GET',
          data:{category_id:category_id},
          success:function(data){
            var html = '<option value="">Select Product</option>';
            $.each(data,function(key,v){
              html+='<option value="'+v.id+'">'+v.name+'</option>';
            });
            $("#product_id").html(html);
          }
        });
      });
    });
</script>
@endsection