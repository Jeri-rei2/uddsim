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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>

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

.custom-modal {
  max-width: 900px;
}

  </style>
 
@endpush

@section('content')

<div class="container" id="alldata">
   <div class="row">
     <h5 class="card-header">Penyisihan Kantong (Rusak)</h5>

     <table>
            <tr>
                    <th>No Transaksi: </th>
                    <td><input type="text" style="width:155px;" value="{{$nokeluar}}" id="notrans" name="notrans" data-keluar="{{$nokeluar}}" class="form-control" readonly></td>
                    <th><button type="btn" class="btn btn-warning" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                         <i class='bx  bx-search'></i>  Cari </button></th>
                    <th>Tanggal:</th>
                    <td><input type="text" style="width:235px;" value="<?php  echo date('Y-m-d');?>" id="tgltrans" name="tgltrans" class="form-control" readonly></td> 
                    
            </tr>
            <tr>
                    <th>No Kantong: </th>
                    <td><input type="text" style="width:235px;" value="" id="nokantong" name="nokantong" class="form-control"></td> 
                 
                    <th>No LOt:</th>
                    <td><input type="text" style="width:285px;"  value="" id="nolot" name="nolot" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="{{Auth::user()->departmnt_id}}" id="idptgs" name="idptgs" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="merk" name="merk" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="ukktg" name="ukktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="jnsktg" name="jnsktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="noktg" name="noktg" class="form-control" readonly>
                        <input type="hidden" style="width:285px;"  value="" id="perk" name="perk" class="form-control" readonly>   
                        <!-- <input type="hidden" style="width:285px;"  value="" id="alasan" name="alasan" class="form-control" readonly>            -->

                    
                    </td>  
                    <!-- <th>No Selang:</th>
                    <td></td>  -->
            </tr>
            <tr>
                    <!-- <th>Alasan Rusak: </th>
                    <td>
                      

                    </td>  -->
            </tr>
      </table>
      <div class="mt-4 mb-2 text-end" style="float: left;">
                  <tr>
                      <button type="btn" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCetak" id="laporan"><i class='bx  bx-book'></i>Laporan</button>
                      <button type="btn" class="btn btn-primary" id="saveBtn"><i class='bx bxs-save'></i> Simpan</button>

                </tr>
            </div>
                      <div class="card">
                       <table id="result-table" class="display table table-bordered  table-info" >
                          <thead>
                              <tr>
                                  <th>No Kantong</th>
                                  <th>Merk</th>
                                  <th>Jenis Kantong</th>
                                  <th>Ukuran</th>
                                  <th>Jumlah </th>
                                  <th>Keterangan</th>
                                  <th>No Selang</th>
                                  <th>No Lot</th>

                              </tr>
                          </thead>
                          <tbody >
                              <?php $i=1; ?>                
                              <tr>

                              </tr>
                          </tbody>
                       </table>
                          <div class="mt-4 mb-2 text-end" style="float: right;">
                              
                                        <tr>
                                            <th><label class="form-label" for="country" style="text-align: center" >Jumlah </label> &nbsp;</th>
                                            <td> &nbsp;<input readonly style="float: right; width: 95px;" type="text" id="jml" name="jml" value="" class="form-control"  placeholder="" ></td>
                                        
                                        </tr>
                               
                                </div>
                     </div>
               <!-- Modal -->
                <div class="modal fade" id="modalCetak" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5>Filter Tanggal Cetak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <label>Tanggal Awal</label>
                        <input type="date" id="start_date" class="form-control">
                        <label>Tanggal Akhir</label>
                        <input type="date" id="end_date" class="form-control">
                      </div>
                      <div class="modal-footer">
                        <button id="btnCetak" class="btn btn-secondary"><i class='bx  bx-printer'></i> Cetak</button>
                      </div>
                    </div>
                  </div>
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
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari No Kembali..">
                        <br>
                        <table class="table table-bordered" id="userTable">
                          <thead>
                            <tr>
                              
                              <!-- <th>No Transaksi</th> -->
                              <th>Merk</th>
                              <th>ukuran </th>
                              <th>jns kantong</th>
                              <th>No Kantong</th>
                              <th>Jumlah</th>
                              <th>Alasan Rusak </th>
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



   </div>
</div>





<script>
$('#btnCetak').click(function() {
    let start = $('#start_date').val();
    let end = $('#end_date').val();

    if (!start || !end) {
        alert('Harap isi kedua tanggal.');
        return;
    }

    // Kirim ke controller untuk buat URL cetak
    $.ajax({
        url: "{{ route('data.prosesCetak') }}",
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            start_date: start,
            end_date: end
        },
        success: function(res) {
            $('#modalCetak').modal('hide');
            window.open(res.url, '_blank'); // Buka halaman cetak di tab baru
        },
        error: function() {
            alert('Gagal memproses cetak.');
        }
    });
});


