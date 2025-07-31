@extends('layouts.main')
@section('title', 'Edit Pedonor')

@section('content')


<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Donor / </span> Edit Pedonor</h4>

<div class="row">
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('mdonor.update',$donor->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="defaultFormControlInput" class="form-label">No Area</label>
                             
                                <input type="hidden" value="{{ $donor->kdcab }}" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" />
                                <input type="text" disabled value="{{ $donor->kdcab }}" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                        
                                @error('kdcab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">No.Donor</label>
                               
                                <input type="text" disabled value="{{ $donor->nodonor }}" class="form-control @error('nodonor') is-invalid @enderror" name="nodonor" id="nodonor" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" value="{{ $donor->nodonor }}" class="form-control @error('nodonor') is-invalid @enderror" name="nodonor" id="nodonor"/>
                               
                                @error('nmbrg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <label for="defaultFormControlInput" class="form-label">Nama Pedonor</label>
                                <input type="text" value="{{ $donor->namadonor }}" class="form-control @error('namadonor') is-invalid @enderror" name="namadonor" id="namadonor" placeholder="Nama lengkap"  />
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
                                <input type="text" value="{{ $donor->alamat }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" />
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="stok" class="form-label">Kode Pos</label>
                                <input type="number" value="{{ $donor->kodepos }}" class="form-control @error('kodepos') is-invalid @enderror" name="kodepos" id="kodepos" placeholder="Kode Pos"/>
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
                                <input type="number" id="donorke" name="donorke" class="form-control @error('alamat') is-invalid @enderror" value="{{ $donor->donorke }}" placeholder="Donor Ke">
                              
                                @error('donorke')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
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
                                <div class="col-md-4">
                                    <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                                    <div class="input-group">
                                    <input type="date" value="{{$donor->tgllahir}}" class="form-control @error('tgllahir') is-invalid @enderror" name="tgllahir" id="tgllahir" {{-- placeholder="tgllahir" --}} aria-describedby="defaultFormControlHelp" />
                                    
                                    @error('tgllahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-2">
                                <?php

                                ?>
                                    <label for="defaultFormControlInput" class="form-label">Usia</label>
                                    <div class="input-group">
                                    <input type="text" readonly value="{{ $donor->usia }}" class="form-control" name="usia" id="usia" {{-- placeholder="usia" --}} aria-describedby="defaultFormControlHelp" />
                                    
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
                                 <input type="text" value="{{ $donor->kelurahan }}" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" id="kelurahan" placeholder="Kelurahan"/>
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
                                 <input type="text" value="{{ $donor->kecamatan }}" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" placeholder="Kecamatan" />
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
                                 <input type="text" value="{{ $donor->nmwil }}" class="form-control @error('nmwil') is-invalid @enderror" name="nmwil" id="nmwil" placeholder="Kab / Kota"/>
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
                                 <input type="number" value="{{ $donor->tlp }}" class="form-control @error('tlp') is-invalid @enderror" name="tlp" id="tlp" placeholder="Nomor Telphone"/>
                              
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
                                 <input type="number" value="{{ $donor->noktp }}" class="form-control @error('noktp') is-invalid @enderror" name="noktp" id="noktp" placeholder="Nik KTP" />
                              
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
                                 <input type="number" value="{{ $donor->nosim }}" class="form-control @error('nosim') is-invalid @enderror" name="nosim" id="nosim" placeholder="NO SIM"/>
                              
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
                            <div class="mt-4 mb-2 text-end">
                            <a href="{{route('mdonor.index')}}" class="btn btn-secondary">  <i class='bx bx-arrow-back' ></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="bx bx-edit-alt me-1"></i> Ubah</button> 
                                </div>
   
    </form>

<script>
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

</script>

@endsection