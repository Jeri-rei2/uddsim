@extends('layouts.main')
@section('title', 'Master Donor')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Pedonor Detail</h4>
    <!-- <div class="py-3">
        <a href="{{route('barang.create')}}" class="btn btn-primary float-right">Tambah Baru</a>
    </div> -->
</div>

    <div class="row">
       <div class="card mb-4">
                    <h5 class="card-header">Details Data</h5>
                   
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                
                        <img src="{{ asset('storage/captures/' . $poto) }}}" alt="Foto" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                        <p>
                            <div class="mb-3">{!! DNS1D::getBarcodeHTML('T-250000', 'C128') !!}
                                <p id="nodonor"></p>
                            </div>
                        </p>
                          <p class="text-muted mb-0">METODE PENGAMBILAN 
                            </BR>
                            <span class="badge bg-info" id="metode"> </span>
                          </p>
                          <p class="text-muted mb-0">GOLONGAN DARAH 
                            </BR>
                            <span class="badge bg-warning" id=""> </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Donor</label>
                            {{$donor->nodonor}}
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Tgl Lahir</label>
                          
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Alamat</label>
                            <p class="form-control" type="textarea" id="alamat">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NIK KTP</label>
                            <p  class="form-control" id="nonik">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">NO SIM</label>
                            <div class="input-group input-group-merge" >
                              <p  id="nosim" class="form-control">
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Jenis Kelamin</label>
                            <p class="form-control" id="jk" >
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Telephone</label>
                            <p class="form-control"id="tlp">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Donor Ke</label>
                            <p class="form-control" id="donorke">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country"> Wilayah</label>
                            <p class="form-control" id="nmwil">
                           
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="language" class="form-label"></label>
                          
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label"></label>
                           
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="currency" class="form-label"></label>
                           
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
    </div>
    
<!-- Modal detail pedonor -->
<!-- <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
                <div class="card mb-4">
                    <h5 class="card-header">Details Data</h5>
                   
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{asset('sneat//assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                        <p>
                            <div class="mb-3">{!! DNS1D::getBarcodeHTML('T-250000', 'C128') !!}
                                <p id="nodonor"></p>
                            </div>
                        </p>
                          <p class="text-muted mb-0">METODE PENGAMBILAN 
                            </BR>
                            <span class="badge bg-info" id="metode"> </span>
                          </p>
                          <p class="text-muted mb-0">GOLONGAN DARAH 
                            </BR>
                            <span class="badge bg-warning" id=""> </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Donor</label>
                            <P class="form-control" id="namadonor"  autofocus="" disabled></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Tgl Lahir</label>
                            <p class="form-control" id="tgllahir" disabled></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Alamat</label>
                            <p class="form-control" type="text" id="alamat">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NIK KTP</label>
                            <p  class="form-control" id="nonik">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">NO SIM</label>
                            <div class="input-group input-group-merge" >
                              <p  id="nosim" class="form-control">
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Jenis Kelamin</label>
                            <p class="form-control" id="jk" >
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Telephone</label>
                            <p class="form-control"id="tlp">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Donor Ke</label>
                            <p class="form-control" id="donorke">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country"> Wilayah</label>
                            <p class="form-control" id="nmwil">
                           
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="language" class="form-label"></label>
                          
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label"></label>
                           
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="currency" class="form-label"></label>
                           
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                  
                  </div>
            </div>
           
        </div>
    </div>
</div> -->



@endsection