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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
                	<h3>Invoice No #{{$invoice->invoice_no}}({{date('d-m-Y',strtotime($invoice->date))}})
                		<a href="{{route('invoice.pending.list')}}" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Pending Invoice list</a>
                  
                	</h3>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                @php
                $payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
                @endphp
               <table width="100%">
                 <tbody>
                   <tr>
                     <td width="15%"><p> Customer Info </p></td>
                     <td width="30%"><p> Name:{{$payment['customer']['name']}} </p></td>
                     <td width="30%"><p> Mobile No:{{$payment['customer']['mobile_no']}} </p></td>
                     <td width="25%"><p> Address:{{$payment['customer']['address']}} </p></td>
                   </tr>
                   <tr>
                     <td width="15%"></td>
                     <td width="85%" colspan="3">Description: {{$invoice->description}}</td>
                   </tr>
                 </tbody>
               </table>
               <form action="{{route('approval.store',$invoice->id)}}" method="post">
                @csrf
                 <table class="table table-bordered">
                   <thead>
                     <tr class="text-center">
                       <th>Sl</th>
                       <th>Category</th>
                       <th>Product Name</th>
                       <th class="bg-secondary">Current Stock</th>
                       <th>Selling Qty</th>
                       <th>Unit Price</th>
                       <th>Total Price</th>
                     </tr>
                   </thead>
                   <tbody>
                    @php 
                      $total_sum ='0';
                    @endphp
                    @foreach($invoice['invoice_details'] as $key => $details)
                     <tr class="text-center">
                      <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                      <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                      <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                       <td>{{$key+1}}</td>
                       <td>{{$details['category']['name']}}</td>
                       <td>{{$details['product']['name']}}</td>
                       <td class="bg-secondary">{{$details['product']['quantity']}}</td>
                       <td>{{$details->selling_qty}}</td>
                       <td>{{$details->unit_price}}</td>
                       <td>{{$details->selling_price}}</td>
                     </tr>
                      @php 
                        $total_sum +=$details->selling_price;
                      @endphp
                     @endforeach
                     <tr class="text-center">
                       <td colspan='6' class="text-right"><strong>Sub Total</strong></td>
                       <td>{{$total_sum}}</td>
                     </tr>
                     <tr class='text-center'>
                       <td colspan='6' class="text-right"><strong>Discount</strong></td>
                       <td>{{$payment->discount_amount}}</td>
                     </tr>
                     <tr class="text-center">
                       <td colspan='6' class="text-right"><strong>Grand Total</strong></td>
                       <td>{{$payment->total_amount}}</td>
                     </tr>
                     <tr class='text-center'>
                       <td colspan='6' class="text-right"><strong>Paid Amount</strong></td>
                       <td>{{$payment->paid_amount}}</td>
                     </tr>
                     <tr class='text-center'>
                       <td colspan='6' class="text-right"><strong>Due Amount</strong></td>
                       <td>{{$payment->due_amount}}</td>
                     </tr>
                   </tbody>
                 </table>
                 <button class="btn btn-success">Invoice Approve</button>
               </form>
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