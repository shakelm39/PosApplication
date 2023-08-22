@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Pending Invoice</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              	<div class="card-header">
                	<h3>Pending Invoice
                		<!-- <a href="{{route('invoice.add')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-plus-circle"></i> Add Invoice</a> -->
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
                      <th>Status</th>
                      <th width="10%">Action</th>
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
                
                <!-- usertableend -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection