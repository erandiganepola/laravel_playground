<!DOCTYPE html>
<?php
$user = \Illuminate\Support\Facades\Auth::user();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DoE | Web Portal</title>
    <link rel="shortcut" href="favicon.ico"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    <!-- jQuery 2.1.4 Moved to the top to load without an error-->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>DoE</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>DoE</b> Portal</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('dist/img/logo.png')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{$user->username}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('dist/img/logo.png')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{$user->username}}
                                    <small>DoE Web Portal</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('getLogout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('dist/img/logo.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>DoE Web</p>
                </div>
            </div>

            <!-- search form -->
            <form action="{{url('search')}}" method="get" class="sidebar-form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="indexNumber" class="form-control" placeholder="Search...">

                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i
                                    class="fa fa-search"></i>
                        </button>
                      </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li @if(strcmp(Request::url(),route("root"))==0) class="active" @endif>
                    <a href="{{url('/')}}">
                        <i class="fa fa-dashboard"></i> <span>Overview</span>
                    </a>
                </li>
                @can('view','App\Examination')
                    <li @if(str_contains(Request::url(),"examinations")) class="active" @endif>
                        <a href="{{route("examinations")}}">
                            <i class="fa fa-book"></i> <span>Examinations</span>
                        </a>
                    </li>
                @endcan

                @if($user->isStudent())
                    <li @if(str_contains(Request::url(),"student")) class="active" @endif>
                        <a href="{{route("student")}}">
                            <i class="fa fa-user"></i> <span>My Examinations</span>
                        </a>
                    </li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page_header')
                <small>@yield('sub_header')</small>
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">
        @yield('content')
        <!-- Default box -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!--  ============================================== -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <a href="http://areyouready.uom.lk">Are You Ready? 2015</a>.</strong> All rights
        reserved.
    </footer>
</div><!-- ./wrapper -->

</body>

<!-- Bootstrap 3.3.5 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

</html>
