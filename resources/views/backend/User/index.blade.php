@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>User List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <button class="btn btn-primary mb-2" id="addUserBtn" data-toggle="modal" data-target="#userModal">Add User</button>
                            <br />
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap userTbl" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData as $key => $user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->usertype}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->status==1)
                                                <span class="badge badge-success p-2">Active</span>
                                                @else
                                                <span class="badge badge-warning p-2">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" title="edit" data-id="{{$user->id}}" class="btn btn-sm btn-primary userEditBtn"><i class="fa fa-edit"></i></button>
                                                <button type="button" title="delete"  data-id="{{$user->id}}" class="btn btn-sm btn-danger userDelBtn"><i class="fa fa-trash"></i></button>
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
        <!-- Add Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModal">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMsg"></div>
                        <form id="userAddForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                           
                            <div class="form-group">
                                <label for="usertype">User Type</label>
                                <select name="usertype" class="form-control" id="usertype">
                                        <option value="">Select User Type</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                </select>
                                
                            </div>
                            <button type="submit" class="btn btn-primary userBtn">Add User</button>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- add modal end  -->
        
        <!-- update modal  -->
        <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModal">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMsg"></div>
                        <form id="userUpForm">
                            @csrf
                            <div class="col">
                                <input type="hidden" id='userUpId' name="userUpId">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" name="name" class="form-control" id="upname" aria-describedby="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="upemail">
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usertype">User Type</label>
                                        <select name="usertype" class="form-control" id="upusertype">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="upstatus">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary userUpBtn">Udate User</button>
                            </div>
                            
                            
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <!--update modal end-->
    </div>
<!-- /page content -->
@endsection