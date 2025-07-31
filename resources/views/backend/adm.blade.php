<!doctype html>
<html class="no-js" lang="en">

<head>

@stack('custom-css')

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard - @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('backend/dash/assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dash/assets/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('backend/dash/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
 
 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="{{asset('sneat/assets/img/favicon/favicon.ico')}}" />

 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link
   href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
   rel="stylesheet"
 />

 <!-- SELECT2 -->
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css"> --}}
 <!-- Icons. Uncomment required icon fonts -->
 <link rel="stylesheet" href="{{asset('sneat/assets/vendor/fonts/boxicons.css')}}" />

 <!-- Core CSS -->
 <link rel="stylesheet" href="{{asset('sneat/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
 <link rel="stylesheet" href="{{asset('sneat/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
 <link rel="stylesheet" href="{{asset('sneat/assets/css/demo.css')}}" />

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

 <link rel="stylesheet" href="{{asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

 <!-- Page CSS -->

 <!-- Helpers -->
 <script src="{{asset('sneat/assets/vendor/js/helpers.js')}}"></script>

 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
 <script src="{{asset('sneat/assets/js/config.js')}}"></script>


</head>

<body>
 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    @include('sweetalert::alert')
    <!-- Layout wrapper -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">

      <div class="sidebar-menu">
         @include('backend.sidebar')
      </div>

        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
               @include('backend.navbar')
            </div>
            <!-- header area end -->
             <!-- page title area start -->
             <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                        @guest
                          @if (Route::has('login'))
                          @endif
                          @if (Route::has('register'))
                          @endif
                                      @else
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                              <div class="avatar avatar-online">
                                  <img src="{{asset('profile-picture')}}/{{auth()->user()->picture}}" alt class="w-px-40 rounded-circle" />
                              </div>
                          </a>
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                         
                            @if(Auth::user()->type === "admin")
                            Admin
                            @elseif(Auth::user()->type === "pimpinan")
                            Dokter
                            @else
                            User
                            @endif
                      
                                @endguest
                            <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('profile.index')}}">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                @yield('content')
            </div>
            @yield('scripts')


        </div>



    </div>












   <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="{{asset('backend/dash/assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{asset('backend/dash/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/jquery.slicknav.min.js')}}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{asset('backend/dash/assets/js/line-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{asset('backend/dash/assets/js/pie-chart.js')}}"></script>
    <!-- others plugins -->
    <script src="{{asset('backend/dash/assets/js/plugins.js')}}"></script>
    <script src="{{asset('backend/dash/assets/js/scripts.js')}}"></script>


    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('sneat/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('sneat/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('sneat/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('sneat/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- SELECT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Vendors JS -->
    <script src="{{asset('sneat/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('sneat/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('sneat/assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @stack('custom-scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script> --}}

    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

</body>

</html>
