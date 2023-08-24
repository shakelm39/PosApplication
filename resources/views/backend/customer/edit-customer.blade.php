@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Customer</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <a href="{{route('customers.view')}}" class="btn btn-success  btn-sm"><i class="fa   fa-list"></i> Customer List
                            </a>
                            <br />
                            <div class="card">
                              <div class="card-body">
                                <!-- formstart -->
                                  <form method="post" action="{{route('customers.update',$editData->id)}}" id="updateFrom">
                                    {{csrf_field()}}
                                    <div class="card-body">
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="name">Customer Name</label>
                                          <input type="text" name="name" value="{{$editData->name}}" class="form-control" id="name" placeholder="Enter Customer Name">
                                          <font style="color:red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="mobile_no">Mobile No</label>
                                          <input type="number" name="mobile_no" value="{{$editData->mobile_no}}" class="form-control" id="mobile_no" placeholder="Enter Customer mobile_no">
                                          <font style="color:red">{{($errors->has('mobile_no'))?($errors->first('mobile_no')):''}}</font>
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Email address</label>
                                          <input type="email" value="{{$editData->email}}" name="email" class="form-control" id="email" placeholder="Enter email">
                                          <font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="exampleInputEmail1">Address</label>
                                          <input type="text" value="{{$editData->address}}" name="address" class="form-control" id="address" placeholder="Enter address">
                                          <font style="color:red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                      
                                    </div>
                                    <!-- /.card-body -->
                                    
                                  </form>
                                  <!-- formend -->
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
<!-- /page content -->
@endsection