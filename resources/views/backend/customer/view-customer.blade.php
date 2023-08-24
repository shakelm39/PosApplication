@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Customer List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                        <a href="{{route('customers.add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add customer</a>
                            <br />
                            <div class="card">
                              <div class="card-body">
                                <table class="table table-bordered table-hover" id="example1">
                                  <thead>
                                    <tr>
                                      <th>Sl</th>
                                      <th>customer Name</th>
                                      <th>Mobile</th>
                                      <th>Email</th>
                                      <th>Address</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($allData as $key => $customer)
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$customer->name}}</td>
                                      <td>{{$customer->mobile_no}}</td>
                                      <td>{{$customer->email}}</td>
                                      <td>{{$customer->address}}</td>
                                      <td>
                                        <a title="edit" href="{{route('customers.edit',$customer->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                          @php
                                            $count_customer = App\Models\Payment::where('customer_id',$customer->id)->count();
                                          @endphp

                                          @if($count_customer<1)
                                            <a title="delete" id="delete" href="{{route('customers.delete',$customer->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

        </div>
    </div>
   
<!-- /page content -->
@endsection