@extends('layouts.main')
@section('title', 'Master Donor')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS (opsional) -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
 <style>
        video, img { width: 300px; margin-top: 10px; }
    </style>

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
 <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush

@section('content')
<!-- Toastr JS -->

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Pedonor Baru</h4>
   
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

                                    <button 
                                        class="dropdown-item" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#userModal" 
                                        data-nod="{{ $item->nodonor }}" 
                                        data-namad="{{ $item->namadonor }}"
                                        data-tgl="{{ $item->tgllahir }}"
                                        data-jnk="{{ $item->jk }}"
                                        data-alamt="{{ $item->alamat }}"
                                        data-noktp="{{ $item->noktp }}"
                                        data-nosim="{{ $item->nosim }}"
                                        data-photo="{{ asset('storage/captures/' . $item->photo) }}"><i class='bx bx-search-alt'></i> Detail </button>
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
                            <!-- <div class="col-md-4">
                                    <div class="input-group">
                                    <img src="{{ asset('storage/' ) }}" />
                                    </div>
                             </div> -->
                             <div class="col-md-4">
                                    <br/>

                                <video id="video" width="220" height="240" autoplay></video>
                                <br/>
                                <canvas id="canvas" width="220" height="240" style="display: none;"></canvas>
                                <br/>
                                <div id="dtpreview" style="display:none;">
                                    <img id="preview" style="display:none;" alt=""   alt="user-avatar"
                                    class="d-block rounded" id="uploadedAvatar"  width="220" height="240">
                                    <br>
                                </div>
                                   <button type=button class="btn btn-info" id="capture">
                                        <i class='bx bx-camera'> </i> Ambil Foto</button>
                                    <button id="retake"  type=button class="btn btn-danger" style="display:none;"><i class='bx  bx-refresh'></i>  Ambil Ulang</button>
                                    <button id="save"  type=button class="btn btn-success" style="display:none;"><i class='bx  bx-upload'></i>  Simpan Foto</button>
                                     <input type="hidden" id="photo" name="photo">
                              
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
 <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body ">
       
           <!-- Foto -->
        <img id="modalPhoto" src="" alt="Foto" class="img-thumbnail mb-3" style="max-width: 150px;">

          <label>No Donor:</label>
           <div class="mb-3">{!! DNS1D::getBarcodeHTML('T-250000', 'C128') !!}        </div>
            <input type="text" class="form-control" id="modalNodonor" readonly>
   
          <label>Nama Donor:</label>
          <input type="text" class="form-control" id="modalNmdnr" readonly>
           <label>Tanggal Lahir:</label>
          <input type="text" class="form-control" id="modalTgl" readonly>
          <label>Jenis Kelamin:</label>
          <input type="text" class="form-control" id="modaljk" readonly>
          <label>Alamat:</label>
          <input type="text" class="form-control" id="modalalmt" readonly>
          <label>No Ktp:</label>
          <input type="text" class="form-control" id="modalktp" readonly> 
           <label>No SIM:</label>
          <input type="text" class="form-control" id="modalsim" readonly> 
      </div>
    </div>
  </div>
</div>

    </div>
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var userModal = document.getElementById('userModal');
    userModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var nod = button.getAttribute('data-nod');
        var namad = button.getAttribute('data-namad');
        var tgl = button.getAttribute('data-tgl');
        var jk = button.getAttribute('data-jnk');
        var almt = button.getAttribute('data-alamt');
        var noktp = button.getAttribute('data-noktp');
        var nosim = button.getAttribute('data-nosim');

        var photo = button.getAttribute('data-photo');

        document.getElementById('modalNodonor').value = nod;
        document.getElementById('modalNmdnr').value = namad;
        document.getElementById('modalTgl').value = tgl;
        document.getElementById('modaljk').value = jk;
        document.getElementById('modalalmt').value = almt;
        document.getElementById('modalktp').value = noktp;
        document.getElementById('modalsim').value = nosim;

        document.getElementById('modalPhoto').src = photo;
    });
});


   const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const preview = document.getElementById('preview');
        const captureBtn = document.getElementById('capture');
        const retakeBtn = document.getElementById('retake');
        const saveBtn = document.getElementById('save');
        const imageInput = document.getElementById('photo');
        // Akses kamera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            });

        captureBtn.onclick = () => {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            preview.src = imageData;
            imageInput.value = imageData;
            preview.style.display = 'block';
            dtpreview.style.display = 'block';
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            retakeBtn.style.display = 'inline';
            saveBtn.style.display = 'inline';
        };

        retakeBtn.onclick = () => {
            preview.style.display = 'none';
            dtpreview.style.display = 'none';
            video.style.display = 'block';
            captureBtn.style.display = 'inline';
            retakeBtn.style.display = 'none';
            saveBtn.style.display = 'none';
        };

        saveBtn.onclick = () => {
            const imageData = canvas.toDataURL('image/png');

           $.ajax({
                url: '{{ route("camera.get") }}',
                method: 'POST',
                data: {
                    image: imageData,
                    _token: '{{ csrf_token() }}'
                },
               success: function(response) {
                console.log(response.filename);
                alert('Foto berhasil disimpan: ' );

            },
        });
           
        };

// //ALERT
   @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
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



</script>







@endsection