@extends('backend.layouts.master')

@section('main-content')
<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Add Purchase
					<a href="{{route('purchase.index')}}" class="btn btn-success float-end btn-sm"><i class="fa fa-list"></i> Purchase List</a>
					</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						
						<div class="x_content">
							@if(session('success'))
								<div class="alert alert-success">{{session('success')}}</div>
							@endif
							<br />
							<div class="card-body">
								<div class="form-row">
								<div class="form-group col-md-4">
									<label for="">Date</label>
									<input type="date" id="date" name='date' class="input-group form-control">
									<!-- <div class="input-group date" name="date" id="reservationdate" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
										<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div> -->
								</div> 
								<div class="form-group col-md-4">
									<label for="">Purchase No</label>
									<input type="text" name="purchase_no" id="purchase_no" class="form-control">
								</div>
								<div class="form-group col-md-4">
									<label for="">Supplier Name</label>
									<select name="supplier_id" id="supplier_id" class="form-control select2bs4" style="width: 100%;">
									<option value="">Select Supplier</option>
									@foreach ($suppliers as $supplier)
									<option value="{{$supplier->id}}">{{$supplier->name}}</option>
									@endforeach
									</select>
								</div>
								
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label>Category</label>
										<select name="category_id" id="category_id" class="form-control select2bs4" style="width: 100%;">
											<option value="">Select Category</option>
										</select>
									</div>
									
									<div class="form-group col-md-4">
										<label>Brand</label>
										<select name="brand_id" id="brand_id" class="form-control select2bs4" style="width: 100%;">
											<option value="">Select Brand</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label>Product Name</label>
											<select name="product_id" id="product_id" class="form-control select2bs4" style="width: 100%;">
										<option value="">Select Product</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-2">
									<a class="btn btn-primary text-white btn-sm addeventmore" ><i class="fa fa-plus-circle"></i> Add Item</a>
								</div>
              				</div>
							<!-- second card body start  -->
								<div class="card-body">
									<form method="post" action="{{route('purchase.store')}}" id="myForm">
										@csrf
										<table class="table-sm table-bordered table-dark" width="100%">
											<thead>
												<tr>
													<th>Category</th>
													<th>Product Name</th>
													<th>Brand Name</th>
													<th widht="7%">Pcs/Kg</th>
													<th widht="10%">Unit Price</th>
													<th>Description</th>
													<th widht="10%">Total Price</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="addRow" class="addRow">
												
											</tbody>
											<tbody>
												<tr>
													<td colspan="6"></td>
													<td>
														<input type="text" name="estimated_amount" value='0' id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background: #D8FDEA;">
													</td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<br>
										<div class="form-group">
										<button type="submit" class='btn btn-success' id="storeButton">Purchase Store</button>
										</div>
									</form>
								</div>
							<!-- second card body end -->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<!-- /page content -->
<!-- handlebars -->
<script id="document-template" type="text/x-handlebars-template">  
	<tr class="delete_add_more_item" id="delete_add_more_item">
		<input type="hidden" name="date[]" value="@{{date}}">
		<input type="hidden" name = "purchase_no[]" value="@{{purchase_no}}">
		<input type="hidden" name = "supplier_id[]" value="@{{supplier_id}}">
		<td>
		<input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
		</td>
		<td>
		<input type="hidden" name="product_id[]" value="@{{product_id}}">@{{product_name}}
		</td> 
		<td>
		<input type="hidden" name="brand_id[]" value="@{{brand_id}}">@{{brand_name}}
		</td>
		<td>
		<input type="number" min="1" name="buying_qty[]" value="1" class="form-control form-control-sm text-right buying_qty">
		</td>
		<td>
		<input type="number" min="1" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
		</td>
		<td>
		<input type="text" name="description[]" class="form-control form-control-sm">
		</td>
		<td>
		<input name="buying_price[]" value="0" class="form-control form-control-sm text-right buying_price" readonly>
		<td><i class="btn btn-danger btn-sm fa fa-times removeeventmore"></i></td>
		</td>
	</tr>
</script>
<script type="text/javascript">
	//select category 

	$(document).ready(function(){
		
  		$(document).on('change','#supplier_id',function(){
  			var supplier_id = $(this).val();
            console.log(supplier_id);
  			$.ajax({
  				url:"{{route('purchase.get-category')}}",
  				type:'GET',
  				data:{supplier_id:supplier_id},
  				success:function(data){
  					var html = '<option value="">Select Category</option>';
  					$.each(data,function(key,v){
  						html+='<option value="'+v.category_id+'">'+v.category.name+'</option>';
  					});
  					$("#category_id").html(html);
  				}
  			});
  		});
  	
		//category select end

		// select brand start 
		
//select brand 
  
	
			$(document).on('change','#product_id',function(){
				var product_id = $(this).val();
				$.ajax({
				url:"{{route('purchase.get-brand')}}",
				type:'GET',
				data:{product_id:product_id},
				success:function(data){
					var html = '<option value="">Select Brand</option>';
					$.each(data,function(key,v){
					html+='<option value="'+v.brand_id+'">'+v.brand.name+'</option>';
					});
					$("#brand_id").html(html);
				}
				});
			});
		
	// select brand End

  // select product
  
  	
          $(document).on('change','#category_id',function(){
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
       
//select product End

	});

  
</script>

@endsection