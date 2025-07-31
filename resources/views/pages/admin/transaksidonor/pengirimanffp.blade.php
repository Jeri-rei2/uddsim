@extends('layouts.main')
@section('title', 'Aftap FFP')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 & jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    table.dataTable {
      width: 100% !important;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      align-items: flex-start; /* label di kiri */
      margin-bottom: 10px;
    }

    .form-group input {
      align-self: flex-end; /* input ke kanan */
      width: 200px;
    }
  </style>
 
@endpush

@section('content')

<div class="container" id="alldata">
   <div class="row">
    <h5 class="card-header">Aftap Pengiriman Darah (FPD)</h5>
    
        <br/>
         <table>
            <tr>
                    <th>No FPD: </th>
                    <td><input type="text" style="width:155px;" value="{{$nofpd}}" id="nofpd" name="nofpd" class="form-control" readonly></td>
                    <th>Tgl FPD:</th>
                    <td><input type="text" style="width:235px;" value="<?php  echo date('Y-m-d');?>" id="tglfpd" name="tglfpd" class="form-control" readonly></td> 
                    <td>  
                      <button type="btn" class="btn btn-warning" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                         <i class='bx  bx-search'></i>  Cari </button>
                              <!-- <button type="btn" class="btn btn-danger"><i class='bx  bx-printer'></i>  Cetak</button> -->
                             
                            </td>   
            </tr>
            <tr>
                    <th>Type Kantong:</th>
                    <td>
                     <select name="typektg" id="typektg" style="width:175px;" class="form-control" >
                        <option value="">-- Pilih --</option>
                        <option value="NAT">NAT</option>
                        <option value="Biasa">Biasa</option>
                    </select>
                    </td>
                    <th>Petugas Periksa:</th>
                    <td><input type="text" style="width:285px;"  value="{{Auth::user()->name}}" id="ptgs" name="ptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="{{Auth::user()->departmnt_id}}" id="idptgs" name="idptgs" class="form-control" readonly>
                    </td>  
                 

                    <th><input type="checkbox"  id="check-btn" name="ok" value="NAT"> NAT</th>

            </tr>
            <tr>
                    <th>ID Longger:</th>
                    <td><input type="text" style="width:215px;" value="" id="longger" name="longger" class="form-control" ></td>
                    <th>Suhu :</th>
                    <td><input type="text" style="width:285px;"  value="" id="suhu" name="suhu" class="form-control" ></td>  
                    <th><span>&deg;C</span></th>

            </tr>
             <tr>
                    <th>No Kantong:</th>
                    <td><input type="text" style="width:235px;" autofocus value="" id="nokantong" name="nokantong" class="form-control" placeholder="Scan No kantong.." ></td>
                    <th>No Selang:</th>
                    <td><input type="text" style="width:235px;"  value="" id="noselang" name="noselang" class="form-control" ></td>    
            </tr>
        </table>
        <br/>
         <fieldset class="border" style="width: 1110px;">
             <legend  class="float-none w-auto" style="font-size: 16px;">Detail Pedonor</legend>
                                                        
                <table>
                    <tr>
                        <th>No Donor:</th>
                        <td><input type="text" style="width:215px;"  value="" id="nodonor" name="nodonor" class="form-control" readonly>   </td>
                    </tr>
                    <tr>
                        <th>Nama Donor:</th>
                            <td><input type="text" style="width:255px;"  value="" id="namadonor" name="namadonor" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <th>Golongan Darah:</th>
                            <td><input type="text" style="width:255px;"  value="" id="goldar" name="goldar" class="form-control" readonly></td>
                        <th>Rhesus:</th>
                        <td><input type="text" style="width:255px;"  value="" id="rhesus" name="rhesus" class="form-control" readonly></td>
                    </tr> 
                    <tr>
                        <th>Jenis Kantong:</th>
                        <td><input type="text" style="width:255px;"  value="" id="jnskntng" name="jnskntng" class="form-control" readonly></td>
                        <th>Ukuran CC:</th>
                        <td>
                          <input type="text" style="width:255px;"  value="" id="cc" name="cc" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="jnsdnr" name="jnsdnr" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="kdcab" name="kdcab" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="ket" name="ket" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="noaftap" name="noaftap" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="tglaftap" name="tglaftap" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="nodonor" name="nodonor" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="namadonor" name="namadonor" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="ckdasldrh" name="ckdasldrh" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="asldrh" name="asldrh" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="tolak" name="tolak" class="form-control" readonly>
                          <input type="hidden" style="width:255px;"  value="" id="nokntng" name="nokntng" class="form-control" readonly>






                        
                        </td>
                    </tr>
                </table>

                     <div class="mt-4 mb-2 text-end" style="float: right;">
                       
                        <tr>
                            <th><label class="form-label" for="country" style="text-align: center" >Jumlah </label> &nbsp;</th>
                            <td> &nbsp;<input readonly style="float: right; width: 95px;" type="text" id="total" name="total" value="" class="form-control"  placeholder="" ></td>
                        </tr>
                     </div>
                </legend>
          </fieldset>
    
    
                     <div class="mt-4 mb-2 text-end" style="float: left;">
                         <tr>
                              <button type="btn" class="btn btn-success" id="kiriman"><i class='bx  bx-send'></i> Kirim FPD</button>
                              <button type="btn" class="btn btn-warning"><i class='bx  bx-loader'></i>  Load Data Hemoscale</button>
                              <button type="btn" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#AsaldrhModal"><i class='bx  bx-pen'></i>  Ubah Asal Darah</button>
                              <button type="btn" class="btn btn-primary" id="saveBtn"><i class='bx bxs-save'></i> Simpan</button>

                        </tr>
                     </div>
         <table class="table table-striped" id="result-table">
            <thead class="table-dark">
                <tr>
                    <th>No Kantong</th>
                    <th>Jns Kantong</th>
                    <th>No Donor</th>
                    <th>Nama Donor</th>
                    <th>Gol </th>
                    <th>Rhesus</th>
                    <th>Asal Darah Instansi </th>
                    <th>Tgl Aftap </th>
                    <th>NAT </th>
                    <th>Kirim</th>
                    <th>Jns Donor</th>
                    <th style="display:none">Jns Donor</th>
                    <th style="display:none">Jns Donor</th>
                    <th style="display:none">Jns Donor</th>

                    <th>Aksi</th>


                </tr>
            </thead>
            <tbody>
              <tr></tr>
                <!-- Data akan dimuat di sini dengan AJAX -->                  
            </tbody>
            
        </table>
         <input type="hidden" name="kirim[]" id="selectedUserIds" />
 



   </div>
