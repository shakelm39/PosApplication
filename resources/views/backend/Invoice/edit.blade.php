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
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('brands.update')}}" method="post">
								@csrf
								<div class="item form-group">
									<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Brand Name <span class="required">*</span>
									</label>
                                    <input type="hidden" value="{{$brand->id}}" name="id">
									<div class="col-md-6 col-sm-6 ">
										<input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $brand->name }}">
										<span class="text-danger"><strong>@error('name'){{$message}}@enderror</strong></span>
									</div>
									
								</div>
								<div class="ln_solid"></div>
								<div class="item form-group">
									<div class="col-md-6 col-sm-6 offset-md-3">
										<button type="submit" class="btn btn-success">Update Brand</button>
									</div>
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