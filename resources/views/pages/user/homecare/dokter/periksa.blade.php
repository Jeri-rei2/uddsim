@extends('backend.adm')


@section('content')
<div class="main-content-inner">



<div class="sales-report-area mt-5 mb-5">
                        <label>DOKTER UMUM</label>
                        <div class="row">
                            <div class="col-md-4">
                                    <a href="{{ route('transaksi') }}">
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


                    

@endsection