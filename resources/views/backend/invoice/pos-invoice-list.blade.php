@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Print Invoice</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <br /> 
                           <div class="card">
                            <div class="card-body">
                              <table class="table table-bordered table-hover" id="example1">
                                <thead>
                                  <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>
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
                                    <td>
                                      <a title="print" class="btn btn-success" href="{{route('invoice.print',$invoice->id)}}" target="_blank"><i class="fa fa-print"></i></a>
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

  <!-- /.content-wrapper -->
@endsection