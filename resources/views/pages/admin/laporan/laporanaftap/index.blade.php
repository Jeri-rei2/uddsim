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

<div class="container">
    <div class="row">
          <h5 class="card-header">Laporan Stok Kantong Aftap</h5>
    
        <br/>
        
          <fieldset class="border" style="width: 1295px;">
              <legend  class="float-none w-auto p-4" style="font-size: 20px;">Cari Stok Kantong AFTAP</legend>
     
        
            <br/>
            <br/>
             <label for="">No Transaksi Penerimaan </label>
            <input type="text" name="notrans" id="notrans" placeholder="No Prmintaan.." style="width: 150px; height: 37px;">
             <label for="">No Permintaan</label>
            <input type="text" name="nominta" id="nominta" placeholder="No Permintaan.." style="width: 150px; height: 37px;">
          
          <!-- <label for=""> Tgl Awal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" placeholder="" style="width: 160px; height: 37px;">

             <label for=""> Tgl Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" placeholder="" style="width: 160px; height: 37px;"> -->
            <!-- <input type="text" name="goldar" placeholder="Golongan Darah"> -->

            <!-- <select name="role">
                <option value="">-- Pilih Jenis Kantong --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select> -->
            <br/>
            <button  class="btn btn-warning" id="filter"> <i class='bx  bx-search'  ></i> CARI</button>
            <button class="btn btn-danger" id="cetak"> <i class="bx bx-printer"></i> Cetak </button>


       
      </fieldset>
      <br/>
       <fieldset class="border" style="width: 1095px;">
              <legend  class="float-none w-auto p-4" style="font-size: 18px;">Data Stok</legend>


                <table id="tbd"  class="display table table-bordered  table-info">
                  <thead>
                      <tr>
                          <!-- <th>No</th> -->
                          <th>No Kantong</th>
                          <th>Merk</th>
                          <th>Jenis Kantong </th>
                          <th>Ukuran </th>
                          <th>jumlah Terima dr gudang </th>
                          <th>jumlah Permintaan Ktg</th>
                          <th>Real Stok</th>

                          <!-- <th>Aksi</th> -->
                      </tr>
                  </thead>
                  <tbody id="tbdata">
                      <?php $i=1; ?>                
                      <tr>

                      </tr>
                  </tbody>
                </table>
             </fieldset>
    </div>



</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#filter').on('click', function () {
        let notrans = $('#notrans').val();
        let nominta = $('#nominta').val();
         
        let tanggal_awal = $('#tanggal_awal').val();
        let tanggal_akhir = $('#tanggal_akhir').val();

        $.ajax({
            url: "{{ route('search.data') }}",
            type: "GET",
            data: {
                notrans: notrans,
                nominta: nominta,
                tanggal_awal: tanggal_awal,
                tanggal_akhir: tanggal_akhir
            },
            success: function (response) {
                let rows = '';
                response.ord.forEach(data => {
                    rows += `<tr>
                        <td>${data.nokntng}</td>
                        <td>${data.jnskntng}</td>
                        <td>${data.merkktg}</td>
                        <td>${data.ukuran}</td>
                        <td>${data.jmlterima}</td>
                        <td>${data.realpermintaan}</td>
                        <td>${data.stok}</td>


                    </tr>`;
                });
                $('#tbdata').html(rows);
            }
        });
    });


    $(document).ready(function() {
    $('#tbd').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
          });
     
    });
  $('#cetak').on('click', function() {
        $.ajax({
            url: "{{ route('cetak-all') }}",
            method: 'GET',
            success: function(response) {
                let win = window.open('', '_blank');
                win.document.write(response);
                win.document.close();
                win.focus();
                win.print();
            },
            error: function(xhr) {
                alert('Gagal mencetak semua data');
            }
        });
    });




</script>


















@endsection