@extends('backend.adm')


@section('content')
            
<div class="page-body" id="main-content">
          <div class="container-xl d-relative">
            <div class="row row-cards">
    <div class="space-y">
                    <div class="center-sm-only">
                <a href="{{ route('jadwal') }}" class="btn btn-lime mb-3 d-inline-block"><i class="fa fa-arrow-alt-circle-left mr-2"></i>
                 Kembali ke Jadwal Dokter</a>
            </div>
            <div class="alert alert-danger"><h2>Jadwal Dokter Anak</h2></div>
                            <div class="card">
                    <div class="row g-0">
                        <div class="col-auto">
                            <div class="card-body">
                                <img src="./backend/assets/images/poli/ANA/anak2.png" alt="" 
                                   class="img-responsive pt-0" style="width: 130px; height: auto;">
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body ps-0">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0"><a href="#">dr. Holly Setiawati Sp.A.</a></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="list-inline list-inline-dots mb-0 text-muted d-sm-block">
                                            <div class="list-inline-item">
                                                <h4 class="mb-0 text-danger">Poli Spesialis Anak</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mt-1">
                                            <a href="#" class="badge bg-blue border fw-normal pt-1">
                                                RABU  - 13:00:00-15:00:00 <br/><br/>
                                                JUMAT - 13:00:00-15:00:00
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="card">
                    <div class="row g-0">
                        <div class="col-auto">
                            <div class="card-body">
                                <img src="./backend/assets/images/poli/ANA/anak1.png"
                                alt="" class="img-responsive pt-0" style="width: 180px; height: auto;">
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body ps-0">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-0"><a href="#">dr. Ahmad Assegaf Sp.A.</a></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="list-inline list-inline-dots mb-0 text-muted d-sm-block">
                                            <div class="list-inline-item">
                                                <h4 class="mb-0 text-danger">Poli Spesialis Anak</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mt-1">
                                            <a href="#" class="badge bg-blue border fw-normal pt-1">
                                                SENIN  - 10:00:00-12:00:00 <br/><br/>
                                                SELASA - 13:00:00-15:00:00 <br/><br/>
                                                KAMIS  - 13:00:00-15:00:00
                                            
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                         
                          
                      
                          
                        </div>
</div>

    </div>
        </div>



@endsection