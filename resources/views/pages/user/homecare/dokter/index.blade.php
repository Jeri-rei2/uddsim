@extends('backend.adm')


@section('content')
<div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                        <a href="{{ route('konsul') }}">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-user-md"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Konsultasi Dokter</h4>
                                        <!-- <p>24 H</p> -->
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
                        <a href="{{ route('periksa') }}">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Periksa </h4>
                                        <!-- <p>24 H</p> -->
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <!-- <h2>$ 4567809,987</h2>
                                        <span>- 45.87</span> -->
                                    </div>
                                </div>
                        </a>
                            </div>
                        </div>
                       




                    </div>
                </div>
                <!-- sales report area end -->







@endsection