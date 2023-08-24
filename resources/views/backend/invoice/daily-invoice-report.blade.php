@extends('backend.layouts.master')
@section('main-content')
<!-- page content -->
  <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Select Criteria</h3>
					 <!-- this row will not appear when printing -->  	
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <section class="content">
                      <div class="card">
                        <div class="card-body">
                        <form action="{{route('invoice.daily.report.pdf')}}" method="GET" target="_blank" id="myForm">
                            <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="">Start Date</label>
                              <input type="date" id="start_date" name='start_date' class="input-group form-control">
                            </div> 
                            <div class="form-group col-md-4">
                              <label for="">End Date</label>
                              <input type="date" id="end_date" name='end_date' class="input-group form-control">
                            </div> 
                            <div class="form-group col-md-2" style="padding-top: 35px;">
                            <button type="submit" class="btn btn-primary btn-sm  form-contorl" ><i class="fa fa-eye"></i> Search</button>
                            </div>
                          </div>
                        </form>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<!-- /page content -->

@endsection