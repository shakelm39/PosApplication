@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Category List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key=> $category)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            
                                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('categories.delete',$category->id)}}" id="delBtn" onclick="return confirm('Are you sure to delete this data?')"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center fw-bold">Add Category</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                @if(session('success'))
                                <span class="text-success mb-4"><strong>{{ session('success') }}</strong></span>
                                @endif
                                <form action="{{route('categories.store')}}" method="POST">
                                    @csrf
                                    
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="name" class="form-control" id="category" placeholder="Enter Category">
                                                <span>
                                                @error('name')
                                                    <span class="text-danger py-2">{{ $message }}</span>
                                                @enderror

                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><button type="submit" class="btn btn-primary" id="cat_btn" >Add Category</button></td>
                                        </tr>
                                    </tbody>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
<!-- /page content -->
@endsection