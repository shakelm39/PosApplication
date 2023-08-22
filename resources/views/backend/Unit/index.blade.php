@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Unit List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <div class="col-md-8">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap unitTbl" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Unit Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($units as $key => $unit)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$unit->name}}</td>
                                                <td>
                                                    @if($unit->status==1)
                                                        <span class="badge badge-success p-2"><strong>Published</strong></span>
                                                    @else
                                                    <span class="badge badge-warning p-2"><strong>Pending</strong></span>
                                                    @endif
                                                </td>
                                                @php
                                                    $count_unit = App\Models\Product::where('unit_id',$unit->id)->count();
                                                @endphp
                                                <td>
                                                    <button type="button" title="edit" data-id="{{$unit->id}}" class="btn btn-sm btn-primary unitEditBtn"><i class="fa fa-edit"></i></button>
                                                    @if($count_unit<1)
                                                    <button type="button" title="delete"  data-id="{{$unit->id}}"  class="btn btn-sm btn-danger unitDelBtn"><i class="fa fa-trash"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 unitAddDiv">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add Unit</h4>
                                    </div>
                                    <div class="card-body">
                                            <!--                                         
                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif -->
                                        <div class="errorMsg"></div>
                                        <form id="unitAddFrom">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Unit Name</label>
                                                <input type="text" id="name" class="form-control" name="name">
                                                <!-- <span class="text-danger mt-2">@error('name')<strong>{{$message}}</strong>@enderror</span> -->
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" id="add_unit">Add Unit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                       
                            </div>

                            <!-- update form  -->
                            <div class="col-md-4 unitupdateFrom">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Unit</h4>
                                    </div>
                                    <div class="card-body">
                                            <!--                                         
                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif -->
                                        
                                        <form id="update_unit_form">
                                            @csrf
                                            <input type="hidden" id="unit_update_id" name="unit_update_id">
                                            <div class="form-group">
                                                <label for="name">Unit Name</label>
                                                <input type="text" id="unitUpdateName" class="form-control" name="unitUpdateName">
                                                <span class="text-danger mt-2">@error('name')<strong>{{$message}}</strong>@enderror</span>
                                            </div>
                                            <div class="form-group">
                                                <select name="unitUpdateStatus" id="unitUpdateStatus" class="form-control">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Published</option>
                                                </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" id="unitUpdateBtn">Update Unit</button>
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