@extends('layouts.main')
@section('title', 'Gudang')

@push('custom-css')
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
    
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
       .separator {
      width: 100%;
      height: 2px;
      background-color: black;
      margin: 30px 0;
    }
    .barcode-labels span {
      width: 48%;
    }
  </style>
@endpush

@section('content')

<div class="container">
    <div class="row">
            <div class="card">
                 <h5 class="card-header">Stok Kantong </h5>
                    <table>
                        <tr>
                                <td>
                                <label for="" class="form-label">No Terima</label>
                                    <input type="text" value="{{$noGD}}" id="noterima" name="noterima" class="form-control" readonly>
                                </td>
                         
                                <td>
                                    <label for="" class="form-label">Tgl Terima</label>
                                    <input type="text" value="<?php echo date("Y-d-m");?>" id="tglterima" name="tglterima" class="form-control"> 
                                </td>
                                 <td>
                                    <label for="" class="form-label">No Kantong</label>
                                    <input type="text" id="search-input" name="search-input"autofocus   class="form-control" placeholder="Cari No Kantong..."> 
                                </td>
 
                        </tr>
                        <tr>
                              <td>
                                    <label for="" class="form-label">No Lot</label>
                                    <input type="text" id="nolot" name="nolot" value=""  class="form-control"> 
                                </td>
                                 <td>
                                    <label for="" class="form-label">Merk</label>
                                    <input type="text" id="mrkkntng" name="mrkkntng" value=""  class="form-control"> 
                                </td>
                                 <td>
                                    <label for="" class="form-label">Jenis</label>
                                    <input type="text" id="jnskntng" name="jnskntng" value="" class="form-control"> 
                                </td>
                        </tr>
                        <tr>
                             <td>
                                    <label for="" class="form-label">Type Jenis</label>
                                    <input type="text" id="typekntng" name="typekntng"value="" class="form-control"> 
                                </td>
                                 <td>
                                    <label for="" class="form-label">Ukuran</label>
                                    <input type="text"id="ukuran" name="ukuran"value="" class="form-control"> 
                                </td>
                        </tr>
                    </table>
                     <div class="mt-4 mb-2 text-end">
                            <button class="btn btn-success" id="saveBtn"><i class='bx bx-save'> </i> Simpan</button>
                               
                     </div>
                    <br>
                    <hr>
                  
                     <!-- Tabel Hasil Pencarian -->
                      <table border="1" class="table table-striped" id="items-table">
                            <thead>
                                <tr>
                                    <th>No Kantong</th>
                                    <th>Merk</th>
                                    <th>Jns Kantong</th>
                                    <th>CC</th>
                                    <th>No LOT</th>
                                    <th>Type Kantong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimuat di sini dengan AJAX -->
                               
                            </tbody>
                            
                        </table>
                                <div class="mt-4 mb-2 text-end" style="float: right;">
                              
                                        <tr>
                                            <th><label class="form-label" for="country" style="text-align: center" >Jumlah </label> &nbsp;</th>
                                            <td> &nbsp;<input readonly style="float: right; width: 95px;" type="text" id="total" name="total" value="" class="form-control"  placeholder="" ></td>
                                        
                                        </tr>
                               
                                </div>
       </div>                          
    </div>
</div>

<script>
    let scannedItems = [];
    let totalScan = 0;
   // Event listener untuk menangkap input perubahan barcode
    $('#search-input').on('change', function() {
        var barcode = $(this).val();
        
        // Kirim data barcode ke server untuk disimpan
        $.ajax({
            url: '{{ route("scan.data") }}',
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
                             

                    } else {
                      let input = document.getElementById('noterima').value;
                      totalScan++;
                      document.getElementById('total').value = totalScan;
                        scannedItems.push({
                            nokntng: response.data.nokntng,
                            mrkkntng: response.data.mrkkntng,
                            jnskntng: response.data.jnskntng,
                            typekntng: response.data.typekntng,
                            ukuran: response.data.ukuran,
                            nolot: response.data.nolot,
                            noterima: input,
                        });

                        $('#nolot value').append( document.getElementById("nolot").value = `${response.data.nolot}`);
                        $('#mrkkntng value').append( document.getElementById("mrkkntng").value = `${response.data.mrkkntng}`);
                        $('#jnskntng value').append( document.getElementById("jnskntng").value = `${response.data.jnskntng}`);
                        $('#typekntng value').append( document.getElementById("typekntng").value = `${response.data.typekntng}`);
                        $('#ukuran value').append( document.getElementById("ukuran").value = `${response.data.ukuran}`);

                        $('#items-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td>${response.data.nokntng}</td>
                                <td>${response.data.mrkkntng}</td>
                                <td>${response.data.jnskntng}</td>
                                <td>${response.data.ukuran}</td>
                                <td>${response.data.nolot}</td>
                                <td>${response.data.typekntng}</td>

                                <td><button class="btn btn-danger btn-sm removeBtn">Hapus</button></td>
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

    // Simpan ke database
    $('#saveBtn').click(function () {
          
        if (scannedItems.length === 0) {
            alert('Belum ada data yang discan');
            return;
        }
        $.ajax({
                    url: '{{ route("scan.save") }}',
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
                        }

                        },


                });
        
     
    });
</script>







@endsection 
