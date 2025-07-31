@extends('backend.adm')


@section('content')

       <!-- page title area end -->
       <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <label>DOKTER SPESIALIS </label>
                    <div class="row">
                        <div class="col-md-4">
                          
                            <div class="single-report mb-xs-20">
                            <a href="">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="s-report-title d-flex justify-content-between">
                                     <img src="./backend/assets/images/poli/OBG/obg.png" alt="" 
                                         class="img-responsive" style="width: 69px; height: 68px;  float: left;">
                                        <h4 class="header-title mb-0">Dr.Ketut Edi S, Sp.OG</h4>
                                        <br/><p>Selasa, Jumat</p>
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
                            <div class="single-report mb-xs-20">
                              <a href="#">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                   <img src="./backend/assets/images/poli/INT/int.png" alt="" 
                                         class="img-responsive" style="width: 69px; height: 68px;  float: left;">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Dr.Atina Irana W.P Sp.PD </h4>
                                        <br/><p>Senin, Selasa, Rabu</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        
                                    </div>
                                </div>
                              </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                <img src="./backend/assets/images/poli/BED/bed.png" alt="" 
                                         class="img-responsive" style="width: 69px; height: 68px;  float: left;">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Dr.Boyke Damanik Sp.B</h4>
                                        <br/><p>Senin, Rabu, Kamis</p>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                     <div class="sales-report-area mt-5 mb-5">
                        <div class="row">
                                <div class="col-md-4">
                                <a href="">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <img src="./backend/assets/images/poli/ORT/ot.png" alt="" 
                                         class="img-responsive" style="width: 65px; height: 65px;  float: left;">
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Totot M., Sp.OT</h4>
                                                <br/><p>Selasa</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                <div class="single-report mb-xs-20">
                                <a href="{{ route('layanan') }}">
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <img src="./backend/assets/images/poli/SYR/syr.png" alt="" 
                                         class="img-responsive" style="width: 65px; height: 65px;  float: left;">
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Dr.Affan Nadzar B, Sp.N </h4>
                                            <br/><p>Senin, Rabu, Jumat</p>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="single-report mb-xs-20">
                                <a href="{{ route('layanan') }}">
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <img src="./backend/assets/images/poli/ANA/anak1.png" alt="" 
                                         class="img-responsive" style="width: 85px; height: 75px;  float: left;">
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Dr.Ahmad Assegaf  Sp.A </h4>
                                            <br/><p>Senin, Selasa, Kamis</p>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sales-report-area mt-5 mb-5">
                        <div class="row">
                                <div class="col-md-4">
                                <a href="">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <img src="./backend/assets/images/poli/ANA/anak2.png" alt="" 
                                         class="img-responsive" style="width: 75px; height: 75px;  float: left;">
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Holly Setiawati Sp.A</h4>
                                                <br/><p>Rabu, Jumat </p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                <div class="single-report mb-xs-20">
                                <a href="{{ route('layanan') }}">
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Dr.Anggela Betty Sp.JP </h4>
                                            <br/><p>Rabu, Jumat</p>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="single-report mb-xs-20">
                                <a href="{{ route('layanan') }}">
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">Dr.Achmad Husin  Sp.OG </h4>
                                            <br/><p> Kamis</p>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="sales-report-area mt-5 mb-5">
                        <label>DOKTER UMUM</label>
                        <div class="row">
                            <div class="col-md-4">
                                    <a href="">
                                        <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-user-md"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Dr.Ferie Kristianto</h4>
                                                    <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <!-- <h2>$ 4567809,987</h2>
                                                    <span>- 45.87</span> -->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                            </div>
                            <div class="col-md-4">
                                <a href="">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Jasinda</h4>
                                                <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                <a href="">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Taufiq</h4>
                                                <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                        </div>
                    </div>




                </div>
        </div>
               
 




@endsection