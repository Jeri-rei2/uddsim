@extends('layouts.main')
@section('title', 'Gudang')

@push('custom-css')
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <style>
      .barcode-container {
      display: inline-block;
      text-align: center;
    }
    .barcode-labels {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin-top: 5px;
    }
    .barcode {
  display: none;
}
       .separator {
      width: 100%;
      height: 2px;
      background-color: black;
      margin: 30px 0;
    }
    .barcode-labels span {
      width: 48%;
    }

    #konten {
      display: none; /* Awalnya disembunyikan */
      background-color: lightblue;
      padding: 10px;
      margin-top: 10px;
    }
    .dataTables_empty {
  display: none;
}
 .card-container {
      display: flex;
      gap: 30px;
    }

    .card {
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .card h3 {
      margin-top: 0;
    }
  </style>
@endpush

@section('content')
  <ul class="navbar-nav flex-row align-items-center ms-auto">
        @php
            $notifs = auth()->user()->unreadNotifications;
        @endphp    
      <li>
          
        <button class="dropdown-item" onclick="toggleDisplay()">
          <span class="d-flex align-items-center align-middle">
            <i class="bx bx-bell"></i>
            <span class="flex-grow-1 align-middle"></span>
            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">{{ $notifs->count() }}</span>
          </span>
        </button>
      </li>
                     
  </ul>
<div class="container" >
    <div class="row">
        <h5 class="card-header">Pengeluaran Kantong</h5>
          <div class="mb-2 col-md-3">
              <label for="almtsrt" class="form-label">No Transaksi</label>
              <input readonly class="form-control"type="text"id="notrans"name="notrans"value="{{$notrans}} " />
            </div>
          <div class="mb-2 col-md-4">
              <label for="lastName" class="form-label">Tanggal Transaksi </label>
              <input class="form-control"type="text" id="tglminta" name="tglminta" value="<?php echo date('Y-m-d');?>" />
          </div>
          <div class="mb-2 col-md-6">
            <label for="lastName" class="form-label">Petugas </label>
            <input class="form-control"type="text" id="kdptgs" name="kdptgs" value="{{Auth::user()->name}}" readonly/>
          </div>
          <div class="mb-2 col-md-6">
            <label for="lastName" class="form-label">No Minta </label>
            <input class="form-control"type="text" id="nominta" name="nominta" value="" autofocus/>
          </div>
          <div class="mb-2 col-md-6">
            <label for="lastName" class="form-label">Scan No Kantong</label>
            <!-- <input class="form-control"type="text" id="tglminta" name="tglminta" value="" /> -->
             <input type="text" id="search-input" name="search-input"autofocus   class="form-control" placeholder="scan disini..." autofocus style="display: none;"> 
          </div>
    </div>
    <div class="row">
          <div class="mb-2 col-md-6">
            <fieldset class="border" style="width: 560px;">
              <legend  class="float-none w-auto p-4" style="font-size: 18px;">Pilih Jenis Darah</legend>
                <table id="tbdata" class="display table table-bordered  table-info">
                  <thead>
                      <tr>
                          <!-- <th>No</th> -->
                          <th>Jenis Kantong</th>
                          <th>Ukuran</th>
                          <th>Jumlah </th>
                          <th>Tgl Minta </th>
                          <th><input type="checkbox" id="check-all"> Sts</th>
                          <!-- <th>Aksi</th> -->
                      </tr>
                  </thead>
                  <tbody id="bodytdata">
                      <?php $i=1; ?>                
                      <tr>

                      </tr>
                  </tbody>
                </table>
            </fieldset>
          </div>
        <div class="mb-2 col-md-6">
                <fieldset class="border" style="width: 550px;">
                    <legend  class="float-none w-auto p-4" style="font-size: 18px;">Jenis Darah Dikirim</legend>
                      <table id="tableview" class="display table table-bordered  table-info">
                        <thead>
                            <tr>
                                <td> Merk: </td>
                                <td>
                                  <input class="form-control"type="text" id="merk" name="merk" value="" style="width: 89px"/>
                                </td>
                            </tr>
                            <tr>
                                  <td> Jns Ukuran Cc: </td>
                                  <td>
                                    <input class="form-control"type="text" id="ukktg" name="ukktg" value="" style="width: 89px"/>
                                  </td>
                              </tr>
                              <tr>
                                  <td> Jml MInta: </td>
                                  <td> 
                                    <input class="form-control"type="text" id="jml" name="jml" value="" style="width: 89px"/>
                                  </td>
                                  <td>Dilayani: </td>
                                  <td>
                                    <input class="form-control"type="text" id="dilayani" name="dilayani" value="" style="width: 89px"/>
                                  </td>
                              </tr>
                                  <td> Sudah Diberikan: </td>
                                  <td>
                                    <input class="form-control"type="text" id="dibri" name="dibri" value="" style="width: 89px"/>
                                  </td>
                                  <td>Total: </td>
                                  <td>
                                    <input class="form-control"type="text" id="total"  value=""style="width: 89px" />
                                    <!-- <span id="total"name="total" style="width: 89px" >0</span> -->
                                  </td>
                              </tr>
                              <tr>
                                <td> Jumlah Diberi: </td>
                                <td>
                                  <input class="form-control"type="number" id="jmldiberi" name="jmldiberi" value="" style="width: 89px"/>
                                </td>
                                 <td><button id="saveBtn" class="btn btn-danger" type="submit" style="width:89px; colors: yellow" >
                                    <i class='bx bx-save'></i> Simpan </button> </td>
                                  <!-- <td><button class="btn btn-info" type="btn" style="width:89px; colors: yellow" >
                                    <i class='bx  bx-printer'></i>  Cetak </button> </td> -->
                            </tr>
                        </thead>
                      
                      </table>
                </fieldset>
          </div>
     </div>

</div>
<br/>
<br/>
<br/>
  <div class="card-container">
          <div class="card">
                <div class="row">
                      <table border="1" id="items-table"style="width:100%" class="display table table-bordered  table-success">
                          <thead style="width:100%">
                              <tr>
                                  <th>No Kantong</th>
                                  <th>Jenis Kantong</th>
                                  <th>Ukuran</th>
                                  <th>Merk </th>
                                  <th>Keterangan</th>
                                  <th>NO LOT</th>
                                  <th>Type Ktg</th>

                                  <!-- <th>Aksi</th> -->
                              </tr>
                          </thead>
                          <tbody >
                          
                          </tbody>  
                      </table>
                </div>
          </div>
          <div class="card">
  <div class="row">
            <h5 class="card-header">Hasil Scan Kantong</h5>
            <div class="card" style="width: 190px;">
              <table id="tableview2" class="display table table-bordered  table-info" >
                <thead>
                    <tr>
                        <th>Merk</th>
                        <th>Jenis Kantong</th>
                        <th>No Kantong</th>

                        <th>Ukuran</th>
                        <th>Jumlah Diberi</th>
                        <th>Keterangan</th>
                        
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php $i=1; ?> 
                    @foreach($kirim as $data)
                      <tr>
                        <td style="width: 90px;">{{$data->mrkkntng}}</td>
                        <td style="width: 90px;">{{$data->jnskntng}}</td>
                        <td style="width: 90px;">{{$data->nokntng}}</td>
                        <td style="width: 90px;">{{$data->ukuran}}</td>
                        <td style="width: 90px;">{{$data->perk}}</td>
                        <td style="width: 90px;">{{$data->ket}}</td>

                        <td style="width: 90px;"> <a href="{{route('pengiriman.cetak', $data->id)}}" style="width:80px;" class="btn btn-info btnView" data-id="{{ $data->id }}" type="btn" style="width:170px; colors: yellow" >
                              <i class="bx bx-printer"></i> Cetak </button></td>
                    </tr>
          
                      @endforeach               
                  
                </tbody>
              </table>
            </div>
  </div>
</div>
  </div>






<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#items-table').DataTable({
               responsive: true,
              //  autoWidth: false,// penting agar tidak override lebar kolom
                scrollX: true,
                autoWidth: false,
                searching: false,
                language: {
                    emptyTable: "" // kosongkan stringnya
                  }
          });
     
        // $('#searchBox').on('keyup', function () {
        //     table.search(this.value).draw();
        // });
    });
