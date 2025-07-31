@extends('backend.adm')


@section('content')
<div class="page-body" id="main-content">
          <div class="container-xl d-relative">
            <div class="center-sm-only">
            <a href="{{route('home')}}">
                   <button type="button" class="btn btn-primary mb-3">
                    <i class="fa fa-arrow-alt-circle-left mr-2"></i> Kembali ke Daftar Menu 
                                </button></a>
</div>

<div class="row">                
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="{{ route('anak') }}" class="text-decoration-none">
                <div class="card bg-blue text-blue-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/ANA/1.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Anak</h3>
                    </div>
                </div>
            </a>
        </div>
                       
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-red text-red-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/ORT/2.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Orthopedi</h3>
                    </div>
                </div>
            </a>
        </div>
                            <!-- <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-indigo text-indigo-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-indigo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://daftar.rsdeltasurya.com/assets/images/poli/BPT/1.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Bedah Plastik</h3>
                    </div>
                </div>
            </a>
        </div>-->
                            <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-orange text-orange-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/SYR/15.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Syaraf</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-yellow text-yellow-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/BED/5.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Bedah Umum</h3>
                    </div>
                </div>
            </a>
        </div>
                    
                     
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-blue text-blue-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/GIG/7.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Gigi Dan Mulut</h3>
                    </div>
                </div>
            </a>
        </div>
                     
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-red text-red-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/JAN/8.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Jantung</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-indigo text-indigo-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-indigo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/OBG/9.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Kandungan</h3>
                    </div>
                </div>
            </a>
        </div>
                      
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-yellow text-yellow-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/KLT/10.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Kulit &amp; Kelamin</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-azure text-azure-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-azure">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/MAT/11.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Mata</h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-purple text-purple-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/PAR/12.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Paru</h3>
                    </div>
                </div>
            </a>
        </div> -->
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="{{ route('int') }}" class="text-decoration-none">
                <div class="card bg-blue text-blue-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/INT/13.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Penyakit Dalam</h3>
                    </div>
                </div>
            </a>
        </div>
                         
        <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-red text-red-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="./backend/assets/images/poli/RAD/14.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Radiologi</h3>
                    </div>
                </div>
            </a>
        </div>
                    
                            <!-- <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="#" class="text-decoration-none">
                <div class="card bg-orange text-orange-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://daftar.rsdeltasurya.com/assets/images/poli/SAR/1.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Syaraf</h3>
                    </div>
                </div>
            </a>
        </div> -->
                            <!-- <div class="col-lg-3 col-md-4 col-6 mb-2">
            <a href="https://daftar.rsdeltasurya.com/jadwal_dokter_detail/THT" class="text-decoration-none">
                <div class="card bg-yellow text-yellow-fg h-100">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://daftar.rsdeltasurya.com/assets/images/poli/THT/1.png" alt="" class="mr-2" style="width: 100px; height: auto;">
                        <h3 class="mb-0 mt-2 label-card-pelayanan">Tht</h3>
                    </div>
                </div>
            </a>
        </div> -->
            </div>

      </div>
        </div>

@endsection