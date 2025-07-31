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
     <h5 class="card-header">Pengembalian Kantong Ke Aftap</h5>
    
         <table>
            <tr>
                    <th>No Kembali: </th>
                    <td><input type="text" style="width:155px;" value="{{$nokeluar}}" id="nokeluar" name="nokeluar" data-keluar="{{$nokeluar}}" class="form-control" readonly></td>
                    <th><button type="btn" class="btn btn-warning" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                         <i class='bx  bx-search'></i>  Cari </button></th>
                    <th>Tgl Kembali:</th>
                    <td><input type="text" style="width:235px;" value="<?php  echo date('Y-m-d');?>" id="tglkembali" name="tglkembali" class="form-control" readonly></td> 
                    <td>  
                
                            </td>   
            </tr>
            <tr>
                 
                    <th>Petugas Terima:</th>
                    <td><input type="text" style="width:285px;"  value="{{Auth::user()->name}}" id="ptgs" name="ptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="{{Auth::user()->departmnt_id}}" id="idptgs" name="idptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="merkktg" name="merkktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="ukktg" name="ukktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="jnsktg" name="jnsktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="noktg" name="noktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="typestok" name="typestok" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="stokaftap" name="stokaftap" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="hasilhitung" name="hasilhitung" class="form-control" readonly>             
                    
                    </td>  
            </tr>
        
             <tr>
                    <th>No Kantong:</th>
                    <td><input type="text" style="width:235px;" autofocus value="" id="nokantong" name="nokantong" class="form-control" placeholder="Scan No kantong.." ></td>
                    <th>   <button style="display: none;" type="btn" class="btn btn-warning" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                         <i class='bx  bx-search'></i>  Cari </button></th>
                    <th>Jumlah :</th>
                    <td> 
                      <input type="number" style="width:215px;" value="" id="jml" name="jml" class="form-control" onchange="updateInput()">
                    </td>     
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
            <div class="mt-4 mb-2 text-end" style="float: left;">
                         <tr>
                              <!-- <button type="btn" class="btn btn-success" id="cetak"><i class='bx  bx-printer'></i> Cetak</button> -->
                              <button type="btn" class="btn btn-primary" id="saveBtn"><i class='bx bxs-save'></i> Simpan</button>

                        </tr>
            </div>
                <table class="table table-striped" id="result-table">
                    <thead class="table-dark">
                        <tr>
                            <th>No Kantong</th>
                            <th>Merk Kantong</th>
                            <th>Jenis Kantong</th>
                            <th>Ukuran</th>
                            <th>Jml </th>
                            <th>Status</th>
                            <!-- <th>Aksi</th> -->


                        </tr>
                    </thead>
                    <tbody>
                      <tr></tr>
                        <!-- Data akan dimuat di sini dengan AJAX -->                  
                    </tbody>
                </table>
            
    </div>
        <!-- Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Pencarian Pengembalian Kantong Ke Aftap</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari No Kembali..">
                        <br>
                        <table class="table table-bordered" id="resultdata">
                          <thead>
                            <tr>
                              
                              <th>No Kembali</th>
                              <th>Merk</th>
                              <th>ukuran </th>
                              <th>jns kantong</th>
                              <th>No Kantong</th>
                              <th>Jumlah</th>
                              <th>Status Kantong </th>
                              <th style="display: none;">aksi</th>




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
</div>


