@extends('backend.layouts.master')

@section('main-content')
<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Mange Profile</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						<div class="x_content">
							<section class="content">
								<div class="container-fluid">
										
									<!-- Main row -->
									<div class="row">
									<!-- Left col -->
										<section class="col-md-4 offset-md-4">
											<!-- Profile Image -->
											<div class="card card-primary card-outline">
												<div class="card-body box-profile">
													<div class="text-center">
													<img class="profile-user-img img-fluid img-circle"
														src="{{(!empty($user->image))?url('public/upload/user_images/'.$user->image):url('public/upload/no_image.jpg')}}"
														alt="User profile picture">
													</div>

													<h3 class="profile-username text-center">{{$user->name}}</h3>

													<p class="text-muted text-center">{{$user->address}}</p>

													<table width='100%' class="table table-striped">
													<tbody>
														<tr>
														<td>Mobile No:</td>
														<td>{{$user->mobile}}</td>
														</tr>
														<tr>
														<td>Email:</td>
														<td>{{$user->email}}</td>
														</tr>
														<tr>
														<td>Gender:</td>
														<td>{{$user->gender}}</td>
														</tr>
													</tbody>
													</table>

													<a href="{{route('profiles.edit')}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
												</div>
												<!-- /.card-body -->
											</div>
										</section>
											<!-- /.Left col -->
											
									</div>
											<!-- /.row (main row) -->
								</div><!-- /.container-fluid -->
							</section>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<!-- /page content -->
@endsection