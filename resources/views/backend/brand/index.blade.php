@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Brand List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <div class="col-md-8">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Brand Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $brand)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$brand->name}}</td>
                                                <td>
                                                    @if($brand->status==1)
                                                        <span class="badge badge-success p-2"><strong>Published</strong></span>
                                                    @else
                                                    <span class="badge badge-warning p-2"><strong>Pending</strong></span>
                                                    @endif
                                                </td>
                                                     <td>
                                                        <button type="button" title="edit" data-id="{{$brand->id}}" class="btn btn-sm btn-primary brandEditBtn"><i class="fa fa-edit"></i></button>
                                                
                                                        <button type="button" title="delete"  data-id="{{$brand->id}}"  class="btn btn-sm btn-danger brandDelBtn"><i class="fa fa-trash"></i></button>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 BrandAddFrom">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add Brand</h4>
                                    </div>
                                    <div class="card-body">
                                            <!--                                         
                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif -->
                                        <div class="errorMsg"></div>
                                        <form id="brandFrom"  method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Brand Name</label>
                                                <input type="text" id="name" class="form-control" name="name">
                                                <span class="text-danger mt-2">@error('name')<strong>{{$message}}</strong>@enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" id="add_brand">Add Brand</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                       
                            </div>

                            <!-- update form  -->
                            <div class="col-md-4 BrandupdateFrom">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Brand</h4>
                                    </div>
                                    <div class="card-body">
                                            <!--                                         
                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif -->
                                        
                                        <form id="update_brand_form">
                                            @csrf
                                            <input type="hidden" id="brand_update_id" name="brand_update_id">
                                            <div class="form-group">
                                                <label for="name">Brand Name</label>
                                                <input type="text" id="update_name" class="form-control" name="update_name">
                                                <span class="text-danger mt-2">@error('name')<strong>{{$message}}</strong>@enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <select name="update_status" id="update_status" class="form-control">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Published</option>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" id="update_brand">Update Brand</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                       
                            </div>
                            <!-- update form  -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
    
<!-- /page content -->
@endsection