@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Purchase Approval Pending List</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <a href="{{route('purchase.create')}}" type="button" class="btn btn-success">Add Purchase</a>
                            <br />
                            <table class="table table-bordered table-hover table-responsive table-responsive-xl table-responsive-sm" id="example1" style="font-size:12px;">
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
                                                <span style="background: #C82355; padding: 5px; color:#fff;">Pending</span>
                                                @elseif($purchase->status="1")
                                                <span style="background: #A6E22A; padding: 5px; color:#fff;">Approved</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($purchase->status=='0')
                                                    <a title="Approval" id="approveBtn" href="{{route('purchase.approve',$purchase->id)}}" class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></a>
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