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
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Unit Lists</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Unit</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($units as $key=> $unit)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$unit->name}}</td>
                                                                
                                                            <td>
                                                                <a title="edit" href="{{route('units.edit',$unit->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                                
                                                                <a title="delete" href="{{route('units.delete',$unit->id)}}" onclick="return confirm('Are you sure to delete this data?')" id="delete"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add Unit</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                                @if(session('success'))
                                                    <div class="alert alert-success">{{session('success')}}</div>
                                                @endif
                                            
                                            <form action="{{route('units.store')}}" method="POST" id="unitForm">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="unit">Unit Name</label>
                                                    <input type="text" id="name" class="form-control" name="name">
                                                    <span class="text-danger mt-2">@error('name')<strong>{{$message}}</strong>@enderror</span>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info" id="unitBtn">Add Unit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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