$(document).ready(function() {
    $('#tableview2').DataTable({
               responsive: true,
              //  autoWidth: false,// penting agar tidak override lebar kolom
                scrollX: true,
                autoWidth: false,
                language: {
                    emptyTable: "" // kosongkan stringnya
                  }
          });
     
        // $('#searchBox').on('keyup', function () {
        //     table.search(this.value).draw();
        // });
    });

  function toggleDisplay() {
    var konten = document.getElementById("konten");
    if (konten.style.display === "none" || konten.style.display === "") {
      konten.style.display = "block";
    } else {
      konten.style.display = "none";
    }
  }
let selectedIds = [];

    function fetchData(keyword = '') {
        const notrans = document.getElementById('notrans').value;
        $.get('{{ route("data.search") }}', { keyword: keyword }, function (data) {
            let html = '';
            selectedIds = []; // Reset

            if (data.length === 0) {
                html = '<tr><td colspan="3">Data tidak ditemukan</td></tr>';
            } else {
                data.forEach(p => {
                    html += `
                        <tr>
                            <td><input type="text" id="jnsktg[]" name="jnsktg[]" value="${p.jnsktg}" readonly required style="width: 89px"></td>
                            <td><input type="text" id="ukktg[]" name="ukktg[]" value="${p.ukktg}" readonly required style="width: 89px"></td>
                            <td><input type="text" id="jumlah[]" name="jumlah[]" value="${p.jumlah}" readonly required style="width: 89px"></td> 
                            <td><input type="text" id="tglminta[]" name="tglminta[]" value="${p.tglminta}" readonly required style="width: 89px"></td> 
                            <td><input type="checkbox" id="cek[]" name="cek[]" class="row-check" data-id="${p.id}" ${p.pilih ? 'checked' : ''}></td>
                            <td style="display: none;"><input type="text" id="notrans[]" name="notrans[]" value="${notrans}" readonly required></td> 
                            <td style="display: none;"><input type="text" id="nominta[]" name="nominta[]" value="${p.notrans}" readonly required></td> 

                        </tr>
                    `;
                    if (p.pilih) {
                        selectedIds.push(p.id);
                    }
                });
            }

            $('#tbdata tbody').html(html);
        });
    }

    // Initial load
    // fetchData();

    // Live search
    $('#nominta').on('keyup', function () {
        let keyword = $(this).val();
        fetchData(keyword);
    });

    // Update promo status when a checkbox is clicked
    $(document).on('change', '.row-check', function () {
        const id = parseInt($(this).data('id'));
        const checked = $(this).is(':checked');
        let jnsktg = document.getElementsByName('jnsktg[]');
        let ukktg = document.getElementsByName('ukktg[]');
        let jumlah = document.getElementsByName('jumlah[]');
        let tglminta = document.getElementsByName('tglminta[]');
        let notrans = document.getElementsByName('notrans[]');
        let nominta = document.getElementsByName('nominta[]');

        if (checked) {
            if (!selectedIds.includes(id)) {
                selectedIds.push(id);
            }
        } else {
            selectedIds = selectedIds.filter(i => i !== id);
        }
          let data = [];
        for (let i = 0; i < jnsktg.length; i++) {
            data.push({
                jnsktg: jnsktg[i].value,
                ukktg: ukktg[i].value,
                jumlah: jumlah[i].value,
                notrans: notrans[i].value,
                nominta: nominta[i].value,
                tglminta: tglminta[i].value,

            });
            
        }


        $.ajax({
            url: '{{ route("gd.updateStatus") }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ids: data,
                iclik: selectedIds,
                value: 1
            },
            
            success: function (res) {
                console.log('Status diperbarui');
                alert('data berhasil di Approve');

              $('#merk value').append( document.getElementById("merk").value = `${res.data.merk}`);
              $('#ukktg value').append( document.getElementById("ukktg").value = `${res.data.ukktg}`);
              $('#jml value').append( document.getElementById("jml").value = `${res.data.jumlah}`);
              $('#search-input value').append(document.getElementById('search-input').style.display = 'block' );

            },
            error: () => alert('Gagal update data')
        });
    });




    let scannedItems = [];
    let totalQty = 0;
      
   // Event listener untuk menangkap input perubahan barcode
    $('#search-input').on('change', function() {
        var barcode = $(this).val();
          // Ambil semua checkbox yang dicentang
        var barcode = document.getElementById('search-input').value.trim();
        var qty = 1;
        if (!barcode || isNaN(qty) || qty <= 0) {
            alert("Isi barcode dan jumlah dengan benar!");
            return;
          }
        // Hitung jumlah yang dicentang
        // Kirim data barcode ke server untuk disimpan
        $.ajax({
            url: '{{ route("scan.kirim") }}',
            method: 'POST',
            data: {
                barcode: barcode,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                 $('#search-input').val('');
                if(response.success) {
               // Cek duplikat
                    if (scannedItems.find(item => item.nokntng === response.data.nokntng)) {
                        alert('No Kantong sudah discan');
                               // Kalau sudah, update qty-nya saja
                      scannedItems[barcode].qty += qty;

                    } else {
                      let notrans = document.getElementById('notrans').value;
                      let total = document.getElementById('total').value;
                      let kdptgs = document.getElementById('kdptgs').value;
                      let nominta = document.getElementById('nominta').value;
                      let jml = document.getElementById('jml').value;
 
                 
                      // Simpan ke array sementara
                 
                      // Update total qty
                        totalQty += qty;
                  

                      document.getElementById('total').value = totalQty;
                      document.getElementById('dibri').value = totalQty;
                      document.getElementById('dilayani').value = totalQty;
                      document.getElementById('jmldiberi').value = totalQty;
                      
                      document.getElementById('search-input').focus();

                        scannedItems.push({
                            nokntng: response.data.nokntng,
                            mrkkntng: response.data.mrkkntng,
                            jnskntng: response.data.jnskntng,
                            typekntng: response.data.typekntng,
                            ukuran: response.data.ukuran,
                            nolot: response.data.nolot,
                            notrans: notrans,
                            total: total,
                            kdptgs: kdptgs,
                            nominta: nominta,
                            jml: jml,
                            barcode, qty,

                        });

                        // $('#nolot value').append( document.getElementById("nolot").value = `${response.data.nolot}`);
                        // $('#mrkkntng value').append( document.getElementById("mrkkntng").value = `${response.data.mrkkntng}`);
                        // $('#jnskntng value').append( document.getElementById("jnskntng").value = `${response.data.jnskntng}`);
                        // $('#typekntng value').append( document.getElementById("typekntng").value = `${response.data.typekntng}`);
                        // $('#ukuran value').append( document.getElementById("ukuran").value = `${response.data.ukuran}`);

                        $('#items-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td >${response.data.nokntng}</td>
                                <td >${response.data.jnskntng}</td>
                                <td >${response.data.ukuran}</td>
                                <td >${response.data.mrkkntng}</td>
                                <td >Sudah Di Approve</td>
                                <td >${response.data.nolot}</td>
                                <td >${response.data.typekntng}</td>

                                <td ><button class="btn btn-danger btn-sm removeBtn">Hapus</button></td>
                            </tr>
                        `);
                    }// Menambahkan baris baru di awal tabel
                } else {
                    alert(response.message);  // Jika barcode sudah ada
                }
                  $('#search-input').val('').focus();
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

    $('#saveBtn').click(function () {
          
        if (scannedItems.length === 0) {
            alert('Belum ada data yang discan');
            return;
        }
        $.ajax({
                    url: '{{ route("savedonk") }}',
                    method: 'POST',
                    data: {
                        items: scannedItems,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(res) {
                        if (res.success) {
                            alert(res.message);
                            console.log('save: ',res);
                            scannedItems = [];
                            $('#items-table tbody').empty();
                             $('#total').val('').focus();
                             $('#dibri').val('').focus();
                             $('#dilayani').val('').focus();
                             $('#jmldiberi').val('').focus();
                             $('#merk').val('').focus();
                             $('#ukktg').val('').focus();
                             $('#jml').val('').focus();
                             
                          // Clear semua checkbox
                          document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);

                                }

                        },


                });
        
     
    });





//   $('#searchInput').on('keyup', function () {
//       let keyword = $(this).val();
//       $.ajax({
//           url: "{{ route('data.search') }}",
//           type: "GET",
//           data: { keyword: keyword },
//           success: function (data) {
//               let rows = '';
//               data.forEach(function (item) {
//                   rows += `<tr>
//                             <td>${item.jnsktg}</td>
//                             <td>${item.ukktg}</td>
//                             <td>${item.jumlah}</td> 
//                             <td>${item.tglminta}</td> 
//                             <td> <input type="checkbox"
//                        class="checkbox-status"
//                        data-id="${item.id}"
//                                 ${item.is_active ? 'checked' : ''}>
//                           </tr>`;
//               });
//               $('#bodytdata').html(rows);
//           }
//       });
//   });
//  // Delegasi karena elemen dibuat dinamis
//     $(document).on('change', '.checkbox-status', function () {
//         const id = $(this).data('id');
//         const isActive = $(this).is(':checked') ? 1 : 0;

//         $.ajax({
//             url: '{{ route("gd.updateStatus") }}',
//             method: 'POST',
//             data: {
//                 _token: $('meta[name="csrf-token"]').attr('content'),
//                 id: id,
//                 data: isActive,
//             },
//             success: function () {
//                 console.log('Status diperbarui');
//                 alert(' memperbarui status');

//             },
//             error: function () {
//                 alert('Gagal memperbarui status');
//             }
//         });
//     });


</script>








@endsection 
