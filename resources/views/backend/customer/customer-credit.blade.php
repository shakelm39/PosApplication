@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Credit Customer</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                        <a href="{{route('customers.credit.pdf')}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i>Download PDF</a>
                            <br />
                            <div class="card">
                              <div class="card-body">
                              <table class="table table-bordered table-hover" id="example1">
                                <thead>
                                  <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php
                                    $total_due ='0';
                                  @endphp
                                  @foreach($allData as $key => $payment)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                      {{$payment['customer']['name']}}<br>
                                      ({{$payment['customer']['mobile_no']}}-{{$payment['customer']['address']}})
                                    </td>
                                    <td>Invoice No # {{$payment['invoice']['invoice_no']}}</td>
                                    <td>{{date('j-F-Y',strtotime($payment['invoice']['date']))}}</td>
                                    <td>{{$payment->due_amount}}/- Tk</td>
                                    <td><a title="edit" href="{{route('customers.edit.invoice',$payment->invoice_id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a title="Details" href="{{route('invoice.details.pdf',$payment->invoice_id)}}" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                  </tr>
                                  @php
                                    $total_due+=$payment->due_amount;
                                  @endphp
                                  
                                  @endforeach
                                  <tr>
                                    <td colspan='4' style="text-align:right; font-weight: bold;">Grand Total =</td>
                                    <td >{{$total_due}}/- Tk</td>
                                    <td></td>
                                  </tr>
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