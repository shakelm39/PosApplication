<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ajax token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- favicon icon  -->
	  <link rel="icon" href="{{asset('public/backend')}}/images/favicon.ico" type="image/ico" />

    <title>SPK Electronics!</title>

    <!-- Bootstrap -->
    <link href="{{asset('public/backend')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public/backend')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('public/backend')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('public/backend')}}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- ajax cdn  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- bootstrap-progressbar -->
    <link href="{{asset('public/backend')}}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('public/backend')}}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- Datatables -->
    <link href="{{asset('public/backend')}}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/backend')}}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <!-- Datatables end-->
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('public/backend')}}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- tostr  -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- sweet alert 2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Theme Style -->
    <link href="{{asset('public/backend')}}/build/css/custom.min.css" rel="stylesheet">

    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>SPK Electronics!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{(!empty(Auth::user()->image))?url('public/upload/user_images/'.Auth::user()->image):url('public/upload/no_image.jpg')}}" alt="Profile Pic" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span><span class="text-uppercase text-bold">( {{(Auth::user()->usertype)}} )</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('backend.layouts.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{(!empty(Auth::user()->image))?url('public/upload/user_images/'.Auth::user()->image):url('public/upload/no_image.jpg')}}" alt="User profile picture" >{{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="{{route('profiles.view')}}"> Profile</a>
                      <a class="dropdown-item"  href="{{route('profiles.password.view')}}">
                        <!-- <span class="badge bg-red pull-right">50%</span> -->
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('main-content')
          <!-- /top tiles --> 
          <br />
      <!-- Success message function -->
            @if(session()->has('success'))
                <script>
                  $(function(){
                    $.notify("{{session()->get('success')}}",{globalPosition:'top right',className:'success'});
                  });
                </script>
            @endif
            <!-- error message function -->
            @if(session()->has('error'))
              <script>
                $(function(){
                  $.notify("{{session()->get('error')}}",{globalPosition:'top right',className:'error'});
                });
              </script>
            @endif
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('backend.layouts.footer')