<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pencarian Data Pedonor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari No Donor..">
        <br>
        <table class="table table-bordered" id="resultdata">
          <thead>
            <tr>
              
              <th>No FPD</th>
              <th>TGL FPD</th>
              <th>JML</th>
              <th>PTGS</th>
              <th>Type KTG</th>
              <th>Asal Darah</th>
              <th>Status Kirim </th>




            </tr>
          </thead>
          <tbody id="resultTable">
            <!-- Data hasil pencarian akan ditampilkan di sini -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div><!-- Modal -->

<!-- Modal ASAL DARAH -->
<div class="modal fade" id="AsaldrhModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Asal Darah </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
         <div class="mb-3">
            <label for="name" class="form-label">KODE ASAL DARAH</label>
            <input type="text" name="name" class="form-control" required>
          </div>
           <div class="mb-3">
            <label for="name" class="form-label">ASAL DARAH </label>
            <input type="text" name="name" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>



</div>

<script>


     document.getElementById('check-btn').addEventListener('click', function () {
            // Munculkan alert konfirmasi
            var result = confirm("Apakah Kantong NAT ? Klik OK Jika Kantong NAT, Cancel Jika Bukan NAT.");

            if (result) {
                // Jika user klik OK (Yes)
                document.getElementById('typektg').value = 'NAT';
                alert("Pilihan Kantong NAT Selesai.");
            } else {
                // Jika user klik Cancel (No)
                document.getElementById('typektg').value = 'Biasa';
                alert("Pilihan Bukan Kantong NAT Selesai.");
            }
        });
  let scannedItems = [];
    let totalQty = 0;
      
   // Event listener untuk menangkap input perubahan barcode
    $('#nokantong').on('change', function() {
        var barcode = $(this).val();
          // Ambil semua checkbox yang dicentang
        var barcode = document.getElementById('nokantong').value.trim();
        var qty = 1;
        if (!barcode || isNaN(qty) || qty <= 0) {
            alert("Isi barcode dan jumlah dengan benar!");
            return;
          }
        // Hitung jumlah yang dicentang
        // Kirim data barcode ke server untuk disimpan
        $.ajax({
            url: '{{ route("scan.ffp") }}',
            method: 'POST',
            data: {
                barcode: barcode,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                 $('#nokantong').val('');
                if(response.success) {
               // Cek duplikat
                    if (scannedItems.find(item => item.nokntng === response.data.nokntng)) {
                        alert('No Kantong sudah discan');
                               // Kalau sudah, update qty-nya saja
                      scannedItems[barcode].qty += qty;

                    } else {
                      let tglfpd = document.getElementById('tglfpd').value;
                      // let total = document.getElementById('total').value;
                      let nofpd = document.getElementById('nofpd').value;
                      let suh =  document.getElementById('suhu').value;
                      let ket = document.getElementById('ket').value = 'ANTIBODY';
                      let ptgs = document.getElementById('ptgs').value;
 
                 
                      // Simpan ke array sementara
                 
                      // Update total qty
                        totalQty += qty;
                  

                      let total = document.getElementById('total').value = totalQty;
                      let typektg =  document.getElementById('typektg').value;
                      let longger = document.getElementById('longger').value;
                      let idptgs = document.getElementById('idptgs').value;

                      
                      let nokantong = document.getElementById('nokantong').focus();

                        scannedItems.push({
                            total: total,
                            nofpd: nofpd,
                            tglfpd: tglfpd,
                            ket: ket,
                            ptgs:ptgs,
                            suhu: suh,
                            idptgs: idptgs,
                            typektg: typektg,
                            longger: longger,
                            nokntng: response.data.nokntng,
                            jnskntng: response.data.jnskntng,
                            nodonor: response.data.nodonor,
                            namadonor: response.data.namadonor,
                            goldar: response.data.goldar,
                            rhesus: response.data.rhesus,
                            asldrh: response.data.nmcab,
                            jnsdnr: response.data.jnsdnr,
                            kdcab: response.data.kdcab,
                            noaftap: response.data.noaftap,
                            tglaftap: response.data.tglaftap,
                            // ckdasldrh: response.data.ckdasldrh,
                          
                            // goldar: response.data.goldar
                            // rhesus: response.data.rhesus,
                            tolak: response.data.tolak,
                            // jml: jml,
                            // barcode, qty,

                        });
                        $('#noaftap value').append( document.getElementById("noaftap").value = `${response.data.noaftap}`);
                        $('#tglaftap value').append( document.getElementById("tglaftap").value = `${response.data.tglaftap}`);
                        $('#nodonor value').append( document.getElementById("nodonor").value = `${response.data.nodonor}`);
                        $('#nokntng value').append( document.getElementById("nokntng").value = `${response.data.nokntng}`);

                        $('#namadonor value').append( document.getElementById("namadonor").value = `${response.data.namadonor}`);
                        $('#ckdasldrh value').append( document.getElementById("ckdasldrh").value = `${response.data.kdcab}`);
                        $('#asldrh value').append( document.getElementById("asldrh").value = `${response.data.nmcab}`);
                         $('#goldar value').append( document.getElementById("goldar").value = `${response.data.goldar}`);
                        $('#rhesus value').append( document.getElementById("rhesus").value = `${response.data.rhesus}`);
                        $('#tolak value').append( document.getElementById("tolak").value = `${response.data.tolak}`);


                        $('#kdcab value').append( document.getElementById("kdcab").value = `${response.data.kdcab}`);
                    
                        $('#jnskntng value').append( document.getElementById("jnskntng").value = `${response.data.jnskntng}`);
                        $('#cc value').append( document.getElementById("cc").value = `${response.data.ccamb}`);
                        $('#jnsdnr value').append( document.getElementById("jnsdnr").value = `${response.data.jnsdnr}`);



                        // $('#ukuran value').append( document.getElementById("ukuran").value = `${response.data.ukuran}`);

                          let aksi = '';

                          if (response.data.nodonor === response.data.nodonor) {
                              aksi = '<span class="badge bg-label-danger me-1">Waiting..</span> ';
                          } else {
                              aksi = '<span class="badge bg-label-success me-1">Completed</span> ';
                          }


                        $('#result-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${response.data.nokntng}</td>
                                <td >${response.data.jnskntng}</td>
                                <td >${response.data.nodonor}</td>
                                <td >${response.data.namadonor}</td>
                                <td >${response.data.goldar}</td>
                                <td >${response.data.rhesus}</td>
                                <td >${response.data.nmcab}</td>
                                <td >${response.data.tglaftap}</td>
                                <td ><input type="checkbox"  id="statusck" name="ok" value="NAT" readonly> </td>
                                <td>
                                    ${aksi}
                                  </td>
                                <td >${response.data.jnsdnr}</td>
                     

                                
                               
                            </tr>
                        `);
                    }// Menambahkan baris baru di awal tabel
                    //  <td ><button class="btn btn-danger btn-sm removeBtn">Hapus</button></td>
                } else {
                    alert(response.message);  // Jika barcode sudah ada
                }
                  $('#nokantong').val('').focus();
            },
            error: function() {
                alert('Error scanning barcode');
            }
        });
    });
     // Hapus dari tabel
    $(document).on('click', '.removeBtn', function () {
        let row = $(this).closest('tr');
        let kode = row.data('nokntng');

        scannedItems = scannedItems.filter(item => item.nokntng !== kode);
        row.remove();
    });


$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
         $('#searchInput').on('keyup', function() {
        let keyword = $(this).val();

        if (keyword.length > 2) {
            $.get("{{ route('view.index') }}", { keyword: keyword }, function(data) {
                let rows = '';
                data.forEach(p => {
                    let kirim = '';
                    let total = p.length;
                 
                 console.log(p);
                          if (p.status == 'Waiting') {
                              kirim = '<span class="badge bg-label-danger me-1">Belum Kirim..</span> ';
                          } else {
                              kirim = '<span class="badge bg-label-success me-1">Completed</span> ';
                          }
                    rows += `
                        <tr>
                            <td>${p.nofpd}</td>
                            <td>${p.tglfpd}</td>
                            <td>${p.urut}</td>
                            <td>${p.ckdptgs}</td>
                            <td>${p.totals}</td>
                            <td>${total}</td>
                            <td>${kirim}</td>
                            <td><button type="button" class="btn btn-sm btn-primary" id="pilih" data-kode="${p.id}" data-nofpd="${p.nofpd}"
                                data-namadonor="${p.namadonor}" data-goldar="${p.goldar}"data-rhesus="${p.rhesus}" data-asldrh="${p.asldrh}" 
                                data-nokntng="${p.nokntng}"data-jnskntng="${p.jnskntng}" data-nodonor="${p.nodonor}" 
                                data-tglaftap="${p.tglaftap}" data-nat="${p.xx}" data-jnsdonor="${p.jnsdonor}" data-suhu="${p.suhu}"
                                data-id_logger="${p.id_logger}"
                                >Pilih</button></td>
                        </tr>`;
                });
                $('#resultTable').html(rows);
            });
        } else {
            $('#resultTable').empty();
        }
    });
});



     let selectedData = [];


    // Ketika tombol "Pilih" diklik
    $(document).on('click', '.select-product', function() {
        const name = $(this).data('name');
        const total = $(this).data('total');

        let newRow = `<tr>
                        <td>${name}</td>
                        <td>${total}</td>
                    </tr>`;
        $('#result-table tbody').append(newRow);

        // Tutup modal
        $('#AsaldrhModal').modal('hide');
    });
});






$(document).on('click', '#pilih', function() {
    let kode = $(this).data('kode');
    let nofpd = $(this).data('nofpd');
    let goldar = $(this).data('goldar');
    let namadonor = $(this).data('namadonor');

    let nokntng = $(this).data('nokntng');
    let jnskntng = $(this).data('jnskntng');
    let nodonor = $(this).data('nodonor');
    let rhesus = $(this).data('rhesus');
    let asldrh = $(this).data('asldrh');
    let tglaftap = $(this).data('tglaftap');
    let nat = $(this).data('nat');
    let jnsdonor = $(this).data('jnsdonor');
    let kirim = $(this).data('kirim');
    let suhu = $(this).data('suhu');
    let id_logger = $(this).data('id_logger');



    const id = $(this).data('kode');
    const baseUrl = "{{url('/') }}"; 
    const auth = window.AuthUser;
    const url = `${auth.name}`;
    console.log(nofpd);


    let row = `
        <tr>
            <td><input type="hidden" name="nokntng[]" value="${nokntng}">${nokntng}</td>
            <td><input type="hidden" name="jnskntng[]" value="${jnskntng}">${jnskntng}</td>
            <td><input type="hidden" name="nodonor[]" value="${nodonor}">${nodonor}</td>
            <td><input type="hidden" name="namadonor[]" value="${namadonor}">${namadonor}</td>
            <td><input type="hidden" name="goldar[]" value="${goldar}">${goldar}</td>
            <td><input type="hidden" name="rhesus[]" value="${rhesus}">${rhesus}</td>
            <td><input type="hidden" name="asldrh[]" value="${asldrh}">${asldrh}</td>
            <td><input type="hidden" name="tglaftap[]" value="${tglaftap}">${tglaftap}</td>
            <td><input type="hidden" name="nat[]" value="${nat}">${nat}</td>
            <td><input type="hidden" name="kirim[]" value="kirim">Belum kirim</td>

            <td><input type="hidden" name="jnsdonor[]" value="${jnsdonor}">${jnsdonor}</td>


            <td style="display:none"><input type="hidden" name="suhu[]" value="${suhu}"></td>
            <td style="display:none"><input type="hidden" name="nofpd[]" value="${nofpd}"></td>
            <td style="display:none"><input type="hidden" name="id_logger[]" value="${id_logger}"></td>




            <td>
                <button class="hapus">Hapus</button>
                <a href="${baseUrl}/${url}/cetak-fpd/${id}"target="_blank" style="width:80px;" class="btn btn-info btnView" type="btn" style="width:170px; colors: yellow">
                 <i class="bx bx-printer"></i> Cetak  </a>
            </td>
       
        </tr>
    `;

    $('#result-table tbody').append(row);
});

$(document).on('click', '.hapus', function() {
    $(this).closest('tr').remove();
});


 // Simpan via AJAX
    $('#kiriman').on('click', function () {
        // if (selectedUsers.length === 0) {
        //     alert('Pilih data terlebih dahulu!');
        //     return;
        // }
          let items = [];

            $('#result-table tbody tr').each(function() {
                    let kode = $(this).find('input[name="kode[]"]').val();
                    let nofpd = $(this).find('input[name="nofpd[]"]').val();
                    let goldar = $(this).find('input[name="goldar[]"]').val();
                    let namadonor = $(this).find('input[name="namadonor[]"]').val();
                    let nokntng = $(this).find('input[name="nokntng[]"]').val();
                    let jnskntng = $(this).find('input[name="jnskntng[]"]').val();
                    let nodonor = $(this).find('input[name="nodonor[]"]').val();
                    let rhesus = $(this).find('input[name="rhesus[]"]').val();
                    let asldrh = $(this).find('input[name="asldrh[]"]').val();
                    let tglaftap = $(this).find('input[name="tglaftap[]"]').val();
                    let nat = $(this).find('input[name="nat[]"]').val();
                    let jnsdonor = $(this).find('input[name="jnsdonor[]"]').val();
                    let kirim = $(this).find('input[name="kirim[]"]').val();
                    let suhu = $(this).find('input[name="suhu[]"]').val();
                    let id_logger = $(this).find('input[name="id_logger[]"]').val();

                items.push({ kode: kode,
                             nofpd: nofpd, 
                             goldar: goldar,
                             namadonor: namadonor,
                             nokntng: nokntng,
                             jnskntng: jnskntng,
                             nodonor: nodonor,
                             tglaftap: tglaftap,
                             jnsdonor: jnsdonor,
                             nat: nat,
                             suhu: suhu,
                             id_logger: id_logger,
                             });
            });



        $.ajax({
            url: "{{ route('kirimbos') }}",
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                kirim: items,
            },
            success: function (response) {
                console.log(response);
                // alert(response.message);
            if (response.status === 'success') {
                Swal.fire({
                     toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'FPD Berhasil dikirim',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                }).then(() => {
                    // Optional: reset form / reload / redirect
                    // $('#form-tambah')[0].reset();
                    // location.reload(); // jika ingin reload
                    selectedUsers = [];
                    $('#resultTable tbody').empty();
                });
            }
                
            },
            error: function () {
                alert('Terjadi kesalahan saat menyimpan.');
            }
        });
    });





$('#saveBtn').click(function () {
          
        if (scannedItems.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
        $.ajax({
                    url: '{{ route("saveh") }}',
                    method: 'POST',
                    data: {
                        // items: scannedItems,
                        item: scannedItems,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(res) {
                        // alert(res.message);
                        // if (res.success === 'success') {
                                Swal.fire({
                                    toast: true,
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Berhasil disimpan',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true
                                }).then(() => {
                                     console.log('save: ',res);
                            scannedItems = [];
                            $('#result-table tbody').empty();
                            // $('#nofpd').val('');
                            // $('#tglfpd').val('');
                            $('#typektg').val('');
                            // $('#ptgs').val('');
                            $('#longger').val('');
                            $('#suhu').val('');
                            $('#nokantong').val('');
                            $('#noselang').val('');
                            $('#nodonor').val('');
                            $('#namadonor').val('');
                            $('#goldar').val('');
                            $('#rhesus').val('');
                            $('#jnskntng').val('');
                            $('#cc').val('');
                            $('#total').val('');
                                });
                           
                            // alert(res.message);
                         

                              setTimeout(function () {
                              location.reload();
                            }, 1000);
                       
                          // Clear semua checkbox
                          // document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);

                                // }
                        },
                });
    });



</script>
<script>
          window.AuthUser = @json(Auth::user());

</script>


@endsection