<script>

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
            url: '{{ route("scan.balik") }}',
            method: 'POST',
            data: {
                barcode: barcode,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                 $('#nokantong').val('');
                if(response.success) {
               // Cek duplikat
                    if (scannedItems.find(item => item.noktg === response.data.noktg)) {
                        alert('No Kantong sudah discan');
                               // Kalau sudah, update qty-nya saja
                      scannedItems[barcode].qty += qty;

                    } else {
                     
                      let kembali = document.getElementById('nokeluar').value.trim();
                      let tglkembali = document.getElementById('tglkembali').value.trim();
        
                      // Simpan ke array sementara
                 
                      // Update total qty
                        totalQty += qty;
                  

                      let total = document.getElementById('jml').value = totalQty;
                   
                      
                    //   let nokantong = document.getElementById('nokantong').focus();

                        scannedItems.push({
                    
                            nokembali: kembali,
                            // typestok: response.data.type_stok,
                            jml_kembali: total,
                            merk: response.data.merk,
                            ukktg: response.data.ukktg,
                            jnsktg: response.data.jnsktg,
                            noktg: response.data.noktg,
                            tglkembali: tglkembali,
                            stokaftap: response.data.realstokaftap,
                  

                        });
                        $('#merkktg value').append( document.getElementById("merkktg").value = `${response.data.merk}`);
                        $('#ukktg value').append( document.getElementById("ukktg").value = `${response.data.ukktg}`);
                        $('#jnsktg value').append( document.getElementById("jnsktg").value = `${response.data.jnsktg}`);
                        $('#noktg value').append( document.getElementById("noktg").value = `${response.data.noktg}`);

                        $('#stokaftap value').append( document.getElementById("stokaftap").value = `${response.data.realstokaftap}`);



                      let aksi = '<span class="badge bg-label-danger me-1">Retur Kantong</span> ';
                      let jml = '1';
                    

                        $('#result-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${response.data.noktg}</td>
                                <td >${response.data.merk}</td>
                                <td >${response.data.jnsktg}</td>
                                <td >${response.data.ukktg}</td>
                                <td >${jml}</td>
                                <td >${aksi}</td>
                      
                               
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

$('#saveBtn').click(function () {
 
     var jml_ktg = parseFloat(document.getElementById('jml').value.trim()) || 0 ;
    var stokaftap = parseFloat(document.getElementById('stokaftap').value.trim()) || 0;
    var tglkembali = document.getElementById('tglkembali').value.trim();

    var total = jml_ktg + stokaftap;
      // Tampilkan hasil total
    var hasil = document.getElementById('hasilhitung').value = total;
          
        if (scannedItems.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
        $.ajax({
                    url: '{{ route("savekembali") }}',
                    method: 'POST',
                    data: {
                        // items: scannedItems,
                        item: scannedItems,
                        hasil: hasil,
                        tglkembali: tglkembali,
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

  $('#searchInput').on('keyup', function() {
         $('#searchInput').on('keyup', function() {
        let keyword = $(this).val();

        if (keyword.length > 2) {
            $.get("{{ route('datakembali') }}", { keyword: keyword }, function(data) {
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
                            <td>${p.nokembali}</td>
                            <td>${p.merk}</td>
                            <td>${p.ukktg}</td>
                            <td>${p.jnsktg}</td>
                            <td>${p.noktg}</td>
                            <td>${p.jml_kembali}</td>
                            <td>${p.status}</td>
                            <td style="display:none;"><button type="button" class="btn btn-sm btn-primary" id="pilih" data-kode="${p.id}" data-nopengeluaran="${p.nopengeluaran}"
                                data-merk="${p.merk}" data-ukktg="${p.ukktg}"data-jnsktg="${p.jnsktg}" data-noktg="${p.noktg}" 
                                data-status="${p.status}"data-jml_kembali="${p.jml_kembali}" data-stokaftap="${p.stokaftap}" 
                                data-typestok="${p.typestok}" >Pilih</button></td>
                        </tr>`;
                });
                $('#resultTable').html(rows);
            });
        } else {
            $('#resultTable').empty();
        }
    });
});
$(document).on('click', '#pilih', function() {
    let nokembali = $(this).data('nokembali');
    let kode = $(this).data('kode');
  

    let noktg = $(this).data('noktg');
    let jnsktg = $(this).data('jnsktg');
    let merk = $(this).data('merk');
    let ukktg = $(this).data('ukktg');
    let status = $(this).data('status');
    let jml_kembali = $(this).data('jml_kembali');
    let stokaftap = $(this).data('stokaftap');
 



    const id = $(this).data('kode');
    const baseUrl = "{{url('/') }}"; 
    const auth = window.AuthUser;
    const url = `${auth.name}`;
    console.log(nokembali);


    let row = `
        <tr>
            <td><input type="hidden" name="noktg[]" value="${noktg}">${noktg}</td>
            <td><input type="hidden" name="merk[]" value="${merk}">${merk}</td>
            <td><input type="hidden" name="jnsktg[]" value="${jnsktg}">${jnsktg}</td>
            <td><input type="hidden" name="ukktg[]" value="${ukktg}">${ukktg}</td>
            <td><input type="hidden" name="jml_kembali[]" value="${jml_kembali}">${jml_kembali}</td>
            <td><input type="hidden" name="status[]" value="${status}">${status}</td>

            <td>
                <button class="hapus">Hapus</button>
                <a href="${baseUrl}/${url}/cetak-kembali/${id}" style="display:none;"   target="_blank" style="width:80px;" class="btn btn-info btnView" type="btn" style="width:170px; colors: yellow">
                 <i class="bx bx-printer"></i> Cetak  </a>
            </td>
       
        </tr>
    `;

    $('#result-table tbody').append(row);
});

$(document).on('click', '.hapus', function() {
    $(this).closest('tr').remove();
});


</script>




@endsection