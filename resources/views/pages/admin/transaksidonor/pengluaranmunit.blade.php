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
     <h5 class="card-header">Pengeluran Kantong (MU)</h5>
    
 <table>
            <tr>
                    <th>No Pengeluaran: </th>
                    <td><input type="text" style="width:155px;" value="{{$nokeluar}}" id="nokeluar" name="nokeluar" data-keluar="{{$nokeluar}}" class="form-control" readonly></td>
                    <th><button type="btn" class="btn btn-warning" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                         <i class='bx  bx-search'></i>  Cari </button></th>
                    <th>Tgl Pengeluaran:</th>
                    <td><input type="text" style="width:235px;" value="<?php  echo date('Y-m-d');?>" id="tglfpd" name="tglfpd" class="form-control" readonly></td> 
                    <td>  
                
                            </td>   
            </tr>
            <tr>
                    <th>Asal Darah:</th>
                    <td>
                       <input type="text" style="width:185px;"  value="" id="cariasldrh" name="cariasldrh" class="form-control">
                    </td>
                    <th id="hasil">   
                    </th>
                    <th>Petugas Terima:</th>
                    <td><input type="text" style="width:285px;"  value="{{Auth::user()->name}}" id="ptgs" name="ptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="{{Auth::user()->departmnt_id}}" id="idptgs" name="idptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="merkktg" name="merkktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="ukktg" name="ukktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="jnsktg" name="jnsktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="nokntng" name="nokntng" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="typestok" name="typestok" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="stokaftap" name="stokaftap" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="hasilhitung" name="hasilhitung" class="form-control" readonly>



                    
                    
                    </td>  
                 

            </tr>
            <tr>
                    <th>Mobile Unit:</th>
                    <td><input type="text" style="width:215px;" value="" id="carimu" name="carimu" class="form-control" ></td>
                    <th id="hasil2"></th>
                    <th>Kode Laptop :</th>
                    <td><input type="text" style="width:215px;" value="" id="kdlaptop" name="kdlaptop" class="form-control" ></td>
                 

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
                        <h5 class="modal-title">Pencarian Keluar Kantong Ke MU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari No Pengeluaran..">
                        <br>
                        <table class="table table-bordered" id="resultdata">
                          <thead>
                            <tr>
                              
                              <th>No pengeluaran</th>
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


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateInput() {
    const val = parseFloat(document.getElementById('jml').value) || 0 ;
    const val2 = parseFloat(document.getElementById('stokaftap').value) || 0;

    const total = val + val2;
      // Tampilkan hasil total
    document.getElementById('hasilhitung').value = total;

  }

 $(document).ready(function () {
            $('#cariasldrh').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                html += `<input type="text" style="width:185px;"  value="${item.nmasldrh}" id="nmdrh" name="nmdrh" class="form-control" readonly>`; // Sesuaikan field-nya
                            });
                        } else {
                            html = '<p>Data tidak ditemukan</p>';
                        }

                        $('#hasil').html(html);
                    }
                });
            });
  });
 $(document).ready(function () {
            $('#carimu').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('searchmu') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                html += `<input type="text" style="width:185px;"  value="${item.merek}" id="nmmu" name="nmmu" class="form-control" readonly>`; // Sesuaikan field-nya
                            });
                        } else {
                            html = '<p>Data tidak ditemukan</p>';
                        }

                        $('#hasil2').html(html);
                    }
                });
            });
  });
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
            url: '{{ route("scan.keluar") }}',
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
                     
                      let keluar = document.getElementById('nokeluar').value.trim();
                      let asaldarah = document.getElementById('nmdrh').value.trim();
                      let mu = document.getElementById('nmmu').value.trim();
                      let ptgs = document.getElementById('ptgs').value.trim();
                      let kdlaptop = document.getElementById('kdlaptop').value.trim();
                      let hasilhitung = document.getElementById('hasilhitung').value.trim();




              

 
                 
                      // Simpan ke array sementara
                 
                      // Update total qty
                        totalQty += qty;
                  

                      let total = document.getElementById('jml').value = totalQty;
                   
                      
                      let nokantong = document.getElementById('nokantong').focus();

                        scannedItems.push({
                    
                            nokeluar: keluar,
                            typestok: response.data.type_stok,
                            jml_ktg: total,
                            merkktg: response.data.merkktg,
                            ukktg: response.data.ukuran,
                            jnsktg: response.data.jnskntng,
                            nokntng: response.data.nokntng,
                            stokaftap: response.data.stok,
                            asldrh: asaldarah,
                            kdmobil: mu,
                            petugas: ptgs,
                            kodenotebook: kdlaptop,
                            hasilhitung: hasilhitung,
                            // barcode, qty,

                        });
                        $('#nokeluar value').append( document.getElementById("nokeluar").value = `${keluar}`);
                        $('#merkktg value').append( document.getElementById("merkktg").value = `${response.data.merkktg}`);
                        $('#ukktg value').append( document.getElementById("ukktg").value = `${response.data.ukuran}`);
                        $('#jnsktg value').append( document.getElementById("jnsktg").value = `${response.data.jnskntng}`);
                        $('#nokntng value').append( document.getElementById("nokntng").value = `${response.data.nokntng}`);
                        $('#typestok value').append( document.getElementById("typestok").value = `${response.data.type_stok}`);

                        $('#stokaftap value').append( document.getElementById("stokaftap").value = `${response.data.stok}`);



                      let aksi = '<span class="badge bg-label-success me-1">Mobile Unit</span> ';
                      let jml = '1';
                    

                        $('#result-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${response.data.nokntng}</td>
                                <td >${response.data.merkktg}</td>
                                <td >${response.data.jnskntng}</td>
                                <td >${response.data.ukuran}</td>
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

    var total = jml_ktg + stokaftap;
      // Tampilkan hasil total
    var hasil = document.getElementById('hasilhitung').value = total;
          
        if (scannedItems.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
        $.ajax({
                    url: '{{ route("sv") }}',
                    method: 'POST',
                    data: {
                        // items: scannedItems,
                        item: scannedItems,
                        hasil: hasil,
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

  $('#resultdata').on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        if (confirm("Yakin ingin menghapus data ini?")) {
            $.ajax({
                url: '{{ route("hapukeluar", ":id") }}'.replace(':id', id),
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        // $('#post-' + id).remove(); // Hapus baris dari tabel
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan saat menghapus data.");
                }
            });
        }
      });


    $('#searchInput').on('keyup', function() {
         $('#searchInput').on('keyup', function() {
        let keyword = $(this).val();

        if (keyword.length > 2) {
            $.get("{{ route('lihatdtkeluar') }}", { keyword: keyword }, function(data) {
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
                            <td>${p.nopengeluaran}</td>
                            <td>${p.merk}</td>
                            <td>${p.ukktg}</td>
                            <td>${p.jnsktg}</td>
                            <td>${p.noktg}</td>
                            <td>${p.jml_ktg}</td>
                            <td>${p.status}</td>
                            <td><button type="button" class="btn btn-sm btn-primary" id="pilih" data-kode="${p.id}" data-nopengeluaran="${p.nopengeluaran}"
                                data-merk="${p.merk}" data-ukktg="${p.ukktg}"data-jnsktg="${p.jnsktg}" data-noktg="${p.noktg}" 
                                data-status="${p.status}"data-jml_ktg="${p.jml_ktg}" data-stokaftap="${p.stokaftap}" 
                                data-typestok="${p.typestok}" >Pilih</button>
                               <button class="btn-delete" data-id="${p.id}">Hapus</button>
                                
                            </td>
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
    let nopengeluaran = $(this).data('nopengeluaran');
    let kode = $(this).data('kode');
  

    let noktg = $(this).data('noktg');
    let jnsktg = $(this).data('jnsktg');
    let merk = $(this).data('merk');
    let ukktg = $(this).data('ukktg');
    let status = $(this).data('status');
    let jml_ktg = $(this).data('jml_ktg');
    let stokaftap = $(this).data('stokaftap');
 



    const id = $(this).data('kode');
    const baseUrl = "{{url('/') }}"; 
    const auth = window.AuthUser;
    const url = `${auth.name}`;
    console.log(nopengeluaran);


    let row = `
        <tr>
            <td><input type="hidden" name="noktg[]" value="${noktg}">${noktg}</td>
            <td><input type="hidden" name="merk[]" value="${merk}">${merk}</td>
            <td><input type="hidden" name="jnsktg[]" value="${jnsktg}">${jnsktg}</td>
            <td><input type="hidden" name="ukktg[]" value="${ukktg}">${ukktg}</td>
            <td><input type="hidden" name="jml_ktg[]" value="${jml_ktg}">${jml_ktg}</td>
            <td><input type="hidden" name="status[]" value="${status}">${status}</td>

            <td>
                <button class="btn btn-danger hapus">Hapus baris</button>
                <a href="${baseUrl}/${url}/cetak-keluarktg/${id}"target="_blank" style="width:80px;" class="btn btn-info btnView" type="btn" style="width:170px; colors: yellow">
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


<script>
          window.AuthUser = @json(Auth::user());

</script>











@endsection