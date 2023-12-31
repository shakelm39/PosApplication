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
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Brand Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData as $key => $brand)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$brand->name}}</td>
                                                
                                                    <td><a title="edit" href="{{route('brands.edit',$brand->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                               
                                                    <a title="delete" onclick="return confirm('Are you sure to delete this data?')" id="delete" href="{{route('brands.delete',$brand->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- /page content -->
@endsection