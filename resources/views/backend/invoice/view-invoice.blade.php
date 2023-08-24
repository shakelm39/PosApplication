@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Invoice</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br /> 
                            <div class="card">
                              <div class="card-header">
                                <h3>Invoice
                                  <a href="{{route('invoice.add')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i> Add Invoice</a>
                                </h3>
                              </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                              <!-- usertable -->
                              <table class="table table-bordered table-hover" id="example1">
                                <thead>
                                  <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($allData as $key=> $invoice)
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                                      <td>Invoice No#{{$invoice['payment']['invoice_id']}}</td>
                                      <td>
                                      {{$invoice['payment']['customer']['name']}}
                                      ({{$invoice['payment']['customer']['mobile_no']}}-{{$invoice['payment']['customer']['address']}})
                                      </td>
                                      <td>{{$invoice->description}}</td>
                                      <td>{{$invoice['payment']['total_amount']}}/-Tk</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              <!-- usertableend -->
                            </div><!-- /.card-body -->
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /page content -->
@endsection