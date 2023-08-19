@extends('backend.layouts.master')
@section('content')
       <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td></td>
                                <td><img src="{{asset('header.png')}}" alt=""></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="30%"></td>
                                <td width="40%"><span style="font-size:20px;">Spk Electronics <br></span>Gotia,Puthia, Rajshahi.</td>
                                <td width="30%"><span>Shop No:101 <br>Owner Mobile:01831603111</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr style="margin-bottom: 0px; margin-top: 20px;">
                    <table>
                        <tbody>
                            <tr>
                                <td width="10%"></td>
                                <td><u><strong><span style="font-size:18px">Daily Purchase Report({{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}})</span></strong></u></td>
                                <td width="10%"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th style="width:5%;">Sl</th>
                                <th style="width:15%;">Date</th>
                                <th style="width:5%;">Purchase No</th>
                                <th style="width:10%;">Brand Name</th>
                                <th style="width:10%;">Product Name</th>
                                <th style="width:5%;">Qty</th>
                                <th style="width:5%;">Unit Price</th>
                                <th style="width:5%;">Total Price</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_sum = '0';
                            @endphp
                            @foreach($allData as $key => $purchase)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>{{$purchase['brand']['name']}}</td>
                                <td>{{$purchase['product']['name']}}</td>
                                
                                <td>
                                    {{$purchase->buying_qty}}
                                    {{$purchase['product']['unit']['name']}}
                                </td>
                                <td>{{$purchase->unit_price}}</td>
                                <td>{{$purchase->buying_price}}</td>
                            @php
                                $total_sum+=$purchase->buying_price;

                            @endphp
                            </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align: right;" colspan="7"><strong>Grand Total=</strong></td>
                                    <td >{{$total_sum}}/-Tk</td>
                                </tr>
                        </tbody>
                    </table>
                    @php
                    $date = new DateTime('now', new DateTimezone('Asia/dhaka'));
                    @endphp
                <i>Printing time : {{$date->format('F j,Y,g:i a')}}</i>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- <hr style="margin-bottom: 0px; margin-top: 20px;"> -->
                    <table border="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="width:40%">
                                    <!-- <p style="text-align: center; margin-left: 20px;">Customer Signature</p> -->
                                </td>

                                <td style="width:20%"></td>
                                <td style="width:40%; text-align: center;">
                                    <p style="text-align: center; border-bottom:1px solid #000;">Owner Signature</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
@stop