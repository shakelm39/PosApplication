@extends('backend.layouts.master')

@section('main-content')
<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Edit Brand</h3>
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
							<form method="post" action="{{route('products.update',$editData->id)}}" id="myForm">
								@csrf
								<div class="card-body">
									<div class="form-row">
									<div class="form-group col-md-4">
										<label for="supplier_id">Supplier Name</label>
										<select name="supplier_id" class="form-control">
										<option value="">Select Supplier</option>
										@foreach ($suppliers as $supplier)
										<option value="{{$supplier->id}}" {{($editData->supplier_id==$supplier->id)?'selected':''}}>{{$supplier->name}}</option>
										@endforeach
										</select>
									</div> 
									<div class="form-group col-md-4">
										<label for="brand_id">Brand Name</label>
										<select name="brand_id" class="form-control">
										<option value="">Select Brand</option>
										@foreach ($brands as $brand)
										<option value="{{$brand->id}}" {{($editData->brand_id==$brand->id)?'selected':''}}>{{$brand->name}}</option>
										@endforeach
										</select>
										
									</div>
									<div class="form-group col-md-4">
										<label for="category_id">Category</label>
										<select name="category_id" class="form-control">
										<option value="">Select Category</option>
										@foreach ($categories as $category)
										<option value="{{$category->id}}" {{($editData->category_id==$category->id)?'selected':''}}>{{$category->name}}</option>
										@endforeach
										</select>
									</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-6">
										<label for="name">Product Name</label>
										<input type="text" name="name" value="{{($editData->name)}}" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label for="unit_id">Unit</label>
										<select name="unit_id" class="form-control">
										<option value="">Select Unit</option>
										@foreach ($units as $unit)
										<option value="{{$unit->id}}" {{($editData->unit_id==$unit->id)?'selected':''}}>{{$unit->name}}</option>
										@endforeach
										</select>
									</div>
									</div>
								</div>
								<!-- /.card-body -->

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
								</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<!-- /page content -->
@endsection