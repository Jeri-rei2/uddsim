@extends('layouts.main')
@section('title', 'Serologi')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- SweetAlert2 & jQuery -->
  <style>
     body {
      font-family: Arial, sans-serif;
    }

    .header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    label {
      font-weight: bold;
    }

    input, select {
      padding: 4px;
    }

    .buttons {
      margin-top: 10px;
    }

    button {
      padding: 6px 12px;
      margin-right: 5px;
      cursor: pointer;
    }

    .panel {
      display: flex;
      justify-content: space-between;
      background-color: #eaeaea;
      padding: 10px;
      margin-bottom: 10px;
    }

    .panel button {
      background-color: #dcdcdc;
      border: 1px solid #aaa;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 6px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .highlight {
      background-color: #ff00ff;
      color: white;
      padding: 10px;
      font-weight: bold;
    }
  </style>
@endpush

@section('content')
 <div class="container">
     <h5 class="card-header">Pemeriksaan Golongan Darah </h5>
      <div class="header">
    <label for="noperiksa">Nomor Periksa:</label>
    <input type="text" id="noperiksa" value="{{$noperiksa}}" readonly>

    <label for="tglperiksa">Tgl Periksa:</label>
    <input type="date" id="tglperiksa" value="<?php  echo date('Y-m-d');?>" readonly>

    <label for="petugasPeriksa">Petugas Periksa:</label>
    <input type="text" id="kdptgs" style="width: 80px;">
    <input type="text" id="nmptgs" style="color:red;" readonly>
     <p id="message" style=" font-size: 10px; color:red;"></p>
    <input type="hidden" id="nodonor" name="nodonor" readonly>
    <input type="hidden" id="goldar" name="goldar" readonly>
    <input type="hidden" id="rhesus" name="rhesus" readonly>
    <input type="hidden" id="asldrh" name="asldrh" readonly>
    <input type="hidden" id="kdcab" name="kdcab" readonly>


    <button data-bs-toggle="modal" data-bs-target="#searchModal"style="width: 92px; height: 35px;" >Cari <i class='bx  bx-search'></i></button>
  </div>

  <div class="panel">
    <div>
      <button onclick="cetakSample()">Cetak Sample Darah Harian</button>
      <button onclick="copyToScreening()">COPY TO SCREENING</button>
    </div>
    <div>
      <!-- <button>Batal [F9]</button>
      <button>Tambah [F5]</button> -->
       <label for="petugasPeriksa">No Kantong:</label>
       <input type="text" id="nokantong" name="nokantong" autofocus>
      <button id="saveBtn"><i class='bx bxs-save'></i> Simpan</button>
    </div>
    <div class="highlight">KELUAR</div>
  </div>

  <div class="table-container">
    <table id="result-table">
      <thead>
        <tr>
          <th>No.</th>
          <th>No Kantong</th>
          <th>No Donor</th>
          <th>Nama Donor</th>
          <th>Tgl Lahir</th>
          <th>Gol</th>
          <th>Rhesus</th>
          <th>Gol Baru</th>
          <th>Rh Baru</th>
          <th>Asal Darah Instansi</th>
          <th>GOL &lt;LIS&gt;</th>
          <th>RH &lt;LIS&gt;</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data bisa dimasukkan di sini -->
        <tr>
        
        </tr>
      </tbody>
    </table>
  </div>
    <!-- Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" >
                  <div class="modal-dialog modal-lg" style="witdh: 1550px;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Pencarian Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari No Periksa..">
                        <br>
                        <table class="table table-bordered" id="main-table">
                          <thead>
                            <tr>
                              
                              <!-- <th>No Transaksi</th> -->
                              <th>No Periksa</th>
                              <th>Tgl Periksa </th>
                              <th>Petugas</th>
                              <th>Jumlah</th>
                              <th>Asal Darah</th>
                              <!-- <th>Alasan Rusak </th> -->
                              <th>aksi</th>
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

  <script>
       $(document).ready(function () {
            $('#kdptgs').on('input', function () {
                let kode = $(this).val();

                if (kode.length > 0) {
                    $.ajax({
                        url: "{{ route('search.ptgs') }}",
                        type: "POST",
                        data: {
                            kdptgs: kode,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            $('#nmptgs').val(response.NamaPetugas);
                            $('#message').text('');
                        },
                        error: function () {
                            $('#nmptgs').val('');
                            $('#message').text('Petugas tidak ditemukan.');
                        }
                    });
                } else {
                    $('#nmptgs').val('');
                    $('#message').text('');
                }
            });
        });

    function cetakSample() {
      alert('Fungsi cetak sample dijalankan.');
    }

    function copyToScreening() {
      alert('Data disalin ke screening.');
    }



      let scannedItems = [];
    let totalQty = 0;
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
            url: '{{ route("cariktgdrh") }}',
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
                      // scannedItems[barcode].qty += qty;

                    } else {
                     
                      let noperiksa = document.getElementById('noperiksa').value.trim();
              
                 
                      // Update total qty
                        totalQty += qty;
           

                        scannedItems.push({

                            kdcab: response.data.kdcab,
                            // nmptgs: nmptgs,
                            nokntng: response.data.nokntng,
                            noperiksa: noperiksa,
                            nodonor: response.data.nodonor,
                            goldar: response.data.goldr,
                            rhesus: response.data.rhesus,
                            asldrh: response.data.asldrh,
                    
                  

                        });
                        $('#kdcab value').append( document.getElementById("kdcab").value = `${response.data.kdcab}`);
                        $('#nodonor value').append( document.getElementById("nodonor").value = `${response.data.nodonor}`);
                        $('#goldar value').append( document.getElementById("goldar").value = `${response.data.goldr}`);
                        $('#rhesus value').append( document.getElementById("rhesus").value = `${response.data.rhesus}`);
                        $('#asldrh value').append( document.getElementById("asldrh").value = `${response.data.asldrh}`);

               
                        let no = 1;
                        $('#result-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${no++}</td>
                                <td >${response.data.nokntng}</td>
                                <td >${response.data.nodonor}</td>
                                <td >${response.data.namadonor}</td>
                                <td >${response.data.tgllahir}</td>
                                <td style="background-color:Orange;"><span style="color: black;">${response.data.goldr}</span></td>
                                <td style="background-color:Orange;"><span style="color: black;">${response.data.rhesus}</span> </td>
                                <td ></td>
                                <td ></td>          
                                <td >${response.data.asldrh}</td>          
                                <td style="background-color:MediumSeaGreen;"></td>          
                                <td style="background-color:MediumSeaGreen;"></td>          
                                <td ></td>          
                               
                            </tr>
                        `);
                    }// Menambahkan baris baru di awal tabel
                  
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

$('#saveBtn').click(function () {
    var tglperiksa = document.getElementById('tglperiksa').value.trim();
     var noperiksa = document.getElementById('noperiksa').value.trim();
     var kdptgs = document.getElementById('kdptgs').value.trim();
     var nmptgs = document.getElementById('nmptgs').value.trim();



    // var total = jml_ktg + stokaftap;
      // Tampilkan hasil total
    // var hasil = document.getElementById('hasilhitung').value = total;
          
        if (scannedItems.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
        $.ajax({
                    url: '{{ route("saveawal") }}',
                    method: 'POST',
                    data: {
                        // items: scannedItems,
                        item: scannedItems,
                        kdptgs: kdptgs,
                        nmptgs: nmptgs,
                        noperiksa:noperiksa,
                        tglperiksa: tglperiksa,
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
  $(document).ready(function () {
            // Ambil data dari server dan isi Tabel A
            $.ajax({
                url: "{{ route('datainput') }}",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let rows = '';
                    data.users.forEach(user => {
                        rows += `
                            <tr data-id="${user.id}" 
                              data-NoKantong="${user.NoKantong}" data-Noperiksa="${user.Noperiksa}" data-Tglperiksa="${user.Tglperiksa}" 
                              data-ckdptgs="${user.ckdptgs}" 
                              data-namadonor="${user.namadonor}">
                                <td>${user.Noperiksa}</td>
                                <td>${user.Tglperiksa}</td>
                                <td>${user.ckdptgs}</td>
                                <td>${user.jumlah}</td>
                                <td></td>
                                <td>${user.status}</td>

                            </tr>
                        `;
                    });
                    $('#main-table tbody').append(rows);

                        // Tampilkan Orders
                    let orderRows = '';
                    data.data.forEach(function (order) {
                        orderRows += `
                            <tr data-id="${order.id}" data-NoKantong="${order.NoKantong}"data-nodonor="${user.nodonor}" 
                                 data-namadonor="${user.namadonor}">
                                <td>${order.id}</td>
                                <td>${order.NoKantong}</td>
                                <td>${order.nodonor}</td>
                                <td>${order.namadonor}</td>

                            </tr>`;
                    });
                    $('#main-table tbody').append(orderRows);
                },
                error: function () {
                    alert('Gagal memuat data JSON.');
                }
            });
              

            // Tangkap klik pada baris tabel dan parsing ke Tabel B
            $(document).on('click', '#main-table tbody tr', function () {
                let id = $(this).data('id');
                let NoKantong = $(this).data('NoKantong');
                let nodonor = $(this).data('nodonor');
                let namadonor = $(this).data('namadonor');
                let Noperiksa = $(this).data('Noperiksa');
                let Tglperiksa = $(this).data('Tglperiksa');
                let ckdptgs = $(this).data('ckdptgs');


                let row = `
                    <tr>
                        <td>${id}</td>
                        <td>${NoKantong}</td>
                        <td>${nodonor}</td>
                        <td>${namadonor}</td>

                    </tr>
                `;

                // Tambahkan ke tabel B
                $('#result-table tbody').html(row);
            });
        });



  </script>
 </div>



@endsection