$(document).ready(function() {
  $('#userTable').on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        if (confirm("Yakin ingin menghapus data ini?")) {
            $.ajax({
                url: '{{ route("hapusrusak", ":id") }}'.replace(':id', id),
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





    // Klik tombol Edit
    $('#userTable').on('click', '.btn-edit', function() {
        var row = $(this).closest('tr');
        var merk = row.find('.merk').text().trim();
        var ukktg = row.find('.ukktg').text().trim();
        var nokntng = row.find('.nokntng').text().trim();
        var alasan_rusak = row.find('.alasan_rusak').text().trim();


        // Ganti isi <td> dengan input field
        row.find('.merk').html(`<input type="text" style="width: 80px;" class="input-merk" value="${merk}">`);
        row.find('.ukktg').html(`<input type="text"style="width: 80px;" class="input-ukktg" value="${ukktg}">`);
        row.find('.nokntng').html(`<input type="text"style="width: 80px;" class="input-nokntng" value="${nokntng}">`);
        row.find('.alasan_rusak').html(`<input type="text"style="width: 90px;" class="input-alasan_rusak" value="${alasan_rusak}">`);

        row.find('.btn-edit').hide();
        row.find('.btn-save').show();
    });

    // Klik tombol Save
    $('#userTable').on('click', '.btn-save', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var merk = row.find('.input-merk').val();
        var ukktg = row.find('.input-ukktg').val();
        var nokntng = row.find('.input-nokntng').val();
        var alasan_rusak = row.find('.input-alasan_rusak').val();

        $.ajax({
            url: '{{ route("data.update", ":id") }}'.replace(':id', id),
            type: 'PUT',
            data: {
                merk: merk,
                ukktg: ukktg,
                nokntng: nokntng,
                alasan_rusak: alasan_rusak,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Replace input with updated text
                row.find('.merk').html(merk);
                row.find('.ukktg').html(ukktg);
                row.find('.nokntng').html(nokntng);
                row.find('.alasan_rusak').html(alasan_rusak);


                row.find('.btn-edit').show();
                row.find('.btn-save').hide();
            },
            error: function(xhr) {
                alert('Gagal update data');
            }
        });
    });
});





 $('#searchInput').on('keyup', function() {
         $('#searchInput').on('keyup', function() {
        let keyword = $(this).val();

        if (keyword.length > 2) {
            $.get("{{ route('datasisih') }}", { keyword: keyword }, function(data) {
                let rows = '';
                data.forEach(p => {
                    let kirim = '';
                    let total = p.length;
                 
                 console.log(p);
                       
                    rows += `
                        <tr data-id="${p.id}">
                        
                            <td class="merk">${p.merk}</td>
                            <td class="ukktg">${p.ukktg}</td>
                            <td class="jnsktg">${p.jnsktg}</td>
                            <td class="nokntng">${p.nokntng}</td>
                            <td class="xx">${p.xx}</td>
                            <td class="alasan_rusak">${p.alasan_rusak}</td>
                            <td>   <button class="btn-edit">Edit</button>
                                   <button class="btn-delete" data-id="${p.id}">Hapus</button>
                                    <button class="btn-save" style="display:none; width: 50px;">Save</button>
                                    <button class="btn-cancel" style="display:none;">Batal</button>
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
            url: '{{ route("cariktgrusak") }}',
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
                     
                      let notrans = document.getElementById('notrans').value.trim();
        
                      // Simpan ke array sementara
                 
                      // Update total qty
                        totalQty += qty;
                  
                      let nolot = document.getElementById('nolot').value = `${response.data.nolot}`;
                      let total = document.getElementById('jml').value = totalQty;
                      let aksi = `  <select class="form-control select2" name="rusak" id="rusak">
                            <option value="pilih" >Pilih Alasan</option>
                            @foreach ($alasan as $user)
                                <option value="{{ $user->nama }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>`;
                      let noselang = '<input type="text" style="width:235px;" value="" id="noselang" name="noselang" class="form-control" > ';
                      let jml = '1';
                      let prk = '250';

                      
                   
                      
                    //   let nokantong = document.getElementById('nokantong').focus();

                        scannedItems.push({
                    
                            notrans: notrans,
                            nolot: response.data.nolot,
                            jml: total,
                            nokntng: response.data.noktg,
                            merk: response.data.merk,
                            ukktg: response.data.ukktg,
                            jnsktg: response.data.jnsktg,
                            xx: jml,
                            // alasan: alasanrusak,
                            perk: prk,
                            // stokaftap: response.data.realstokaftap,
                  

                        });
                        $('#merk value').append( document.getElementById("merk").value = `${response.data.merk}`);
                        $('#ukktg value').append( document.getElementById("ukktg").value = `${response.data.ukktg}`);
                        $('#jnsktg value').append( document.getElementById("jnsktg").value = `${response.data.jnsktg}`);
                        $('#noktg value').append( document.getElementById("noktg").value = `${response.data.noktg}`);
                        $('#perk value').append( document.getElementById("perk").value = `${response.data.perk}`);
                        $('#nolot value').append( document.getElementById("nolot").value = `${response.data.nolot}`);


                        $('#result-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${response.data.noktg}</td>
                                <td >${response.data.merk}</td>
                                <td >${response.data.jnsktg}</td>
                                <td >${response.data.ukktg}</td>
                                <td >${jml}</td>
                                <td >${aksi}</td>
                                <td >${noselang}</td>
                                <td >${response.data.nolot}</td>          
                               
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
 
    //  var jml_ktg = parseFloat(document.getElementById('jml').value.trim()) || 0 ;
    // var stokaftap = parseFloat(document.getElementById('notrans').value.trim()) || 0;
    var tgltrans = document.getElementById('tgltrans').value.trim();
     var notrans = document.getElementById('notrans').value.trim();
     var rusak = document.getElementById('rusak').value.trim();
     var noselang = document.getElementById('noselang').value.trim();



    // var total = jml_ktg + stokaftap;
      // Tampilkan hasil total
    // var hasil = document.getElementById('hasilhitung').value = total;
          
        if (scannedItems.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
        $.ajax({
                    url: '{{ route("saverusak") }}',
                    method: 'POST',
                    data: {
                        // items: scannedItems,
                        item: scannedItems,
                        rusak: rusak,
                        noselang:noselang,
                        tgltrans: tgltrans,
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


</script>

@endsection 