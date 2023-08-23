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
                            <button type="button" class="btn btn-primary mb-3" id="addSupplier" data-toggle="modal" data-target="#supplierModal">Add Supplier</button>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $key=>$supplier)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->mobile_no}}</td>
                                            <td>{{$supplier->email}}</td>
                                            <td>{{$supplier->address}}</td>
                                            <td>
                                                @if($supplier->status==1)
                                                    <span class="badge badge-success p-2"><strong>Published</strong></span>
                                                    @else
                                                    <span class="badge badge-warning p-2"><strong>Pending</strong></span>
                                                @endif
                                            </td>
                                                @php
                                                    $count_supplier = App\Models\Product::where('supplier_id',$supplier->id)->count();
                                                @endphp
                                            <td>
                                                <button type="button" data-id="{{$supplier->id}}" class="btn btn-sm btn-success supEditBtn"><i class="fa fa-edit"></i></button>
                                                
                                                @if($count_supplier<1)
                                                 <button type="button" data-id="{{$supplier->id}}" class="btn btn-sm btn-danger supDelBtn"><i class="fa fa-trash"></i></button>
                                                @endif
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
   
        <!-- Add Modal -->
        <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMsg"></div>
                        <form action="" method="post" id="supplierFrom">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                                
                            </div>
                            <div class="form-group">
                                <label for="mobile_no">Mobile</label>
                                <input type="number" name="mobile_no" class="form-control" id="mobile">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="5" rows="4"></textarea>
                            </div>
                            
                            <button type="button" class="btn btn-primary supplierBtn">Add Supplier</button>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- add modal end  -->
        
        <!-- update modal  -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Update Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMsg"></div>
                        <form id="supEditFrom" class="updateFrom">
                            @csrf
                            <input type="text" id="id" name="updateId">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="updatename"  class="form-control" id="Up_name" aria-describedby="name">
                                
                            </div>
                            <div class="form-group">
                                <label for="mobile_no">Mobile</label>
                                <input type="number" name="updatemobile_no"  class="form-control" id="Up_mobile">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="updateemail"  class="form-control" id="Up_email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="updateaddress" id="Up_address"  class="form-control" cols="5" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="updateStatus"  id="upStatus" class="form-control">
                                    <option value="0">Pending</option>
                                    <option value="1">Published</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary supUpdateBtn">Update Supplier</button>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!--update modal end-->
<!-- /page content -->
@endsection