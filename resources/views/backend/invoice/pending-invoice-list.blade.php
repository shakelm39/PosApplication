@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Pending Invoice List</h3>
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
                                          <th>Status</th>
                                          <th width="10%">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($invoiceData as $key=> $invoice)
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
                                            @if($invoice->status=='0')
                                            <span style="background: #C82355; padding: 5px; color:#fff;">Pending</span>
                                            @elseif($invoice->status="1")
                                            <span style="background: #A6E22A; padding: 5px; color:#fff;">Approved</span>
                                            @endif
                                          </td>
                                          <td>
                                            @if($invoice->status=='0')
                                          <a title="Approval" id="approveBtn" href="{{route('invoice.approve',$invoice->id)}}" class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></a>
                                          <a title="delete" id="delete" href="{{route('invoice.delete',$invoice->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
 
  <!-- /.content-wrapper -->
@endsection  