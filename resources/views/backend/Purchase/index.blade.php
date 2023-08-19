@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Product Purchase List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <a href="{{route('purchase.create')}}" type="button" class="btn btn-success">Add Purchase</a>
                            <br />
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">Sl</th>
                                        <th style="width:15%;">Date</th>
                                        <th style="width:5%;">Purchase No</th>
                                        <th style="width:10%;">Supplier Name</th>
                                        <th style="width:10%;">Category</th>
                                        <th style="width:10%;">Brand Name</th>
                                        <th style="width:10%;">Product Name</th>
                                        <th style="width:10%;">Description</th>
                                        <th style="width:5%;">Qty</th>
                                        <th style="width:5%;">Unit Price</th>
                                        <th style="width:5%;">Buying Price</th>
                                        <th style="width:5%;">Status</th>
                                        <th style="width:15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData as $key => $purchase)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                                            <td>{{$purchase->purchase_no}}</td>
                                            <td>{{$purchase['supplier']['name']}}</td>
                                            <td>{{$purchase['category']['name']}}</td>
                                            <td>{{$purchase['brand']['name']}}</td>
                                            <td>{{$purchase['product']['name']}}</td>
                                            <td>{{$purchase->description}}</td>
                                            <td>
                                                {{$purchase->buying_qty}}
                                                {{$purchase['product']['unit']['name']}}
                                            </td>
                                            <td>{{$purchase->unit_price}}</td>
                                            <td>{{$purchase->buying_price}}</td>
                                            <td>
                                                @if($purchase->status=='0')
                                                <span class="badge badge-warning p-2">Pending</span>
                                                @elseif($purchase->status="1")
                                                <span class="badge badge-success p-2">Approved</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($purchase->status=='0')
                                                    <a title="delete" onclick="return confirm('Are you sure want to delete this?')" id="delete" href="{{route('purchase.delete',$purchase->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<!-- /page content -->
@endsection