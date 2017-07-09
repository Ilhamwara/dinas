<!DOCTYPE html>
<html>
<head>
        <!-- 
         * @Package: Complete Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 2.2
         * This file is part of Complete Admin Theme.
     -->
     <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
     <meta charset="utf-8" />
     <title>@yield('head_title') | E Perjadin</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
     <meta content="" name="description" />
     <meta content="" name="author" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/')}}/apple-icon-57x57.png">
     <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/')}}/apple-icon-60x60.png">
     <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/')}}/apple-icon-72x72.png">
     <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/')}}/apple-icon-76x76.png">
     <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/')}}/apple-icon-114x114.png">
     <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/')}}/apple-icon-120x120.png">
     <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/')}}/apple-icon-144x144.png">
     <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/')}}/apple-icon-152x152.png">
     <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/')}}/apple-icon-180x180.png">
     <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/')}}/android-icon-192x192.png">
     <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/')}}/favicon-32x32.png">
     <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/')}}/favicon-96x96.png">
     <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/')}}/favicon-16x16.png">
     {{-- <link rel="manifest" href="/manifest.json"> --}}

     <meta name="msapplication-TileColor" content="#ffffff">
     <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
     <meta name="theme-color" content="#ffffff">

     <!-- CORE CSS FRAMEWORK - START -->
     <link href="{{asset('assets')}}/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
     <link href="{{asset('assets')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
     <link href="{{asset('assets')}}/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
     <link href="{{asset('assets')}}/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
     <link href="{{asset('assets')}}/css/animate.min.css" rel="stylesheet" type="text/css"/>
     <link href="{{asset('assets')}}/css/notie.css" rel="stylesheet" type="text/css"/>
     {{-- <link href="{{url('assets')}}/css/datatables.css" rel="stylesheet" type="text/css"/> --}}
     
     <link href="{{asset('assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
     <!-- CORE CSS FRAMEWORK - END -->

     <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START --> 


     <link href="{{asset('assets')}}/plugins/icheck/skins/minimal/minimal.css" rel="stylesheet" type="text/css" media="screen"/>

     <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END --> 


     <!-- CORE CSS TEMPLATE - START -->
     <link href="{{asset('assets')}}/css/style.css" rel="stylesheet" type="text/css"/>
     <link href="{{asset('assets')}}/css/responsive.css" rel="stylesheet" type="text/css"/>
     <!-- CORE CSS TEMPLATE - END -->
     <style type="text/css">
        .form-control[readonly] {
            /*background: #fff;*/
        }
    </style>
    @yield('css')
    
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class=" "><!-- START TOPBAR -->
    <div class='page-topbar '>
        <div class='logo-area'>

        </div>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>		
            <div class='pull-right'>
                <ul class="info-menu right-links list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle">
                            <span>{{Auth::user()->name}} <i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">
                            <li>
                                <a href="{{url('setting')}}">
                                    <i class="fa fa-wrench"></i>
                                    Settings
                                </a>
                            </li>
                            {{-- <li>
                                <a href="#profile">
                                    <i class="fa fa-user"></i>
                                    Profile
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a href="#help">
                                    <i class="fa fa-info"></i>
                                    Help
                                </a>
                            </li> --}}
                            <li class="last">
                                <form method="post" action="{{url('/logout')}}" id="logout">
                                    {{csrf_field()}}
                                    <a href="#" onclick="logout()" style="color: red">
                                        &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>			
            </div>		
        </div>

    </div>
    <!-- END TOPBAR -->
    <!-- START CONTAINER -->
    <div class="page-container row-fluid container-fluid">

        <!-- SIDEBAR - START -->

        <div class="page-sidebar pagescroll">

            <!-- MAIN MENU - START -->
            <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                <!-- USER INFO - START -->
                <div class="profile-info row">

                    <div class="profile-details col-xs-12">

                        <h3>
                            <a href="ui-profile.html">{{Auth::user()->name}}</a>

                            <!-- Available statuses: online, idle, busy, away and offline -->
                            <span class="profile-status online"></span>
                        </h3>

                        <p class="profile-title">{{strtoupper(Auth::user()->type)}}</p>

                    </div>

                </div>
                <!-- USER INFO - END -->

                <?php

                function isMaster()
                {
                    $master = [
                    'pegawai',
                    'referensi',
                    'satker',
                    'pagu',
                    'anak-satker'
                    ];
                    if (in_array(Request::segments()[0], $master)) {
                        return 'open';
                    }
                    return '';
                }

                function isTransaksi()
                {
                    $master = [
                    'surat-tugas',
                    'spd',
                    'kegiatan',
                    'biaya-perjalanan-dinas',
                    'pengeluaran-riil',
                    'rincian-biaya',
                    'nominatif'
                    ];
                    if (in_array(Request::segments()[0], $master)) {
                        return 'open';
                    }
                    return '';
                }

                function activate($route)
                {
                    if (Request::segments()[0] == $route) {
                        return 'active';
                    }
                    return '';
                }
                ?>
                <ul class='wraplist'>	
                    <li class="@if(Route::is('dashboard')) open @endif"> 
                        <a href="{{url('dashboard')}}">
                            <i class="fa fa-home"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="@if(Route::is('monitoring')) open @endif"> 
                        <a href="{{url('monitoring')}}">
                            <i class="fa fa-calendar"></i>
                            <span class="title">Monitoring</span>
                        </a>
                    </li>
                    <li class="{{isTransaksi()}}"> 
                        <a href="javascript:;">
                            <i class="fa fa-wpforms"></i>
                            <span class="title">Transaksi</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            @if(Auth::user()->type == 'admin' OR Auth::user()->type == 'spk')
                            <li>
                                {{-- <a class="" href="{{url('view-print')}}"><i class="fa fa-print"></i>View Print</a> --}}
                                <a class="{{activate('kegiatan')}}" href="{{url('kegiatan')}}"><i class="fa fa-universal-access"></i>Perjalanan Dinas</a>
                            </li>
                            @endif
                            <li>
                                <a class="{{activate('surat-tugas')}}" href="{{url('surat-tugas')}}"><i class="fa fa-envelope-o"></i>Surat Tugas</a>
                            </li>
                            <li>
                                <a class="{{activate('spd')}}" href="{{url('spd')}}"><i class="fa fa-envelope"></i>Surat Perjalanan Dinas</a>
                            </li>
                            @if(Auth::user()->type == 'admin' OR Auth::user()->type == 'spk')
                            {{-- <li>
                                <a class="{{activate('rincian-biaya','biaya-perjalanan-dinas')}}" href="{{url('biaya-perjalanan-dinas')}}"><i class="fa fa-book"></i>Rincian Biaya Perjalanan</a>
                            </li> --}}
                            {{-- <li>

                                <a class="{{activate('pengeluaran-riil')}}" href="{{url('pengeluaran-riil')}}"><i class="fa fa-credit-card"></i>Pengeluaran Riil</a>
                            </li> --}}
                            {{-- <li>
                                <a class="{{activate('nominatif')}}" href="{{url('nominatif')}}"><i class="fa fa-list-alt"></i>Daftar Nominatif</a>

                            </li> --}}
                            @endif
                        </ul>
                    </li>
                    <li class="@if(Route::is('laporan')) open @endif"> 
                        <a href="{{url('laporan')}}">
                            <i class="fa fa-folder-open-o"></i>
                            <span class="title">Laporan Perjalanan</span>
                        </a>
                    </li>
                    
                    @if(Auth::user()->type == 'admin' OR Auth::user()->type == 'spk')
                    <li class="{{isMaster()}}"> 
                        <a href="javascript:;">
                            <i class="fa fa-database"></i>
                            <span class="title">Master</span>
                            <span class="arrow {{isMaster()}}"></span>
                        </a>
                        <ul class="sub-menu" >
                            <li>
                                <a class="{{activate('pegawai')}}" href="{{url('pegawai')}}"><i class="fa fa-group"></i>Data Pegawai</a>
                            </li>
                            {{-- @if(Auth::user()->type == 'admin')
                            <li>
                                <a class="{{activate('referensi')}}" href="{{url('referensi')}}"><i class="fa fa-list-ol"></i>Referensi</a>
                            </li>
                            @endif --}}
                            <li>
                                <a class="{{activate('satker')}}" href="{{url('satker')}}"><i class="fa fa-sitemap"></i>Satker</a>
                            </li>
                            <li>
                                <a class="{{activate('tujuan')}}" href="{{url('tujuan')}}"><i class="fa fa-map-marker"></i>Tujuan Perjalanan</a>
                            </li>
                            <li>
                                <a class="{{activate('tujuan-luar-negeri')}}" href="{{url('tujuan-luar-negeri')}}"><i class="fa fa-map-marker"></i>Tujuan Perjalanan Luar Negeri</a>
                            </li>
                            <li>
                                <a class="{{activate('pagu')}}" href="{{url('pagu')}}"><i class="fa fa-legal"></i>Pagu</a>
                            </li>
                            <li>
                                <a class="{{activate('anak-satker')}}" href="{{url('anak-satker')}}"><i class="fa fa-child"></i>Anak Satker</a>
                            </li>
                        </ul>
                    </li>
                    @endif


                    {{-- Referensi --}}
                    @if(Auth::user()->type == 'admin')
                    <li class=""> 
                        <a href="javascript:;">
                            <i class="fa fa-list"></i>
                            <span class="title">Referensi Dalam Negeri</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li>
                                <a class="" href="{{url('uang-harian')}}"><i class="fa fa-calendar"></i>Uang Harian</a>
                            </li>
                            <li>
                                <a class="" href="{{url('uang-harian-rapat')}}"><i class="fa fa-hand-stop-o"></i>Uang Harian Rapat</a>
                            </li>
                            <li>
                                <a class="" href="{{url('uang-representatif')}}"><i class="fa fa-universal-access"></i>Uang Representatif</a>
                            </li>
                            <li>
                                <a class="" href="{{url('uang-penginapan')}}"><i class="fa fa-building"></i>Uang Penginapan</a>
                            </li>
                            <li>
                                <a class="" href="{{url('uang-taksi')}}"><i class="fa fa-cab"></i>Uang Taksi</a>
                            </li>
                            <li>
                                <a class="" href="{{url('uang-transport')}}"><i class="fa fa-street-view"></i>Uang Transport Sekitar</a>
                            </li>
                        </ul>
                    </li>
                    <li class=""> 
                        <a href="javascript:;">
                            <i class="fa fa-tasks"></i>
                            <span class="title">Referensi Luar Negeri</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="{{url('uang-harian-luar-negeri')}}"><i class="fa fa-calendar"></i>Uang Harian</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(Auth::user()->type == 'admin')
                    <li class=""> 
                        <a href="javascript:;">
                            <i class="fa fa-cog"></i>
                            <span class="title">Pengaturan</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li>
                                <a class="" href="{{url('user')}}"><i class="fa fa-user"></i>&nbsp; Manajemen User</a>
                            </li>
                        </ul>
                    </li>
                    @endif


                </ul>
                

            </div>
            <!-- MAIN MENU - END -->



        </div>
        <!--  SIDEBAR - END -->
        <!-- START CONTENT -->
        <section id="main-content" class=" ">
            <section class="wrapper main-wrapper row" style=''>

                <div class='col-xs-12'>
                    <div class="page-title">

                        <div class="pull-left">
                            <!-- PAGE HEADING TAG - START -->
                            <h1 class="title">@yield('title')</h1><!-- PAGE HEADING TAG - END -->                            
                        </div>

                        <div class="pull-right hidden-xs">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- MAIN CONTENT AREA STARTS -->


                @yield('content')


                <!-- MAIN CONTENT AREA ENDS -->
            </section>
        </section>
        <!-- END CONTENT -->
        <div class="page-chatapi hideit">

            <div class="search-bar">
                <input type="text" placeholder="Search" class="form-control">
            </div>

        </div>


        <div class="chatapi-windows ">




        </div>    
    </div>
    <!-- END CONTAINER -->
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


    <!-- CORE JS FRAMEWORK - START --> 
    <script src="{{asset('assets')}}/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/jquery.easing.min.js" type="text/javascript"></script>  
    <script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/plugins/pace/pace.min.js" type="text/javascript"></script>  
    <script src="{{asset('assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
    <!-- CORE JS FRAMEWORK - END --> 


    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 

    <script src="{{asset('assets')}}/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


    <!-- CORE TEMPLATE JS - START --> 
    <script src="{{asset('assets')}}/js/scripts.js" type="text/javascript"></script> 
    <!-- END CORE TEMPLATE JS - END --> 

    {{-- INPUT MASK --}}
    <script src="{{asset('assets')}}/js/jquery.inputmask.bundle.min.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/notie.min.js" type="text/javascript"></script> 
    <script type="text/javascript">
        function logout(){
            $('#logout').submit();
        }
    </script>
    @yield('js')


</body>
</html>