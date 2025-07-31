@extends('layouts.main')
@section('title', 'Master Donor')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Pedonor Baru</h4>
    <!-- <div class="py-3">
        <a href="{{route('barang.create')}}" class="btn btn-primary float-right">Tambah Baru</a>
    </div> -->
</div>

   <!-- Way 1: Display All Error Messages -->

   @if ($errors->any())

<div class="alert alert-danger">
    <strong>Whoops!</strong> Cek pada inputan anda<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>

</div>

@endif

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
            <div class="card-body">
                    
                      <p class="demo-inline-spacing">
                        <a
                          class="btn btn-warning me-1"
                          data-bs-toggle="collapse"
                          href="#collapseExample"
                          role="button"
                          aria-expanded="false"
                          aria-controls="collapseExample">
                          <i class='bx bx-low-vision'> </i>  Lihat Data
                        </a> 
                        <a href="{{route('admin.home')}}" class="btn btn-secondary"> 
                             <i class='bx bx-arrow-back' ></i> Kembali</a>
                           
                     <button type=button class="btn btn-info" id="snap">
                         <i class='bx bx-camera'> </i> Ambil Foto</button>
                         <video id="video" width="640" height="480" autoplay></video>
                         <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
                        <!-- <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseExample"
                          aria-expanded="false"
                          aria-controls="collapseExample"
                        >
                          Button with data-bs-target
                        </button> -->
                      </p>
 <div class="collapse" id="collapseExample">
      <table id="pagin" class="display table table-bordered py-3 table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Cabang</th>
                        <th>No Donor</th>
                        <th>Nama Pedonor</th>
                        <th>TGL Lahir</th>
                        <th>Alamat</th>
                        <th>NIK KTP</th>
                        <th>NO SIM </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($donor as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->kdcab}}</td>
                        <td>{!! DNS1D::getBarcodeHTML($item->kdcab . $item->nodonor, 'C128',1,35) !!}
                            <center> {{$item->nodonor}}</center>
                        </td>
                        <td>{{$item->namadonor}}</td>
                        <td>{{$item->tgllahir}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->noktp}}</td>
                        <td>{{$item->nosim}}</td>
                        <td class="d-flex justify-content-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="javascript:void(0)" data-url="{{route('mdonor.show', $item->id)}}" class="dropdown-item" id="show-detail"><i class='bx bx-search-alt'></i> Detail</a>
                                    <a class="dropdown-item" href="{{route('mdonor.edit', $item->id)}}" ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item formdaftar" id="barcode" href="{{route('formdaftar', $item->id)}}" target="_blank"><i class='bx bx-book'></i> Cetak Form</a>
                                    <a class="dropdown-item barcode" id="barcode" href="{{route('barcodedonor',$item->id)}}" target="_blank"><i class='bx bx-barcode'></i> Cetak Barcode</a>
                                    <a class="dropdown-item print" id="print" href="{{route('cetakdonor',$item->id)}}" target="_blank"><i class='bx bxs-printer'></i> Cetak Kartu</a>
                                    
                                    <form method="POST" action="{{ route('mdonor.destroy',$item->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn dropdown-item   deleteUser" data-toggle="tooltip" title='Delete'><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                       
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>#</th>
                        <th>Kode Cabang</th>
                        <th>No Donor</th>
                        <th>Nama Pedonor</th>
                        <th>TGL Lahir</th>
                        <th>Alamat</th>
                        <th>NIK KTP</th>
                        <th>NO SIM </th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            {!! $filter->links() !!}
                      </div>
                    </div>

                <form  name="myForm" action="{{route('mdonor.store')}}" method="post" enctype="multipart/form-data">
                        <div class="mt-4 mb-2 text-end">
                        
                        </div>
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="defaultFormControlInput" class="form-label">No Area</label>
                                @foreach ($items as $cabang)
                                <input type="hidden" value="{{ $cabang->kdcab }}" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" />
                                <input type="text" disabled value="{{ $cabang->kdcab }}" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                 @endforeach
                                
                                @error('kdcab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">No.Donor</label>
                                <input type="text" disabled value="{{ $nodonor }}" class="form-control @error('nodonor') is-invalid @enderror" name="nodonor" id="nodonor" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" value="{{ $nodonor }}" class="form-control @error('nodonor') is-invalid @enderror" name="nodonor" id="nodonor"/>
                               
                                @error('nmbrg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                            <label for="defaultFormControlInput" class="form-label">No.Pendaftaran</label>
                            <input type="text" readonly value="{{ $noaftp }}" class="form-control @error('noaftp') is-invalid @enderror" name="noaftp" id="noaftp" aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" value="{{ $noaftp }}" class="form-control @error('noaftp') is-invalid @enderror" name="noaftp" id="noaftp"/>
                                @error('noaftp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="defaultFormControlInput" class="form-label">Nama Pedonor</label>
                                <input type="text" value="{{ old('namadonor') }}" class="form-control @error('namadonor') is-invalid @enderror" name="namadonor" id="namadonor" placeholder="Nama lengkap"  />
                                @error('namadonor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" />
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="stok" class="form-label">Kode Pos</label>
                                <input type="number" value="{{ old('kodepos') }}" class="form-control @error('kodepos') is-invalid @enderror" name="kodepos" id="kodepos" placeholder="Kode Pos"/>
                                <input type="hidden" name="stoktambah" id="stoktambah" value="-">
                                @error('kodepos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                             <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">Jenis Kelamin</label>
                               <p>
                                <input type="radio" id="jk" name="jk" value="PRIA" >
                                PRIA  &nbsp;
                                <input type="radio" id="jk" name="jk" value="WANITA" >
                                WANITA</p>
                             
                                @error('jk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="defaultFormControlInput" class="form-label">Donor Ke</label>
                                <input type="number" id="donorke" class="form-control @error('alamat') is-invalid @enderror" name="donorke" value="" placeholder="Donor Ke">
                              
                                @error('donorke')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-6">
                            <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">Kebangsaan</label>
                                <div class="input-group">
                                @foreach ($kenegaraan as $negara)
                               
                                @endforeach
                                <select name="kdneg" id="kdneg" class="form-control form-select @error('kdneg') is-invalid @enderror">
                                    
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    @foreach ($kenegaraan as $negara)
                                  
                                    <option value="{{$negara->kdnegr}}">{{$negara->nmnegr}}</option>
                                    @endforeach
                                </select>
                                @error('kdneg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                                <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                                    <div class="input-group">
                                    <input type="date" value="{{ old('tgllahir') }}" class="form-control @error('tgllahir') is-invalid @enderror" name="tgllahir" id="tgllahir" {{-- placeholder="tgllahir" --}} aria-describedby="defaultFormControlHelp" />
                                    
                                    @error('tgllahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                               
                            </div>
                              <div class="col-md-2">
                                    <label for="defaultFormControlInput" class="form-label">Usia</label>
                                    <div class="input-group">
                                    <input type="text" readonly  class="form-control @error('usia') is-invalid @enderror" name="usia" id="usia" {{-- placeholder="usia" --}} aria-describedby="defaultFormControlHelp" />
                                    
                                    @error('usia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                              </div>
                              
                        </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Kelurahan</label>
                                <div class="input-group">
                                 <input type="text" value="" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan" placeholder="Kelurahan"/>
                                @error('kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Kecamatan</label>
                              
                                <div class="input-group">
                                 <input type="text" value="" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" placeholder="Kecamatan" />
                                @error('kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Wilayah</label>
                                <div class="input-group">
                                 <input type="text" value="" class="form-control @error('nmwil') is-invalid @enderror" name="nmwil" id="nmwil" placeholder="Kab / Kota"/>
                                @error('nmwil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                             <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Pekerjaan</label>
                                <div class="input-group">
                                 <select name="nmpkrj" id="nmpkrj" class="form-control form-select @error('nmpkrj') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    @foreach ($pekerjaan as $jns)
                                    <option value="{{$jns->kdpkrj}}">{{$jns->nmpkrj}}</option>
                                    @endforeach
                                </select>
                                @error('nmpkrj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                             <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Agama</label>
                                <div class="input-group">
                                 <select name="agama" id="agama" class="form-control form-select @error('agama') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Lain-lain">Lain - Lain</option>
                                  
                                </select>
                                @error('agama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">NO Telephone</label>
                                <div class="input-group">
                                 <input type="number" value="" class="form-control @error('tlp') is-invalid @enderror" name="tlp" id="tlp" placeholder="Nomor Telphone"/>
                              
                                @error('tlp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">NIK KTP</label>
                                <div class="input-group">
                                 <input type="number" value="" class="form-control @error('noktp') is-invalid @enderror" name="noktp" id="noktp" placeholder="Nik KTP" />
                              
                                @error('noktp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">NO SIM</label>
                                <div class="input-group">
                                 <input type="number" value="" class="form-control @error('nosim') is-invalid @enderror" name="nosim" id="nosim" placeholder="NO SIM"/>
                              
                                @error('nosim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="defaultFormControlInput" class="form-label">Tanggal Daftar </label>
                                    <div class="input-group">
                                    <input type="date" value="<?php echo date('Y-m-d');?>" class="form-control @error('tgldaftar') is-invalid @enderror" name="tgldaftar" id="tgldaftar" {{-- placeholder="TGL DAFTAR" --}} aria-describedby="defaultFormControlHelp" />
                                    
                                    @error('tgldaftar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="input-group">
                                    <img src="{{ asset('storage/' ) }}" />
                                    </div>
                             </div>
                             <div class="col-md-6">
                             <canvas id="canvas" style="display:none;"></canvas>
                            
                             <form method="POST" action="{{ route('upload-photo') }}">
                                    @csrf
                                   
                                    <input type="hidden" name="image" id="imageData">
                             <button type="submit">Save Image</button>
                                </form>
                              </div>

                           &nbsp;
                        <hr width="50%" color="green"  style="border: 1px solid red;"/>

                        <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Metode Pengambilan</label>
                                <div class="input-group">
                                    
                                 <select name="mtdpeng" id="mtdpeng" class="form-control form-select @error('mtdpeng') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    <option value="Konvensional">Konvensional</option>
                                    <option value="Pheresis">Pheresis</option>
                                </select>
                                @error('mtdpeng')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Tujuan Periksa</label>
                                <div class="input-group">   
                                 <select name="loket" id="loket" class="form-control form-select @error('loket') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    @foreach ($loket as $l)
                                    <option value="{{$l->id}}">{{$l->nama_loket}}</option>
                                    @endforeach
                                </select>
                                @error('loket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="mt-4 mb-2 text-end">
                            <button type="submit" class="btn btn-primary"><i class='bx bxs-save' ></i> Simpan</button> 
                                </div>
                        </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail pedonor -->
<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p id="nodn"></p>
                            </div>
                        </p>
                          <p class="text-muted mb-0">METODE PENGAMBILAN 
                            </BR>
                            <span class="badge bg-info" id="mtd"> </span>
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
                            <P class="form-control" id="nmadn"  autofocus="" disabled></p>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Tgl Lahir</label>
                            <p class="form-control" id="tgllh" disabled></p>
                          </div>
                          <div class="mb-5 col-md-9">
                            <label for="email" class="form-label">Alamat</label>
                            <p class="form-control" type="text" id="alm" style="height: 89px;">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">NIK KTP</label>
                            <p  class="form-control" id="nonik">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">NO SIM</label>
                            <div class="input-group input-group-merge" >
                              <p  id="nosi" class="form-control">
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Jenis Kelamin</label>
                            <p class="form-control" id="jkl" >
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Telephone</label>
                            <p class="form-control"id="tlpn">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Donor Ke</label>
                            <p class="form-control" id="dnrke">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country"> Wilayah</label>
                            <p class="form-control" id="nmwill">
                           
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
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->

<script>
    
//     navigator.mediaDevices.getUserMedia({ video: true })
// .then(function(stream) {
//     document.getElementById('video').srcObject = stream;
// })
// .catch(function(err) {
//     console.log("Something went wrong: " + err);
// });

// document.getElementById('snap').addEventListener('click', function() {
//     var canvas = document.getElementById('canvas');
//     var video = document.getElementById('video');
//     canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
//     var imageData = canvas.toDataURL('image/png');
//     document.getElementById('imageData').value = imageData;
// });
//ALERT
    @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    $("#tgllahir").on('change', function(){
            // let d = $(this).val()
            
            // let dobj = new Date(d)
            var day = document.getElementById("tgllahir").value;
            var DOB = new Date(day);
            var today = new Date();
            var Age = today.getTime() - DOB.getTime();
            Age = Math.floor(Age/(1000 * 60 * 60 * 24* 365.25));
            document.getElementById("usia").value = Age; 
            
            $("#usia").html(today.toLocaleString())
            if (Age < 17) {
                console.log("usia belum 17 th.");
                swal({
                    title: "Warning !",
                    text: "Anda Belum Berusia 17 TH Belum Bisa Menjadi Pedonor Sukarela",
                    icon: "warning",
                    button: true
                    });
            }else if(Age > 60 ){
                console.log("usia lebih 60 th.");
                swal({
                    title: "Warning !",
                    text: "Umur Anda Lebih 60 th Belum Bisa Menjadi Pedonor Sukarela",
                    icon: "warning",
                    button: true
                    });
           }
});


$(document).ready(function () {
/* When click show detail pedonor */
$('body').on('click', '#show-detail', function () {
    var userURL = $(this).data('url');
    $.get(userURL, function (data) {
        console.log(userURL);
        $('#userShowModal').modal('show');
        $('#nodn').text(data.nodonor);
        $('#nmadn').text(data.namadonor);
        $('#tgllh').text(data.tgllahir);
        $('#mtd').text(data.mtdpeng);
        $('#alm').text(data.alamat);
        $('#nonik').text(data.noktp);
        $('#nosi').text(data.nosim);
        $('#jkl').text(data.jk);
        $('#tlpn').text(data.tlp);
        $('#dnrke').text(data.donorke);
        $('#nmwill').text(data.nmwil);

    })
});   });

$(document).on('click','.deleteUser',function() {
        var url = $(this).attr('rel');
        if(confirm("Yakin arep hapus ?")){
           window.location.href = url
        }
        else{
            return false;
        }
    })
$(document).ready(function(){
$('.print').printPage();
});

$(document).ready(function(){
$('.barcode').printPage();
});

$(document).ready(function() {
    $('#pagin').dataTable( {
      
    } );
   
} );

// $('body').on('click', '#show-edit', function () {
//     var userURL = $(this).data('url');
//     let getid = $(this).data('id');
//         $.ajax({
//             url: userURL ,
//             type: "GET",
//             cache: false,
//             dataType: 'json',
//             success:function(data){
//                 $('#getid').val(data.id);
//                 $('#namad').val(data.namadonor);
//                 $('#nod').val(data.nodonor);
//                 $('#almt').val(data.alamat);
//                 $('#kdps').val(data.kodepos);
//                 $('#jnsk').val(data.jk);
//                 $('#dnrk').val(data.donorke);
//                 $('#usi').val(data.usia);
//                 $('#kel').val(data.kelurahan);
//                 $('#kec').val(data.kecamatan);
//                 $('#nwil').val(data.nmwil);
//                 $('#tl').val(data.tlp);
//                 $('#nktp').val(data.noktp);
//                 $('#nsim').val(data.nosim);
//                 $('#mtpeng').val(data.mtdpeng);

//                 $('#modalScrollable').modal('show');

//             }
//     });
// });


    // let post_id = $(this).data('id');
//fetch detail post with ajax
// $.get(userURL, function (data) {
      
//         //open modal
//         $('#modaledit').modal('show');
//         $('#nodonor').val(response.data.id);
//         $('#namadonor').text(data.namadonor);
//         $('#tgllahir').text(data.tgllahir);
//         $('#metode').text(data.mtdpeng);
//         $('#alamat').text(data.alamat);
//         $('#nonik').text(data.noktp);
//         $('#nosim').text(data.nosim);
//         $('#jk').text(data.jk);
//         $('#tlp').text(data.tlp);
//         $('#donorke').text(data.donorke);
//         $('#nmwil').text(data.nmwil);
    
// });   });





// function changeHiddenInput (objDropDown)
// {

// //    document.getElementById("usia").value = objDropDown.value; 
//  //Get the current date from Date object first
//  var now = new Date();

// //To calculate user dob we need to first get the age from user as input
// var age = parseInt($('#tgllahir').val());

// //now we will calculate the birth year
// var birthYear = now.getFullYear() - age;

// //lets, Create the birth date object to store the birthdate
// var birthDate = new Date(birthYear, now.getMonth(), now.getDate());

// //We will output the birth date in the format YYYY-MM-DD on console
// console.log(birthDate.toISOString().slice(0,10));

// //we are checking for valid input to check for invalid input value like blank or negative age, in that case will output invalid age on
// //console
// if (isNaN(age) || age <= 0) {
//   console.log("Invalid age entered.");
// }

// //Add another check for birth year before 1900 if os will output it as invalid or not supported one
// if (birthYear < 1900) {
//   console.log("Birth year before 1900 is not supported.");
// }

// //Add another check for future birth year which should not be the case
// if (birthYear > now.getFullYear()) {
//   console.log("Age entered corresponds to a future birth year.");
// }

// }

</script>







@endsection