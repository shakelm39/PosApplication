
<!-- Content Wrapper. Contains page content -->
@extends('backend.layouts.master')

@section('main-content')
<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Password Manage</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
					<div class="x_panel">
						
						<div class="x_content">
							
							<br />
							<form method="post" action="{{route('profiles.password.update')}}" id="passForm">
                            {{csrf_field()}}
                            <div class="card-body">
                                
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="current_password">Current Password</label>
                                    <input type="text"  name="current_password" class="form-control" id="current_password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" name="password2" class="form-control">
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

    <script>
        $(function () {
            $.validator.setDefaults({
            submitHandler: function () {
                alert( "Form successful submitted!" );
            }
            });
            $('#passForm').validate({
            rules: {
                current_password: {
                required: true,
                current_password: true,
                }, 
                new_password: {
                required: true,
                minlength: 6
                },
                password2: {
                required: true,
                equalTo: '#new_password'
                }
            
            },
            messages: {
                current_password: {
                required: "Please Enter current Password",
                current_password: "Please Enter current Password"
                },
                new_password: {
                required: "Please Enter new password",
                minlength: "Your new password must be at least 6 characters long"
                },
                password2: {
                required: "Please provide a Confirm Password",
                equalTo: 'Confirmed Password Does not match'
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
            });
        });
    </script>
  <!-- /.content-wrapper -->
@endsection