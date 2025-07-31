@extends('layouts.main')
@section('title', 'Permintaan Kantong')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<style>
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


<div class="container" >
    <div class="row">
        <h5 class="card-header">Penerimaan Kantong</h5>
             <div class="mb-2 col-md-3">
              <label for="almtsrt" class="form-label">No transaksi</label>
              <input readonly class="form-control"type="text"id="notrans"name="notrans"value="{{$notrima}}" />
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
            <label for="lastName" class="form-label"> No Minta  </label>
            <input class="form-control"type="text" id="nominta" name="nominta" value="" readonly/>
          </div>
          <div class="mb-2 col-md-6">
            <label for="lastName" class="form-label">No Gudang Keluar</label>
            <!-- <input class="form-control"type="text" id="tglminta" name="tglminta" value="" /> -->
             <input type="text" id="nogudang" name="nogudang" class="form-control" placeholder=""  > 
             <input type="hidden" id="jumlah" name="jumlah" class="form-control" placeholder=""  > 

          </div>
          <div class="mb-2 col-md-6">
            <label for="lastName" class="form-label">No Kantong</label>
            <!-- <input class="form-control"type="text" id="tglminta" name="tglminta" value="" /> -->
             <input type="text" id="nokntng" name="nokntng" autofocus   class="form-control" placeholder=""  > 
          </div>
          <div class="mt-4 mb-2 text-end" >
            <tr>
                <th><label class="form-label" for="country" style="text-align: center" >Jumlah Kirim Gudang </label> &nbsp;</th>
                <td> &nbsp;<input readonly style="float: right; width: 95px;" type="text" id="totalgd" name="totalgd" value="" class="form-control"  placeholder="" ></td><br/>
                <br/>
                <th><label class="form-label" for="country" style="text-align: center" >Jumlah Terima Aftap </label> &nbsp;</th>
                <td> &nbsp;<input readonly style="float: right; width: 95px;" type="text" id="total" name="total" value="" class="form-control"  placeholder="" ></td>
            
            </tr>
            <tr>
                    <div class="mt-2" style="float: left;">
                      <button id="saveBtn" type="submit" class="btn btn-primary me-2"><i class='bx bxs-save'> </i> Simpan</button>
                    </div>
                     
            </tr>
            
            </div>
    </div>
    <div class="card"  style="width: 1195px;">
        <fieldset class="border" style="width: 1095px;">
              <legend  class="float-none w-auto p-4" style="font-size: 18px;">Cari Penerimaan</legend>
                    <form action="{{ route('laporan.cetak') }}" method="GET" target="_blank">
                        <label>Tanggal Awal:</label>
                        <input type="date" name="tanggal_awal" required>
                        
                        <label>Tanggal Akhir:</label>
                        <input type="date" name="tanggal_akhir" required>
                        
                        <button type="submit" class="btn btn-warning me-2"><i class='bx  bx-printer'></i>Cetak</button>
                      </form>
        </fieldset>
        <br/>

            <fieldset class="border" style="width: 1095px;">
              <legend  class="float-none w-auto p-4" style="font-size: 18px;">Data Penerimaan</legend>
                <table id="tbdata" class="display table table-bordered  table-info">
                  <thead>
                      <tr>
                          <!-- <th>No</th> -->
                          <th>No Kantong</th>
                          <th>Merk</th>
                          <th>Jenis Kantong </th>
                          <th>Ukuran </th>
                          <th> No Lot</th>
                          <!-- <th>Aksi</th> -->
                      </tr>
                  </thead>
                  <tbody >
                      <?php $i=1; ?>                
                      <tr>

                      </tr>
                  </tbody>
                </table>
             </fieldset>
             
          </div>
    </div>
     
</div>
<script>
$(document).ready(function() {
    $('#tbdata').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
          });
     
    });




 let scannedItems = [];
    let totalScan = 0;
   // Event listener untuk menangkap input perubahan barcode
    $('#nokntng').on('change', function() {
        var barcode = $(this).val();
        
        // Kirim data barcode ke server untuk disimpan
        $.ajax({
            url: '{{ route("scan.terima") }}',
            method: 'POST',
            data: {
                barcode: barcode,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                 $('#nokntng').val('');
                if(response.success) {
               // Cek duplikat
                    if (scannedItems.find(item => item.nokntng === response.data.nokntng)) {
                        alert('No Kantong sudah discan');
                             

                    } else {
                      let nominta = document.getElementById('nominta').value;
                      let notrans = document.getElementById('notrans').value;
                      let nogudang = document.getElementById('nogudang').value;

                      totalScan++;
                      let minta = document.getElementById('total').value = totalScan;
                        scannedItems.push({
                            nokntng: response.data.nokntng,
                            jnskntng: response.data.jnskntng,
                            merkktg: response.data.mrkkntng,
                            ukuran: response.data.ukuran,
                            nolot: response.data.nolot,
                            minta: minta,
                            jml:response.data.jml,
                            nominta: response.data.nominta,
                            notrans: notrans,
                            nogudang: nogudang,
                            jumlah: response.data.jumlah,
                        });

                        $('#totalgd value').append( document.getElementById("totalgd").value = `${response.data.jml}`);
                        $('#nominta value').append( document.getElementById("nominta").value = `${response.data.nominta}`);
                        $('#jumlah value').append( document.getElementById("jumlah").value = `${response.data.jumlah}`);

                        // $('#jnskntng value').append( document.getElementById("jnskntng").value = `${response.data.jnskntng}`);
                        // $('#typekntng value').append( document.getElementById("typekntng").value = `${response.data.typekntng}`);
                        // $('#ukuran value').append( document.getElementById("ukuran").value = `${response.data.ukuran}`);

                        $('#tbdata tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td>${response.data.nokntng}</td>
                                 <td>${response.data.mrkkntng}</td>
                                <td>${response.data.jnskntng}</td>
                                <td>${response.data.ukuran}</td>
                                <td>${response.data.nolot}</td>

                        
                                <td><button class="btn btn-danger btn-sm removeBtn">Hapus</button></td>
                            </tr>
                        `);
                    }// Menambahkan baris baru di awal tabel
                } else {
                    alert(response.message);  // Jika barcode sudah ada
                }
                  $('#nokntng').val('').focus();
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

  // Simpan ke database
    $('#saveBtn').click(function () {
          
        if (scannedItems.length === 0) {
            alert('Belum ada data yang discan');
            return;
        }
        $.ajax({
                    url: '{{ route("terima.save") }}',
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
                            $('#tbdata tbody').empty();
                            $('#totalgd').val('');
                            $('#total').val('');
                            $('#nominta').val('');
                            $('#nogudang').val('');

                        }

                        },


                });
        
     
    });


</script>







@endsection