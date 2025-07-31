@extends('layouts.main')
@section('title', 'Periksa Dokter')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">


<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
 <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pemeriksaan Dokter</h4>
    <br/>
    <a href="{{route('dashboard.antrian')}}" target="_blank">
        <button class="btn btn-success">Buka Tab Antrian</button>
    </a>
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


 <!-- Accordion -->
<div class="row">
                <div class="col-md mb-4 mb-md-0">
                  <small class="text-light fw-semibold">Pemeriksaan Kesehatan Pedonor</small>
                  <div class="accordion mt-3" id="accordionExample">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header" id="headingOne">
                        <button
                          type="button"
                          class="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionOne"
                          aria-expanded="true"
                          aria-controls="accordionOne"
                        >
                        Pemeriksaan Kesehatan Pedonor
                        </button>
                      </h2>

                      <div
                        id="accordionOne"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <div class="myTable">
                        <?php $i=1; ?>
                <table id="hoteltable" border="1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Kd Cabang</th>
                        <th>No Donor</th>
                        <th>Pedonor</th>
                        <th>TGL Lahir</th>
                        <th>Tgl Daftar </th>
                        <th>Umur </th>
                        <th>Donor ke </th>
                        <th>jenis kelamin </th>
                        <th>No Ktp </th>
                        <th>No Apftp</th>
                     
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($donor as $item)
                    <tr class="{{ $item->stperiksa == 1 ? 'table-danger' : '' }}" id="rowId{{ $item->id }}">
                        <td>{{$item->kdcab}}</td>
                        <td>{{$item->nodonor}}</td>
                        <td>{{$item->namadonor}}</td>
                        <td>{{$item->tgllahir}}</td>
                        <td>{{$item->tgldaftar}}</td>
                        <td>{{$item->usia}}</td>
                        <td>{{$item->donorke}}</td>
                        <td>{{$item->jk}}</td>
                        <td>{{$item->noktp}}</td>
                        <td style="display:none;">{{$item->alamat}}</td>
                        <td>{{$item->noaftp}}</td>
                       
                        <!-- <td tyle="display:none;"> 
                           <input type="text" hidden name="getiddonor" value="{{ $item->id }}">
                        </td> -->

                                                
                        </tr>
                       
                       
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                 
                    </tr>
                </tfoot>
            </table>
    </div>
                        <div class="col-12">
                      
                            <form class="hotelaction" modelAttribute="hotel" id="dataForm">
                            <!-- @csrf
                            @method('POST') -->

                                <div class="row mt-2">
                               
                                    <div class="col-md-2">
                                        <label for="defaultFormControlInput" class="form-label">No Area</label>
                                   
                                        <input type="hidden" value="002" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" />
                                        <input type="text" disabled value="002" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab"  aria-describedby="defaultFormControlHelp" />
                                        
                                        @error('kdcab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultFormControlInput" class="form-label">No.Donor</label>
                                       
                                        <input type="text" readonly value="" class="form-control @error('nodonor') is-invalid @enderror" name="nodonor" id="nodonor"  aria-describedby="defaultFormControlHelp" />
                                      
                                        @error('nmbrg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                   
                                    
                                    <div class="col-md-3">
                                        <label for="defaultFormControlInput" class="form-label">Nama Pedonor</label>
                                        <input type="text" readonly value="" class="form-control @error('namadonor') is-invalid @enderror" name="namadonor" id="namadonor" />
                                        @error('namadonor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    



                                    <div class="col-md-3">
                                        <label for="defaultFormControlInput" class="form-label">Tgl Lahir</label>
                                        <input type="text" readonly value="" class="form-control @error('tgllahir') is-invalid @enderror" name="tgllahir" id="tgllahir"  />
                                        @error('tgllahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="defaultFormControlInput" class="form-label">Tgl Akhir Donor</label>
                                        <input type="text" readonly value="" class="form-control @error('tgldaftar') is-invalid @enderror" name="tgldaftar" id="tgldaftar"   />
                                        @error('tgldaftar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="defaultFormControlInput" class="form-label">Jenis Kantong Terahir</label>
                                        <input type="text" readonly value="" class="form-control @error('jnskntng') is-invalid @enderror" name="jnskntng" id="jnskntng"   />
                                        @error('jnskntng')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultFormControlInput" class="form-label">Umur</label>
                                            <input type="text" readonly value="" class="form-control @error('umur') is-invalid @enderror" name="umur" id="umur" />
                                            @error('umur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultFormControlInput" class="form-label">Jenis Kelamin</label>
                                            <input type="text" readonly value="" class="form-control @error('jk') is-invalid @enderror" name="jk" id="jk" />
                                            @error('jk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultFormControlInput" class="form-label">Gol - Rh</label>
                                            <input type="text" readonly value="" class="form-control @error('golrh') is-invalid @enderror" name="golrh" id="golrh"   />
                                            @error('golrh')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultFormControlInput" class="form-label">Tempat Akhir Donor</label>
                                       
                                            <input type="text" readonly value="UDD -PMI KOTA SURABAYA" class="form-control @error('nmcab') is-invalid @enderror" name="nmcab" id="nmcab"   />
                                      
                                            @error('nmcab')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultFormControlInput" class="form-label">Status Kantong Darah Terahir</label>
                                            <input type="text" readonly value="" class="form-control @error('sttskntong') is-invalid @enderror" name="sttskntong" id="sttskntong"  />
                                            @error('sttskntong')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultFormControlInput" class="form-label">Donor Ke</label>
                                            <input type="text" readonly value="" class="form-control @error('donorke') is-invalid @enderror" name="donorke" id="donorke"  />
                                            @error('donorke')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultFormControlInput" class="form-label">Skrining Antibodi</label>
                                            <input type="text" readonly value="" class="form-control @error('skrin') is-invalid @enderror" name="skrin" id="skrin"  />
                                            @error('skrin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultFormControlInput" class="form-label">NIK KTP</label>
                                            <input type="text" readonly value="" class="form-control @error('skrin') is-invalid @enderror" name="noktp" id="noktp"  />
                                            @error('noktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="defaultFormControlInput" class="form-label">No Aftap</label>
                                        <input type="text" readonly value="" class="form-control @error('noaftap') is-invalid @enderror"required  name="noaftap" id="noaftap" />
                                         @foreach($donor as $a)
                                        <input type="hidden" value="{{$a->noaftp}}" class="form-control " name="noaftap" id="noaftap" required/>
                                        @endforeach
                                        @error('noaftap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    </div>

                                </div>
                                
                        
                                      &nbsp;
                               <hr width="100%" color="green"  style="border: 1px solid red;"/>
                               <div class="col-14">
                                     <div class="row mt-5">
                                        <div class="col-md-2">
                                            <label for="defaultFormControlInput" class="form-label">Tgl Periksa</label>
                                            <input type="date" disabled value="<?php  echo date('Y-m-d');?>" class="form-control @error('tglperiksa') is-invalid @enderror" name="tglperiksa" id="tglperiksa"  aria-describedby="defaultFormControlHelp" />
                                        
                                            @error('tglperiksa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="defaultFormControlInput" class="form-label">Tensi Darah</label>
                                    
                                            <input type="text"  value="" class="form-control @error('tensi') is-invalid @enderror" name="tensi" id="tensi"  aria-describedby="defaultFormControlHelp" />
                                        
                                            
                                            @error('tensi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="defaultFormControlInput" class="form-label">Nadi</label>
                                            <input type="text"  value="" class="form-control @error('nadi') is-invalid @enderror" name="nadi" id="nadi"  aria-describedby="defaultFormControlHelp" />
                                        
                                            @error('nadi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <label for="defaultFormControlInput" class="form-label">Suhu </label>
                                            <div class="input-group">
                                            <input type="text"  value="" class="form-control @error('suhu') is-invalid @enderror" name="suhu" id="suhu"  aria-describedby="defaultFormControlHelp" />
                                              
                                                @error('suhu')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="defaultFormControlInput" class="form-label">Berat Badan </label> 
                                            <div class="input-group">
                                            <input type="text"  value="" class="form-control @error('kdcab') is-invalid @enderror" name="brtbdn" id="brtbdn" placeholder=" Kg" />  
                                                @error('brtbdn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="defaultFormControlInput" class="form-label">Tinggi Badan </label> 
                                            <div class="input-group">
                                            <input type="text"  value="" class="form-control @error('tgbdn') is-invalid @enderror" name="tgbdn" id="tgbdn" placeholder="Cm" />
                                              
                                                @error('tgbdn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="defaultFormControlInput" class="form-label">Jenis Kantong </label>
                                            <div class="input-group">
                                                <select  onchange="giveSelection()" name="jnsktg" id="jnsktg" class="form-control form-select @error('jnskntng') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih  --</option>
                                                    @foreach ($jnskntng as $cc)
                                                    <option value="{{$cc->jenis}}"  data-option="{{$cc->id}}">{{$cc->jenis}}</option>
                                                    @endforeach 
                                                </select>
                                                @error('jnsktg')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="defaultFormControlInput" class="form-label">Type Jenis Kantong </label>
                                            <div class="input-group">
                                                <select name="typektg" id="typektg" class="form-control form-select @error('typektg') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih  --</option>
                                                    @foreach ($jnskntng as $cc)
                                                    <option value="{{$cc->typektg}}" data-option="{{$cc->id}}">{{$cc->typektg}}</option>
                                                    @endforeach 
                                                </select>
                                                @error('typektg')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">CC Ambil </label>
                                            <div class="input-group">
                                                <select name="ccambil" id="ccambil" class="form-control form-select @error('ccambil') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih  --</option>
                                                    @foreach ($ukuran as $cc)
                                                    <option value="{{$cc->ml}}">{{$cc->ml}}</option>
                                                    @endforeach

                                                    </select>
                                                @error('ccambil')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="defaultFormControlInput" class="form-label">ECG </label>
                                            <div class="input-group">
                                                <select name="ecg" id="ecg" class="form-control form-select @error('ecg') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih  --</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Tidak Normal">Tidak Normal</option>  
                                                    </select>
                                                @error('ecg')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="defaultFormControlInput" class="form-label">Status</label>
                                            <select name="tolak" id="tolak" class="form-control form-select   add_fields_placeholder">
                                                <option value="" selected disabled>-- Pilih  --</option>
                                                <option value="TERIMA">TERIMA</option>
                                                <option value="TOLAK">TOLAK</option>
                                            </select>
                                        
                                            @error('tolak')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="tampildata">
                                            <label for="defaultFormControlInput" class="form-label">Alasan </label> 
                                            <div class="input-group">
                                            <select name="alsntlk" id="alsntlk" class="form-control form-select">
                                                <!-- <option value="pilih" selected disabled>-- Pilih  --</option> -->
                                                <option value="TERIMA">TERIMA</option>
                                                <option value="CEKAL">CEKAL</option>
                                                <option value="HB Rendah">HB Rendah</option>
                                                <option value="HB Tinggi">HB Tinggi</option>
                                                <option value="Lain - Lain">Lain - Lain</option>
                                                <option value="Tensi Rendah">Tensi Rendah</option>
                                                <option value="Tensi Tinggi">Tensi Tinggi</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="defaultFormControlInput" class="form-label">Keterangan </label> 
                                            <div class="input-group">
                                            <input type="text"  value="" class="form-control @error('ketperiksa') is-invalid @enderror" name="ketperiksa" id="ketperiksa" placeholder="masukkan Keterangan" />
                                              
                                                @error('ketperiksa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="defaultFormControlInput" class="form-label">Petugas Pemeriksa </label> 
                                            <div class="input-group">
                                            <input type="text" disabled value="{{Auth::user()->name}}" class="form-control @error('nmptgs') is-invalid @enderror" name="nmptgs" id="nmptgs"  />
                                              
                                                @error('nmptgs')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @foreach($donor as $d)
                                        <input type="hidden" value="{{$d->alamat}}" class="form-control" name="almt" id="almt" />

                                        @endforeach
     
                                        <input type="hidden" value="{{Auth::user()->id}}" class="form-control" name="kdptgdr" id="kdptgdr" />
                                       
                                        <input type="hidden"  value="{{Auth::user()->name}}" class="form-control" name="nmptgdr" id="nmptgdr"  />
                                    
                                             <div class="mt-4 mb-2 text-end">
                                                    <a href="{{route('perisadokter.index')}}" class="btn btn-secondary"> <i class='bx bx-arrow-back' ></i> Kembali</a>
                                                      <button type="submit" class="btn btn-primary tombol-simpan" id="simpan"><i class='bx bx-save' ></i> Simpan</button> 
                                             </div>
                                        
                                    </div>
                                </div>      

                                            </form>
                         </div>
                        <!----- end card --->
                                

                      </div>
                    </div>
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionTwo"
                          aria-expanded="false"
                          aria-controls="accordionTwo"
                        >
                         Data Quesioner 
                        </button>
                      </h2>
                      <div
                        id="accordionTwo"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">

<div class="accordion-body">
<br/>
<div class="row">
    <div class="col-md-12 col-xl-6">
    <div class="card shadow-none bg-transparent border border-primary mb-3">
        <div class="card-body">
          <form class="hotelaction"action="{{route('quesioner')}}" method="post" enctype="multipart/form-data" modelAttribute="hotel">
                            @csrf
                            @method('POST')
                            <table>
                            @foreach($donor as $a)
                            <input type="hidden" value="{{$a->kdcab}}" class="form-control " name="kdcab" id="kdcab" />
                            <input type="hidden" value="{{$a->id}}" class="form-control " name="id_donor" id="id_donor" />
                            <input type="hidden" value="{{$a->nodonor}}" class="form-control " name="nodonor" id="nodonor" />
                           
                            <input type="hidden" value="{{$a->noaftp}}" class="form-control " name="noaftp" id="noaftp" required/>

                            <input type="hidden" value="{{$a->tgldaftar}}" class="form-control " name="tglperiksa" id="tglperiksa" />
                            @endforeach

                            <tr>
                                <td> Sehat Hari ini.. &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="sehat" name="sehat">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="sehat" name="sehat">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="sehat" name="sehat">Tidak Tau
                                    &nbsp; &nbsp; &nbsp;  
                                </td>
                            </tr>
                            <tr>
                                    <td> Sakit / Oprasi 3 Bln ini.. &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="sakit" name="sakit">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="sakit" name="sakit">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="sakit" name="sakit">Tidak Tau
                                    &nbsp;  
                                </td>
                            </tr>
                            <tr>
                                    <td> Pernah Sakit Diabetes..  &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="diabet" name="diabet">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="diabet" name="diabet">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="diabet" name="diabet">Tidak Tau
                                    &nbsp; 
                                </td>
                            </tr>
                            <tr>
                                <td> Pernah Sakit Ginjal.. &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="ginjal" name="ginjal">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="ginjal" name="ginjal">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="ginjal" name="ginjal">Tidak Tau
                                    &nbsp; 
                                </td>
                            </tr>
                            <tr>
                                <td> Pernah Sakit Radang.. &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="radang" name="radang">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="radang" name="radang">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="radang" name="radang">Tidak Tau
                                    &nbsp;
                                </td>
                            </tr> 
                            <tr>
                                <td> Pernah Sakit Jantung.. &nbsp; &nbsp; &nbsp;
                                <input class="form-check-input" type="checkbox" value="Ya" id="jantung" name="jantung">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                <input class="form-check-input" type="checkbox" value="Tidak" id="jantung" name="jantung">Tidak
                                &nbsp; &nbsp; &nbsp;
                                <input class="form-check-input" type="checkbox" value="Tidak Tau" id="jantung" name="jantung">Tidak Tau
                                &nbsp; 
                                </td>
                            </tr>
                            <tr>
                                <td> Pernah Sakit Hemofilia.. &nbsp; &nbsp; &nbsp; 
                                <input class="form-check-input" type="checkbox" value="Ya" id="hemofilia" name="hemofilia">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                <input class="form-check-input" type="checkbox" value="Tidak" id="hemofilia" name="hemofilia">Tidak
                                &nbsp; &nbsp; &nbsp;
                                <input class="form-check-input" type="checkbox" value="Tidak Tau" id="hemofilia" name="hemofilia">Tidak Tau
                                &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td> Pernah Sakit Asma.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                    <input class="form-check-input" type="checkbox" value="Ya" id="asma" name="asma">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="asma" name="asma">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="asma" name="asma">Tidak Tau
                                    &nbsp; 
                                </td>
                                </tr>
                                <tr>
                                <td> Pernah Sakit TBC.. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                    <input class="form-check-input" type="checkbox" value="Ya" id="tbc" name="tbc">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="tbc" name="tbc">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="tbc" name="tbc">Tidak Tau
                                    &nbsp; 
                                </td>
                                </tr>
                                <tr>
                                <td> Sering Kejang - Kejang.. &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Ya" id="kenjang" name="kenjang">Ya 
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak" id="kenjang" name="kenjang">Tidak
                                    &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="kenjang" name="kenjang">Tidak Tau
                                    &nbsp; 
                                </td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-xl-6">
                    <div class="card shadow-none bg-transparent border border-success mb-3">
                        <div class="card-body">
                                        <table>
                                                <tr>
                                                <td> Punya Gejala HIV.. &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="hiv" name="hiv">Ya 
                                                        &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="hiv" name="hiv">Tidak
                                                    &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="hiv" name="hiv">Tidak Tau
                                                    &nbsp;
                                                </td> 
                                                </tr>
                                                <tr>
                                                <td> Punya Gejala Hepatitis B/C.. &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="hepatitis" name="hepatitis">Ya 
                                                        &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="hepatitis" name="hepatitis">Tidak
                                                    &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="hepatitis" name="hepatitis">Tidak Tau
                                                    &nbsp; 
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td> Punya Gejala Sifilis..  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="sifilis" name="sifilis">Ya 
                                                        &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="sifilis" name="sifilis">Tidak
                                                    &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="sifilis" name="sifilis">Tidak Tau
                                                    &nbsp; 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>   Punya Gejala Malaria.. &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="malaria" name="malaria">Ya 
                                                        &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="malaria" name="malaria">Tidak
                                                    &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="malaria" name="malaria">Tidak Tau
                                                    &nbsp; 
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td>  Keluar Negeri 6 Bln Ini .. &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="luarngri" name="luarngri">Ya 
                                                        &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="luarngri" name="luarngri">Tidak
                                                    &nbsp; &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="luarngri" name="luarngri">Tidak Tau
                                                    &nbsp; 
                                                </td>          
                                            </tr> 
                                            <tr>
                                                    <td>   Donor u/Hasil Pemeriksaan.. &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="hasilpriksa" name="hasilpriksa">Ya 
                                                        &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="hasilpriksa" name="hasilpriksa">Tidak
                                                    &nbsp; &nbsp;
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="hasilpriksa" name="hasilpriksa">Tidak Tau
                                                    &nbsp; 
                                                    </td>
                                                </tr>
                                            <tr>
                                                    <td> Donor Pakai Identitas Lain.. &nbsp; &nbsp; 
                                                        <input class="form-check-input" type="checkbox" value="Ya" id="orglain" name="orglain">Ya 
                                                        &nbsp; &nbsp;
                                                        <input class="form-check-input" type="checkbox" value="Tidak" id="orglain" name="orglain">Tidak
                                                        &nbsp; &nbsp;
                                                        <input class="form-check-input" type="checkbox" value="Tidak Tau" id="orglain" name="orglain">Tidak Tau
                                                        &nbsp; 
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>   Pernah Donor Dalam 3 Bln.. &nbsp; &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Ya" id="bln" name="bln">Ya 
                                                        &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Tidak" id="bln" name="bln">Tidak
                                                    &nbsp; &nbsp; 
                                                    <input class="form-check-input" type="checkbox" value="Tidak Tau" id="bln" name="bln">Tidak Tau
                                                    &nbsp; 
                                                    </td>
                                            </tr>
                                            <tr> 
                                                <td> <p style="color:Tomato;"> Bagi Wanita :</p> </td></tr>
                                                <tr>
                                                    <td><p style="color:Tomato;"> Sedang Hamil/Menyusui &nbsp; &nbsp; 
                                                        <input class="form-check-input" type="checkbox" value="Ya" id="hamil" name="hamil">Ya 
                                                        &nbsp; &nbsp; 
                                                        <input class="form-check-input" type="checkbox" value="Tidak" id="hamil" name="hamil">Tidak
                                                        &nbsp; &nbsp; 
                                                        <input class="form-check-input" type="checkbox" value="Tidak Tau" id="hamil" name="hamil">Tidak Tau
                                                        &nbsp; </p>
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td><p style="color:Tomato;">Sedang Menstruasi &nbsp; &nbsp;&nbsp; &nbsp; 
                                                            <input class="form-check-input" type="checkbox" value="Ya" id="mens" name="mens">Ya 
                                                                &nbsp; &nbsp; 
                                                            <input class="form-check-input" type="checkbox" value="Tidak" id="mens" name="mens">Tidak
                                                                &nbsp; &nbsp; 
                                                            <input class="form-check-input" type="checkbox" value="Tidak Tau" id="mens" name="mens">Tidak Tau
                                                                &nbsp; 
                                                        </p>   
                                                        </td>
                                                </tr>  
                                            </table>

                                            <div class="mt-4 mb-2 text-end">
                                                    <button type="submit" class="btn btn-primary tombol-simpan" onClick="quest()"><i class='bx bx-save' ></i> Simpan</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="row">
                              <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th class="col-md-10">No donor</th>
                                    <th class="col-md-10">Gejala HIV</th>
                                    <th class="col-md-10">Gejala Hepatitis</th>
                                    <th class="col-md-10">Gejala Sifilis</th>
                                    <th class="col-md-10">Gejala Malaria</th>
                                    <th class="col-md-10">Keluar Negeri</th>
                                    <th class="col-md-10">u/Hasil Pemeriksaan </th>
                                    <th class="col-md-10">Identitas Lain</th>
                                    <th class="col-md-10">Donor Dalam 3 Bln</th>
                                    <th class="col-md-10">Hamil/Menyusui</th>
                                    <th class="col-md-10">Sedang Menstruasi</th>

                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody >
                                 @foreach($quest as $u)
                                <tr >
                                        <td>{{ $u->nodonor }}</td>
                                        <td>{{ $u->hiv }}</td>
                                        <td>{{ $u->hepatitis }}</td>
                                        <td>{{ $u->sifilis }}</td>
                                        <td>{{ $u->malaria }}</td>
                                        <td>{{ $u->luarngri }}</td>
                                        <td>{{ $u->hasilpriksa }}</td>
                                        <td>{{ $u->orglain }}</td>
                                        <td>{{ $u->bln }}</td>
                                        <td>{{ $u->hamil }}</td>
                                        <td>{{ $u->orglain }}</td>
                                        <td>{{ $u->mens }}</td>
                                        <td>    <a href="{{ route('show.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                      <form action="{{ route('quest.destroy', $u->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                                            </form>
                                        </td>
                                        

                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionThree"
                          aria-expanded="false"
                          aria-controls="accordionThree"
                        >
                          Data Donor Periksa Kesehatan
                        </button>
                      </h2>
                      <div
                        id="accordionThree"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="col-md-10">Tgl Daftar</th>
                                    <th class="col-md-10">No Donor</th>
                                    <th class="col-md-10">Nama Donor</th>
                                    <th class="col-md-10">Jns Kantong</th>
                                    <th class="col-md-10">Pemeriksa</th>
                                    <th class="col-md-10">Status </th>
                                    <th class="col-md-10">Alasan Tolak</th>

                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php $i=1; ?>
                    @foreach ($periksa as $item)
                       
                    <tr class="{{ $item->stperiksa == 1 ? 'table-danger' : '' }}" id="rowId{{ $item->id }}">
                    
                        <td>{{$item->tgldaftar}}</td>
                        <td>{{$item->nodonor}}</td>
                        <td>{{$item->namadonor}}</td>
                        <td>{{$item->jnsktg}}</td>
                        <td>{{$item->nmptgdr}}</td>
                        <td>{{$item->tolak}}</td>
                        <td>{{$item->alstolak}}</td>
                        <td> </td>
                       
                       
                       
                        <!-- <td tyle="display:none;"> 
                           <input type="text" hidden name="getiddonor" value="{{ $item->id }}">
                        </td> -->

                                                
                        </tr>
                       
                       
                    @endforeach
                </tbody>
                        </table>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
 <!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="postForm">
      @csrf
      <input type="hidden" id="post_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah/Edit Post</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>Judul</label>
              <input type="text" name="title" id="title" class="form-control">
          </div>
          <div class="form-group">
              <label>Konten</label>
              <textarea name="content" id="content" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </form>
  </div>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<script>




           // fungsi simpan dan update quesioner
     function quest(id = '') {
        if (id == '') {
            var var_url = '/pedonor/quesioner';
            var var_type = 'POST';
        } else {
            var var_url = '/pedonor/quesioner' + id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                kdcab: $('#kdcab').val(),
                id_donor: $('#id_donor').val(),
                nodonor: $('#nodonor').val(),
                noaftp: $('#noaftp').val(),
                tglperiksa: $('#tglperiksa').val(),
                sehat: $('#sehat').val(),   
                sakit: $('#sakit').val(),
                diabet: $('#diabet').val(),
                ginjal: $('#ginjal').val(),
                radang: $('#radang').val(),
                jantung: $('#jantung').val(),
                hemofilia: $('#hemofilia').val(),
                asma: $('#asma').val(),
                tbc: $('#tbc').val(),
                kenjang: $('#kenjang').val(),
                hiv: $('#hiv').val(),
                hepatitis: $('#hepatitis').val(),
                sifilis: $('#sifilis').val(),
                malaria: $('#malaria').val(),
                luarngri: $('#luarngri').val(),
                hasilpriksa: $('#hasilpriksa').val(),
                orglain: $('#orglain').val(),
                bln: $('#bln').val(),
                hamil: $('#hamil').val(),
                mens: $('#mens').val(),

            },
            beforeSend: function(){
                $("#spiner").show();
            },
            complete: function(response) {
                if (response.errors) {
                    console.log(response.errors);
               
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('success').html(response.success);
                }
                // $('#hoteltable').DataTable().ajax.reload();
                $("#spiner").hide();
            }

        });
    }










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

$(document).ready(function()
{//ONCHANGE TOLAK BALAK
    $("#tolak").change(function()
        {
            if($(this).val() == "TOLAK")
        {
            $("#tampildata").show();
        }
        else
        {
            $("#tampildata").hide();
            
        }
      });
        $("#tampildata").hide();
});

// selected dinamic 2 value jns kantong
var sel1 = $('#jnsktg');
var sel2 = $('#typektg');
var options2 = sel2.find('option');

function giveSelection() {
  var target = sel1.find(':selected').data('option');
  
  sel2.empty().append(
    options2.filter(function(){
      return $(this).data('option') === target;
    })
  );
}
//data pemeriksaan

$(document).ready(function() {
    $('#myTable').dataTable( {
      
    } );
   
} );
$(document).ready(function() {
    $('#antri').dataTable( {
      
    } );
   
} );
$(document).ready(function(){
    $('#hoteltable').dataTable({

});
});

    $(document).ready(function () {
        $('#dataForm').on('submit', function (e) {
            e.preventDefault();
    
    let formdata = {
             kdcab: $('#kdcab').val(),
                nodonor: $('#nodonor').val(),
                noaftap: $('#noaftap').val(),
                namadonor: $('#namadonor').val(),
                tgllahir: $('#tgllahir').val(),
                tgldaftar: $('#tgldaftar').val(),
                jnsktg: $('#jnsktg').val(),
                umur: $('#umur').val(),
                jk: $('#jk').val(),
                golrh: $('#golrh').val(),
                nmcab: $('#nmcab').val(),
                sttskntong: $('#sttskntong').val(),
                donorke: $('#donorke').val(),
                skrin: $('#skrin').val(),
                noktp: $('#noktp').val(),
                tglperiksa: $('#tglperiksa').val(),
                tensi: $('#tensi').val(),
                nadi: $('#nadi').val(),
                suhu: $('#suhu').val(),
                brtbdn: $('#brtbdn').val(),
                tgbdn: $('#tgbdn').val(),
                typektg: $('#typektg').val(),  
                ccambil: $('#ccambil').val(),
                ecg: $('#ecg').val(),
                tolak: $('#tolak').val(),
                alsntlk: $('#alsntlk').val(),
                ketperiksa: $('#ketperiksa').val(),
                nmptgdr: $('#nmptgdr').val(),
                kdptgdr: $('#kdptgdr').val(),

                almt: $('#almt').val(),
    }    

            $.ajax({
                url: "{{ route('simpan.data') }}",
                type: 'POST',
                data: formdata,
                
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil disimpan',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                    }).then(() => {
                        $('#kdcab').val('');
                        $('#nodonor').val('');
                        $('#noaftap').val('');
                        $('#namadonor').val('');
                        $('#tgllahir').val('');
                        $('#tgldaftar').val('');
                        $('#jnsktg').val('');
                        $('#umur').val('');
                        $('#jk').val('');
                        $('#golrh').val('');
                        $('#nmcab').val('');
                        $('#sttskntong').val('');
                        $('#donorke').val('');
                        $('#skrin').val('');
                        $('#noktp').val('');
                        $('#tglperiksa').val('');
                        $('#tensi').val('');
                        $('#nadi').val('');
                        $('#suhu').val('');
                        $('#brtbdn').val('');
                        $('#tgbdn').val('');
                        $('#typektg').val(''); 
                        $('#ccambil').val('');
                        $('#ecg').val('');
                        $('#tolak').val('');
                        $('#alsntlk').val('');
                        $('#ketperiksa').val('');
                        $('#nmptgdr').val('');
                        $('#kdptgdr').val('');
                        $('#almt').val('');
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let pesan = '';
                    $.each(errors, function(key, value) {
                                        alert(key.message);
                    });
                    $('#hasil').html(pesan);
                }
            });
        });
    });


    // 02_PROSES SIMPAN 
   
      // fungsi simpan dan update
    //   function simpan(id = '') {
    //     if (id == '') {
    //         var var_url = 'perisadokter';
    //         var var_type = 'POST';
    //     } else {
    //         var var_url = 'perisadokter/' + id;
    //         var var_type = 'PUT';
    //     }
    //     $.ajax({
    //         url: var_url,
    //         type: var_type,
    //         data: {
    //             kdcab: $('#kdcab').val(),
    //             nodonor: $('#nodonor').val(),
    //             namadonor: $('#namadonor').val(),
    //             tgllahir: $('#tgllahir').val(),
    //             tgldaftar: $('#tgldaftar').val(),
    //             jnskntng: $('#jnskntng').val(),
    //             umur: $('#umur').val(),
    //             jk: $('#jk').val(),
    //             golrh: $('#golrh').val(),
    //             nmcab: $('#nmcab').val(),
    //             sttskntong: $('#sttskntong').val(),
    //             donorke: $('#donorke').val(),
    //             skrin: $('#skrin').val(),
    //             noktp: $('#noktp').val(),
    //             tglperiksa: $('#tglperiksa').val(),
    //             tensi: $('#tensi').val(),
    //             nadi: $('#nadi').val(),
    //             suhu: $('#suhu').val(),
    //             brtbdn: $('#brtbdn').val(),
    //             tgbadan: $('#tgbadan').val(),
    //             jnsktg: $('#jnsktg').val(),
    //             typektg: $('#typektg').val(),  
    //             ccambil: $('#ccambil').val(),
    //             ecg: $('#ecg').val(),
    //             tolak: $('#tolak').val(),
    //             alsntlk: $('#alsntlk').val(),
    //             ketperiksa: $('#ketperiksa').val(),
    //             nmptgdr: $('#nmptgdr').val(),
    //             kdptgdr: $('#kdptgdr').val(),

    //             almt: $('#almt').val(),

    //         },
    //         beforeSend: function(){
    //             $("#spiner").show();
    //         },
    //         complete: function(response) {
    //             if (response.errors) {
    //                 console.log(response.errors);
    //                 $('.alert-danger').removeClass('d-none');
    //                 $('.alert-danger').html("<ul>");
    //                 $.each(response.errors, function(key, value) {
    //                     $('.alert-danger').find('ul').append("<li>" + value +
    //                         "</li>");
    //                 });
    //                 $('.alert-danger').append("</ul>");
    //             } else {
    //                 $('.alert-success').removeClass('d-none');
    //                 $('success').html(response.success);
    //             }
    //             // $('#hoteltable').DataTable().ajax.reload();
    //             $("#spiner").hide();
    //         }

    //     });
    // }

// const getdata = document.querySelectorAll('.hoteltable');

// document.getElementById("noaftap").value = getdata;

// Hook click on the table, pasrsing text 
document.getElementById("hoteltable").addEventListener("click", function(e) {
    // Make sure the click passed through a row in this table
    var row = e.target.closest("tr");
    if (!row || !this.contains(row)) {
        return;
    }
	// Get the form we're filling in
	var form = document.querySelector("form[class=hotelaction]");
	// Fill in the various inputs
	// Note: I'd recommend giving each cell a data-name attribute or something
	// and using those rather than using `row.cells[0]` and such. That way
	// when (not if ;-) ) you change the source table, the cell references
	// aren't messed up
    form.querySelector("[name=kdcab]").value = row.cells[0].innerHTML;
    form.querySelector("[name=nodonor]").value = row.cells[1].innerHTML;
    form.querySelector("[name=namadonor]").value = row.cells[2].innerHTML;
    form.querySelector("[name=tgllahir]").value = row.cells[3].innerHTML;
    form.querySelector("[name=tgldaftar]").value = row.cells[4].innerHTML;                  
    form.querySelector("[name=umur]").value = row.cells[5].innerHTML;                 
    form.querySelector("[name=donorke]").value = row.cells[6].innerHTML;        
    form.querySelector("[name=jk]").value = row.cells[7].innerHTML; 
    form.querySelector("[name=noktp]").value = row.cells[8].innerHTML;  
    // form.querySelector("[name=alamat]").value = row.cells[9].innerHTML; 
    form.querySelector("[name=noaftap]").value = row.cells[10].innerHTML; 

    // form.querySelector("[name=getiddonor]").value = row.cells[10].innerHTML;                 





    /*
    hideButton();
    showDelete();
    showEdit();
    */
});
</script>

    @section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@600&display=swap" rel="stylesheet">
    <style>
        .antri {
            font-family: 'DynaPuff', cursive;
            font-weight: 600;
            font-size: 80px
        }
    </style>
@endsection


@endsection