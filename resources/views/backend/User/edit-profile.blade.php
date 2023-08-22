@extends('backend.layouts.master')

@section('main-content')
<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Manage Profile</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						
						<div class="x_content">
							<!-- Left col -->
							<section class="col-md-12">
								<!-- Custom tabs (Charts with tabs)-->
								<div class="card">
									<div class="card-header">
										<h3>Edit Profile
											<a href="{{route('profiles.view')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-user"></i>Your Profile</a>
										</h3>
									</div>
								</div><!-- /.card-header -->
								<div class="card-body">
									<!-- formstart -->
									<form method="post" action="{{route('profiles.update')}}" id="myForm" enctype="multipart/form-data">
									{{csrf_field()}}
									<div class="card-body">
										<div class="form-row">
										<div class="form-group col-md-6">
											<label for="name">User Name</label>
											<input type="text" name="name" value="{{$editData->name}}" class="form-control" id="name" placeholder="Enter User Name">
											<font style="color:red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
										</div>
										<div class="form-group col-md-6">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" value="{{$editData->email}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
											<font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
										</div>
										</div>
										<div class="form-row">
										<div class="form-group col-md-6">
											<label for="mobile">Mobile No</label>
											<input type="number" value="{{$editData->mobile}}" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile">
											<font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
										</div>
										<div class="form-group col-md-6">
											<label for="exampleInputEmail1">Address</label>
											<input type="text" value="{{$editData->address}}" name="address" class="form-control" id="exampleInputaddress1" placeholder="Enter address">
											<font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
										</div>
										</div>
										<div class="form-row">
										<div class="form-group col-md-6">
											<label for="gender">Gender</label>
											<select name="gender" id="gender" class="form-control">
											<option value="">Select Gender</option>
											<option value="Male" {{($editData->gender=="Male")?"selected":""}}>Male</option>
											<option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="image">Image</label>
											<input type="file" name="image" class="form-control" id="image">
										</div>
										</div>
										<div class="form-group col-md-6">
											<img id="showImage" src="{{(!empty($editData->image))?url('public/upload/user_images/'.$editData->image):url('public/upload/no_image.jpg')}}" alt="" style="width: 150px;height: 160px;border:1px solid #000;">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</div>
									<!-- /.card-body -->

									
								</form>
									<!-- formend -->
								</div><!-- /.card-body -->
								</div>
								<!-- /.card -->
							</section>
							<!-- /.Left col -->
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<!-- /page content -->
@endsection