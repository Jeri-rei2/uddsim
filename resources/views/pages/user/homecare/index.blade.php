@extends('backend.adm')


@section('content')

<div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">Home Care</h1> <div class="breadcrumb-item"> Vers 1.0 </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <i class="nav-icon fas fa-tachometer-alt"></i> <a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>
              <!-- /.content-header -->
                <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                        <a href="">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-laptop"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Reservasi</h4>
                                        <p>24 H</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <!-- <h2>$ 4567809,987</h2>
                                        <span>- 45.87</span> -->
                                    </div>
                                </div>
                        </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report mb-xs-520">
                              <a href="{{ route('layanan') }}">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-medkit"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Dokter</h4>
                                        <p>24 H</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        
                                    </div>
                                </div>
                              </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <a href="{{ route('jadwal') }}">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-book"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Jadwal Dokter</h4>
                                        <p>24 H</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        
                                    </div>
                                </div>
                            </div>
                          </a>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->
    
       
             
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>



@endsection