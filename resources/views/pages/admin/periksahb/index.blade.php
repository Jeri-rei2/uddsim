@extends('layouts.main')
@section('title', 'Periksa HB')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pemeriksaan HB</h4>
</div>


<div class="container">
    <div class="row">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">Pemanggilan Antrian HB</h5>
                <div class="row">
                    <div class="col-lg-35 grid-margin stretch-card">
                      <div class="card">      
                        <div class="card-body">
                            <div class="col-lg-12 mb-7">
                                <form action="{{route('listantrianhb')}}" class="input-group">
                                    <div class="col-md-6">
                                        <select class="form-select loket mb-3" name="id_loket">
                                            <option selected disabled>Pilih Loket</option>
                                            @foreach ($loket as $l)
                                            @if ($l->id == request('id_loket'))    
                                            <option value="{{ $l->id }}" selected>{{ $l->nama_loket }}</option>
                                            @else
                                            <option value="{{ $l->id }}">{{ $l->nama_loket }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-sm btn-info mx-1"><i class='bx bx-check' ></i>  Pilih</button>
                                        <!-- <a href="{{route('loket.antrian')}}" class="btn btn-sm btn-danger" target="_blank" rel="noopener noreferrer"><i class='bx bxs-printer'></i> Cetak Antrian HB</a> -->
                                        <!-- <a href="{{route('list.antrian')}}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer"> <i class='bx bx-book' ></i>  Lihat Daftar antrian</a> -->
                                    </div>
                                </form>
                            </div>
                            @if ($antrian)
                            <table class="table table-responsive table-bordered">
                                <thead class="table-info">
                                    <tr class="text-center">
                                        <th class="col-md-2">No</th>
                                        <th class="col-md-5">No Antrian</th>
                                        <th class="col-md-10">Nama Pedonor</th>
                                        <th class="col-md-6">Ruang</th>
                                        <th class="col-md-6">Status</th>
                                        <th class="col-md-6">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                @foreach ($antrian as $index => $a)
                                    <tr class="{{ $a->status == 1 ? 'table-danger' : '' }}" id="rowId{{ $a->id }}">
                                        <td width="50">{{ $loop->iteration }}</td>
                                        <td>{{ $a->nomor }}</td>
                                        <td>{{ $a->namadonor }}</td>
                                        <td>{{ $a->ruang }}</td>
                                        <td>
                                            @if ($a->status === 'dipanggil')
                                                Sudah Periksa dokter 
                                            @elseif($a->status === 'selesai')
                                                Selesai
                                            @else
                                                done
                                            @endif
                                        </td>
                                        <td width="550" class="tombolAksi">
                                        <form action="{{ route('nexthb') }}" method="POST" class="mb-3">
                                        @csrf
                                            <!-- <a href="" class="btn btn-sm btn-danger tombolPrevious" data-tipe="previous" data-id="{{ $a->id }}"><i class='bx bx-skip-previous' ></i></a> -->
                                            <a type="button"  class="btn btn-sm btn-success tombolPanggil" id="panggilBtn"><i class='bx bxs-bell-ring' ></i> Panggil</a>
                                            <input type="text" hidden name="id_donor" value="{{ $a->id_donor }}">
                                            <input type="text" hidden name="namadonor" value="{{ $a->namadonor }}">
                                        
                                            <input type="text" hidden name="antrian" value="{{ $a->id }}">
                                            <input type="text" hidden name="kode" value="{{ $a->nomor }}">
                                            <button type="submit" class="btn btn-sm btn-danger " ><i class='bx bx-skip-next' ></i> Lanjut</a>
                                            </form>
                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!--/ Accordion -->
    <div class="row">
        <div class="card" >
          <table id="hoteltable" border="1" class="table table-striped" >
                <thead>
                    <tr>
                        <th>Kd Cabang</th>
                        <th>No Donor</th>
                        <th>Pedonor</th>
                        <th>Tgl Daftar </th>
                        <th>TGL Lahir</th>
                        <th>jenis kelamin </th>
                        <th>Donor ke </th>
                        <th>Jns Ktg</th>
                        <th>Type Ktg</th>
                        <th>Brt bdn </th>
                        <th>Tolak </th>
                        <th>Alasan Tolak </th>
                        <th>No Apftp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                   
                    <tr class="" id="rowId">
                    
                    @forelse($join2 as $join2)
                        <td>{{$join2->kdcab}}</td>
                        <td>{{$join2->nodonor}}</td>
                        <td>{{$join2->namadonor}}</td>
                        <td>{{$join2->tgldaftar}}</td>
                        <td>{{$join2->tgllahir}}</td>
                        <td>{{$join2->jk}}</td>
                        <td>{{$join2->donorke}}</td>
                        <td>{{$join2->jnsktg}}</td>
                        <td>{{$join2->typektg}}</td>
                        <td>{{$join2->brtbdn}}</td>
                        <td>{{$join2->tolak}}</td>
                        <td >{{$join2->alsntlk}}</td>
                        <td>{{$join2->noaftp}}</td>
                                  
                        </tr>
                       
                       
                </tbody>
               
            </table>
        </div>
    </div>
    <br/>
    <form class="hotelaction"action="{{route('periksahb.store')}}" method="post" enctype="multipart/form-data" modelAttribute="hotel">
            @csrf
            @method('POST')
        <table>
            <tr>
            <td> <label class="col-form-label">No Donor</label> </td>
       
            <td> <input type="text" value="{{$join2->kdcab}}" id="kdcab" name="kdcab" class="form-control" readonly placeholder="kd cab"> </td>
                 <input type="hidden" id="tglperiksa" name="tglperiksa" value="{{$join2->tglperiksa}}">
                 <input type="hidden" id="tglhema" name="tglhema"  value="<?php echo date('Y-m-d H:i:s'); ?>">
                 <input type="hidden" id="tglaftap" name="tglaftap" value="{{$join2->tglaftap}}">
                 <input type="hidden" id="umur" name="umur" value="{{$join2->usia}}">
                 <input type="hidden" id="kelompokumur" name="kelompokumur" value="{{$join2->usia}}">
                 <input type="hidden" id="almsrt1" name="almsrt1" value="{{$join2->almt}}">
                 <input type="hidden" id="almsrt2" name="almsrt2" value="{{$join2->nmwil}}">
                 <input type="hidden" id="jnsdonor" name="jnsdonor" value="sukarela">
                 <input type="hidden" id="ckdasldrh" name="ckdasldrh" value="{{$join2->kdcab}}">
                 <input type="hidden" id="asaldrh" name="asaldrh" value="{{$join2->nmcab}}">
                 <input type="hidden" id="kdptgdr" name="kdptgdr" value="{{$join2->kdptgdr}}">
                 <input type="hidden" id="nmptgdr" name="nmptgdr" value="{{$join2->nmptgdr}}">
                 <input type="hidden" id="nmptghb" name="nmptghb" value="{{Auth::user()->name}}">
                 <input type="hidden" id="kdptghb" name="kdptghb" value="{{Auth::user()->id}}"   />
                
                 <input type="hidden" id="tensi" name="tensi" value="{{$join2->tensi}}">
                 <input type="hidden" id="nadi" name="nadi" value="{{$join2->nadi}}">
                 <input type="hidden" id="suhu" name="suhu" value="{{$join2->suhu}}">
                 <input type="hidden" id="ecg" name="ecg" value="{{$join2->ecg}}">
                 <input type="hidden" id="ccambil" name="ccambil" value="{{$join2->ccambil}}">
                 <input type="hidden" id="ketpriksa" name="ketpriksa" value="{{$join2->ketperiksa}}">
             
                 <td><input type="text" id="nodonor" name="nodonor" value="" class="form-control" readonly placeholder="no donor" ></td>
            <td><input type="text" id="namadonor" name="namadonor" value="" class="form-control" readonly placeholder="nama donor" ></td>
            <td><label class="col-form-label">Tgl Daftar</label></td>
            <td><input type="text" class="form-control" id="tgldaftar" name="tgldaftar" value="" readonly> </td>

            </tr>
            <tr>
            <td><label class="col-form-label">Tgl Lahir</label></td>
            <td><input type="text" class="form-control" id="tgllahir" name="tgllahir" value="" readonly> </td>
            <td> <label class="col-form-label">kelamin </label> </td>
            <td> <input type="text" class="form-control" id="jk" name="jk" value="" readonly ></td>
            <td><label class="col-form-label">DonorKe </label></td>
            <td><input type="text" class="form-control" id="donorke" name="donorke" value="" readonly style="width: 60px;"></td>
            
            </tr>
            <tr>
               
                <td>  <label class="col-form-label">Gol-Darah </label> </td>
                <td> <input type="text" class="form-control" id="goldarah" name="goldarah"  readonly  placeholder=""></td>
                <!-- <td> <input type="text" class="form-control" id="goldarah" name="goldarah" readonly placeholder="Positif"></td> -->
                <td><label class="col-form-label">Screening </label></td>
                <!-- <td><input type="text" class="form-control"  readonly placeholder="NEG"></td> -->
                <td><input type="text" class="form-control" id="screening" name="screening" readonly  placeholder="Negatif"></td>
                <td><label class="col-form-label">No.Pendaftaran </label></td>
                <td><input type="text" class="form-control" id="noaftap" name="noaftap" readonly  placeholder="Negatif"></td>
                
            </tr>
        </table>

    <div class="col-lg-12 col-md-12 order-1">
    <div class="row">
        <div class="col-lg-4 col-md-4 ">
        <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-joins-start justify-content-between">
            <div class="avatar flex-shrink-0">
               
            <img src="{{ asset('storage/captures/' .$join2->photo)}}" style="width: 130px; height:150px;" alt="" class="rounded">
           
            </div>
            &nbsp;&nbsp;  
            </div></br><br/><br/>
            <fieldset class="border p-2" style="width: 260px;">
                <legend  class="float-none w-auto p-4">Tolak</legend>
                <table>
                    <td> <input type="text" class="form-control" id="tolak" name="tolak"  readonly > </td>
                </table>
            </fieldset>
            <fieldset class="border p-2" style="width: 260px;">
                <legend  class="float-none w-auto p-4">Alasan Tolak</legend>
                <table>
                    <td> <input type="text" class="form-control" id="alsntlk" name="alsntlk" readonly > </td>
                </table>
            </fieldset>
        </div>
        </div>
    </div>
        <div class="col-lg-8 col-md-9 ">
            <div class="card">
                <div class="card-body">
                <div class="card-title d-flex align-joins-start justify-content-between">
        
                <fieldset class="border p-2" style="width: 690px;">
                    <legend  class="float-none w-auto p-4">Hasil Pemeriksaan</legend>
                    <table >
                        <tr>
                            <td> <label class="col-form-label">Gol Darah</label></td> 
                            <td>   <select class="form-select " name="goldar" id="goldar">
                                <option selected disabled>-- Pilih -- </option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select> </td>
                            <td>   
                            <select class="form-select " name="rhesus" id="rhesus">
                                <option selected disabled>-- Pilih --</option>
                                <option value="Positif">Positif</option>
                                <option value="Negatif">Negatif</option>
                            </select> 
                            </td>
                            <td> <label class="col-form-label">Jenis Kantong/ Type</label></td>
                            <td> <input type="text" class="form-control" id="jnsktg" name="jnsktg" value="" readonly  ></td>
                            <td> <input type="text" class="form-control" id="typektg" name="typektg" value="" readonly style="width:70px" ></td>
                        </tr>
                </table>
                    
                </fieldset>
            
                </div>
                
                
                <fieldset class="border p-2" style="width: 650px;">
                    <legend  class="float-none w-auto p-4">Metode Pemeriksaan</legend>
                    <table>
                    <tr>
                        <td> <label class="col-form-label">Berat Bdn</label> </td> 
                        <td> <input type="text" class="form-control" id="brtbdn" name="brtbdn" readonly> </td>
                        <td> <label class="col-form-label">Kg</label></td>
                        <td>  
                            <select class="form-select" id="metodehb" name="metodehb">
                                <option selected disabled>--Pilih Metode --</option>
                                <option value="Hb Meter" selected>Hb Meter </option>
                                <option value="Hb Cupri"> Hb Cupri </option>
                            </select> 
                        </td>
                        <td> <label class="col-form-label">Hb Meter</label> </td> 
                        <td> <input type="text" class="form-control" id="hasilhb" name="hasilhb"   placeholder="Hb Meter"> </td>
                        <td> <label class="col-form-label">gr/dL</label></td>
                    </tr>
                    <tr>
                        <td> <label class="col-form-label">Trombosit</label> </td> 
                        <td> <input type="number" class="form-control" id="tombosit" name="trombosit" value="0"  placeholder="0"> </td>
                        <td> <label class="col-form-label">Leokosit</label> </td> 
                        <td> <input type="number" class="form-control" id="leokosit" name="leokosit" value="0"   placeholder="0"> </td>
                        <td> <label class="col-form-label">Eritrosit</label> </td> 
                        <td> <input type="number" class="form-control" id="eritrosit" name="eritrosit" value="0"   placeholder="0"> </td>
                    </tr>
                    <tr>
                        <td> <label class="col-form-label">Hematocrit</label> </td> 
                        <td> <input type="number" class="form-control"  id="ht" name="ht" value="" placeholder="Hematocrit "> </td>
                        <td> <label class="col-form-label">%</label></td>
                    </tr>
                    <tr>
                        <td> <label class="col-form-label">Petugas Hb</label> </td> 
                        <td>  
                            <input type="text" disabled value="{{Auth::user()->name}}" class="form-control" name="nmptghb" id="nmptghb"  />
                        </td> 
                    </tr>
                </table>
                    
                </fieldset>
                <!-- <fieldset class="border p-2" style="width: 360px;">
                    <legend  class="float-none w-auto p-4">Pilih Lengan</legend>
                    <table>
                    <tr>
                        <td> <select class="form-select " name="mtd" style="width:270px">
                                <option selected disabled>--Pilih Metode --</option>
                                <option value="Kiri/Kanan " selected>Kiri/Kanan </option>
                                <option value="Kiri"> Kiri </option>
                                <option value="Kanan"> Kanan </option>
                                </select>  
                        </td>
                    </tr>
                    
                    </table>
                </fieldset> -->
                    <div class="mt-4 mb-2 text-end">
                        <button type="submit" class="btn btn-primary tombol-simpan" ><i class='bx bx-save' ></i> Simpan</button> 
                    </div>
            </div>
            </div>
        </div>

             @empty
                            <tr>
                              <td colspan="8" style="text-align: center;">Tidak ada data Pedonor Periksa.</td>
                            </tr>

                    @endforelse    
                </form>
            </div>
        <br/>    <br/>
</div>

<div class="row">        
    <div class="card">
         <input type="text" id="myInput" onkeyup="filtercoy()" placeholder="Cari data.."  style="position: absolute; right: 0;">
            <br/> <br/>
        <table id="myTable" class="table table-striped" style="width:100%">
             <thead>
                    <tr>
                        <th>Tgl Daftar</th>
                        <th>No Daftar</th>
                        <th>No Donor</th>
                        <th>Nama Donor </th>
                        <th>Metode HB </th>
                        <th>Hasil Hb </th>
                  
                    </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                 @foreach($datahb as $hb)
                    <tr>
                        <td>{{$hb->tgldaftar}}</td>
                        <td>{{$hb->noaftap}}</td>
                        <td>{{$hb->nodonor}}</td>
                        <td>{{$hb->namadonor}}</td>
                        <td>{{$hb->metodehb}}</td>
                        <td>{{$hb->hasilhb}}</td>

                    </tr>
                  @endforeach
                </tbody>
        </table>
    </div>
</div>









<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
function filtercoy() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (var i = 0; i < tr.length; i++) {
    var tds = tr[i].getElementsByTagName("td");
    var flag = false;
    for(var j = 0; j < tds.length; j++){
      var td = tds[j];
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        flag = true;
      } 
    }
    if(flag){
        tr[i].style.display = "";
    }
    else {
        tr[i].style.display = "none";
    }
  }
}
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

        Dropzone.options.fileUpload = {
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf", 
            init: function() {
                this.on("success", function(file, response) {
                    console.log("File uploaded successfully:", response);
                });
                this.on("error", function(file, response) {
                    console.error("Failed to upload file:", response);
                });
            }
        };

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
    form.querySelector("[name=tgldaftar]").value = row.cells[3].innerHTML;                  
    form.querySelector("[name=tgllahir]").value = row.cells[4].innerHTML;
    form.querySelector("[name=jk]").value = row.cells[5].innerHTML; 
    form.querySelector("[name=donorke]").value = row.cells[6].innerHTML;  
    form.querySelector("[name=jnsktg]").value = row.cells[7].innerHTML; 
    form.querySelector("[name=typektg]").value = row.cells[8].innerHTML;       
    form.querySelector("[name=brtbdn]").value = row.cells[9].innerHTML;                 
    form.querySelector("[name=tolak]").value = row.cells[10].innerHTML;  
    form.querySelector("[name=alsntlk]").value = row.cells[11].innerHTML; 
    form.querySelector("[name=noaftap]").value = row.cells[12].innerHTML; 



    // form.querySelector("[name=getiddonor]").value = row.cells[10].innerHTML;                 





    /*
    hideButton();
    showDelete();
    showEdit();
    */
});


       // Fungsi untuk memainkan suara
        function playSuara(nomor, tujuan,ruang) {
            const kalimat = "Nomor antrian " + nomor + ", Periksa," + tujuan + ", Ruang ," + ruang + "";
            const utterance = new SpeechSynthesisUtterance(kalimat);
            utterance.lang = 'id-ID';

            // Atur kecepatan (semakin kecil, semakin lambat)
            utterance.rate = 0.8; // 0.1 - 1.0 (normal = 1.0)
            // Cari suara laki-laki bahasa Indonesia
            const voices = window.speechSynthesis.getVoices();
            const voiceLaki = voices.find(v =>
                v.lang === 'id-ID' && v.name.toLowerCase().includes('male')
            );

            if (voiceLaki) {
                utterance.voice = voiceLaki;
            }

            speechSynthesis.speak(utterance);
        }

        // Pastikan suara dimuat dulu
        window.speechSynthesis.onvoiceschanged = function() {
            window.speechSynthesis.getVoices();
        };
        // Klik tombol
        $('#panggilBtn').on('click', function() {
            $.ajax({
                url: '{{ route("antri.panggil.hb") }}',
                method: 'GET',
                success: function(res) {
                        console.log(res);

                    if (res.status === 'sukses') {
                        const nomor = res.data.nomor;
                        const tujuan = res.data.tujuan;
                        const ruang = res.data.ruang;
                        $('#nomor').text(nomor);
                        playSuara(nomor,tujuan,ruang);
        location.reload();  // Reload halaman setelah beberapa detik

                    } else {
                        alert(res.message);
                    }
                },
                error: function(err) {
                    alert('Terjadi kesalahan');
                    console.error(err);
                }
            });
        });



    </script>

@endsection