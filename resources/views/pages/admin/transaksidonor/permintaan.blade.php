@extends('layouts.main')
@section('title', 'Permintaan Kantong')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
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
  <div id="alertBox"></div>

    <div class="container">
     <form >
    <div id="message"></div>
        <div class="card">
            <div class="row">
                <h5 class="card-header">Permintaan Kantong</h5>
                  <div class="mb-2 col-md-3">
                    <label for="almtsrt" class="form-label">No Permintaan</label>
                    <input readonly class="form-control"type="text"id="nominta"name="nominta"value="{{ $nominta }}"  autofocus/>
                  </div>
                  <div class="mb-2 col-md-4">
                    <label for="lastName" class="form-label">Tanggal Minta </label>
                    <input class="form-control"type="date" id="tglminta" name="tglminta" value="<?php echo date('Y-m-d');?>" />
                  </div>
              
                  <div class="mb-2 col-md-6">
                    <label for="notlp" class="form-label">Merk Kantong</label>
                    <select id="merk" name="merk" class="select2 form-select">
                    <option value="0" selected readonly> Pilih </option>
                    @foreach ($jnskntng as $cc)
                    <option value="{{$cc->Merk}}" data-option="{{$cc->Merk}}">{{$cc->Merk}}</option>
                    @endforeach 

                    </select>
                  </div>
                  <div class="mb-2 col-md-6">
                    <label for="organization" class="form-label">Jenis Kantong</label>
                    <select id="jnsktg" neme="jnsktg" class="select2 form-select">
                          <option value="0" selected readonly> Pilih </option>
                          <option value="Apheresis">Apheresis</option>
                          <option value="Double Besar">Double Besar</option>
                          <option value="Double Kecil">Double Kecil</option>
                          <option value="Pediatrix">Pediatrix</option>
                          <option value="Quadruple">Quadruple</option>
                          <option value="Quintruple">Quintruple</option>
                          <option value="Single">Single</option>
                          <option value="Triple">Triple</option>

                    </select>
                  </div>
                  <div class="mb-2 col-md-3">
                    <label class="form-label" for="phoneNumber">Ukuran </label>
                    <div class="input-group input-group-merge">
                    <select id="ukktg" neme="ukktg" class="select2 form-select">
                      
                    </select>
                    </div>
                  </div>
                
                  <div class="mb-2 col-md-3">
                    <label for="state" class="form-label">Jumlah</label>
                    <input class="form-control" type="number" id="jumlah" name="jumlah" placeholder="" onchange="updateInput()" />
                    <input class="form-control"type="hidden" id="ket" name="ket" value="Permintaan Aftap" readonly/>

                  </div>   
                  <div class="mb-2 col-md-3">
                    <label for="state" class="form-label">-</label>
                    <button class="form-control addCart" type="button" style="width:170px; colors: yellow;" id="adddata" name="adddata" onclick="tambahRow()"> <i class='bx bx-plus'> </i> </button>
                  </div>  
                  <div class="mt-4 mb-2 text-end">    
                    <button id="saveBtn" class="btn btn-danger" type="submit" style="width:170px; colors: yellow" ><i class='bx bx-save'></i> Simpan </button>
                    
                  </div> 
           </div>
        </div>
            <div class="mt-4 mb-2 text-end">
              <hr class="my-0" />
              <tr>
                 <th> <label for="total" class="form-label">Total Permintaan</label></th> <br/>
              </tr>
             
              <tr>
              <input type="text" class="form-control" id="total" name="total" value="" style="width:70px;  float: right; " placeholder="Total "/>
              <td></td>
              </tr>
              
            </div>
    </div>
    <br/>
    <br/>
   
    
  
        </form>
        <div class="card-container">
          <div class="card">
                <div class="row">
                  <h5 class="card-header">Permintaan</h5>
                      <div class="card">
                       <table id="tableview" class="display table table-bordered  table-info" >
                          <thead>
                              <tr>
                                  <th>Merk</th>
                                  <th>Jenis Kantong</th>
                                  <th>Ukuran</th>
                                  <th>Jumlah </th>
                                  <th>Keterangan</th>
                                  <!-- <th>Aksi</th> -->
                              </tr>
                          </thead>
                          <tbody id="tableBody">
                              <?php $i=1; ?>                
                              <tr>

                              </tr>
                          </tbody>
                       </table>
                     </div>
               </div>
          </div>
          <div class="card">
            <div class="row">
                  <h5 class="card-header">Data Hasil Permintaan</h5>
                      <div class="card" style="width: 190px;">
                       <table id="tableview2" class="display table table-bordered  table-info" >
                          <thead>
                              <tr>
                                  <th>Merk</th>
                                  <th>Jenis Kantong</th>
                                  <th>Ukuran</th>
                                  <th>Jumlah </th>
                                  <th>Keterangan</th>
                                  
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody id="tableBody">
                              <?php $i=1; ?> 
                              @foreach($minta as $data)
                                <tr>
                                  <td style="width: 90px;">{{$data->merk}}</td>
                                  <td style="width: 90px;">{{$data->jnsktg}}</td>
                                  <td style="width: 90px;">{{$data->ukktg}}</td>
                                  <td style="width: 90px;">{{$data->jumlah}}</td>
                                  <td style="width: 90px;">{{$data->ket}}</td>

                                  <td style="width: 90px;"> <a href="{{route('permintaan.cetak', $data->id)}}" style="width:80px;" class="btn btn-info btnView" data-id="{{ $data->id }}" type="btn" style="width:170px; colors: yellow" >
                                       <i class="bx bx-printer"></i> Cetak </button></td>
                              </tr>
                    
                               @endforeach               
                            
                          </tbody>
                       </table>
                     </div>
               </div>
          </div>
        </div>




    </div>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
   $(document).ready(function() {
    $('#tableview2').DataTable({
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
   $(document).ready(function () {
        $('.btnView').click(function () {
            const id = $(this).data('id');
            $.get(`/cetak/permintaan/${id}`, function (data) {
                $('#viewNama').text(data.merk);
                $('#viewUsia').text(data.ukktg);
                const modal = new bootstrap.Modal(document.getElementById('modalPreview'));
                modal.show();
            });
        });
    });




   function updateInput() {
    const val = parseFloat(document.getElementById('jumlah').value) || 0 ;
    const val2 = parseFloat(document.getElementById('total').value) || 0;

    const total = val + val2;
      // Tampilkan hasil total
      document.getElementById('total').value = total;
  }

 let rowIndex = 1;

    function tambahRow() {
         const nominta = document.getElementById('nominta').value;
        const tglminta = document.getElementById('tglminta').value;
        const jnsktg = document.getElementById('jnsktg').value;
        const merk = document.getElementById('merk').value;
        const ukktg = document.getElementById('ukktg').value;
        const jumlah = document.getElementById('jumlah').value;
        const ket = document.getElementById('ket').value;
        // const tbody = document.getElementById('tableBody');
        // const row = document.createElement('tr');
        const table = document.getElementById('tableview').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <td><input type="text" id="merk[${rowIndex}][merk]" name="merk[]" value="${merk}" readonly required style="width: 90px;"></td>
            <td><input type="text" id="merk[${rowIndex}][jnsktg]" name="jnsktg[]" value="${jnsktg}" readonly required style="width: 90px;"></td>
            <td><input type="text" id="ukktg[${rowIndex}][ukktg]" name="ukktg[]" value="${ukktg}" readonly required style="width: 90px;"></td>
            <td class="jumlah"><input type="number"id="jumlah[${rowIndex}][jumlah]"  name="jumlah[]" value="${jumlah}" readonly required style="width: 90px;"></td>
            <td><input type="text" id="ket[${rowIndex}][ket]" name="ket[]" value="${ket}" readonly required style="width: 90px;"></td>
            <td style="display:none;"><input type="hidden" id="nominta[${rowIndex}][nominta]" name="nominta[]" value="${nominta}" required style="width: 90px;"></td>
            <td style="display:none;"><input type="hidden" id="tglminta[${rowIndex}][tglminta]" name="tglminta[]" value="${tglminta}" required style="width: 90px;"></td>


            <td style="display:none;"><button type="button" onclick="hapusRow(this)"style="width: 90px;">Hapus</button></td>
        `;

        // tbody.appendChild(row);
        rowIndex++;
    }

    function hapusRow(button) {
        // const row = button.parentNode.parentNode;
          const row = button.closest('tr');
        row.remove();
    }

document.getElementById('saveBtn').addEventListener('click', function () {
        let merk = document.getElementsByName('merk[]');
        let jnsktg = document.getElementsByName('jnsktg[]');
        let ukktg = document.getElementsByName('ukktg[]');
        let jumlah = document.getElementsByName('jumlah[]');
        let ket = document.getElementsByName('ket[]');
        let nominta = document.getElementsByName('nominta[]');
        let tglminta = document.getElementsByName('tglminta[]');

        let data = [];
        for (let i = 0; i < merk.length; i++) {
            data.push({
                merk: merk[i].value,
                jnsktg: jnsktg[i].value,
                ukktg: ukktg[i].value,
                jumlah: jumlah[i].value,
                ket: ket[i].value,
                nominta: nominta[i].value,
                tglminta: tglminta[i].value,

            });
        }
         $.ajax({
            url: "{{ route('push.temp') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                dataktg: data,
            },
            success: function (res) {
              console.log(res);
                $('#alertBox').html(`<div class="alert alert-success">Berhasil menyimpan data.</div>`);
            },
              error: function (xhr) {
                          $('#alertBox').html(`<div class="alert alert-danger">Gagal menyimpan data.</div>`);
                      }
          });

            
      });





















// let selectedValues = [];

//   function addToCart() {
//         let selectElement = document.getElementById("barang_id");
//         let selectedValue = selectElement.value;
//         if (selectedValue != null) {
//             let ceknilai = selectedValues.includes(selectedValue)
//             if (!ceknilai) {
//                 var barang = @json($barang);
//                 for (let i = 0; i < barang.length; i++) {
//                     if (barang[i].id == selectedValue) {
//                         var qty = 1
//                         var cart = `<div class="card rounded-3 mb-4" id="cartbox-${barang[i].id}" data-hidden-value='${barang[i].id}'>
//                                 <div class="card-body p-4">
//                                     <div class="row d-flex justify-content-between align-items-center">
//                                         <div class="col-md-2 col-lg-2 col-xl-2">
//                                             <img src="http://127.0.0.1:8000/product_image/${barang[i].foto}" class="img-fluid rounded-3" alt="Cotton T-shirt">
//                                         </div>
//                                         <div class="col-md-3 col-lg-3 col-xl-3">
//                                             <input type='hidden' name='pid[]' value='${barang[i].id}'>
//                                             <p class="lead fw-normal mb-2"><span id="namaBarang" class="namaBarang">${barang[i].nama}</span></p>
//                                             <p><span class="text-muted">Tipe: </span>${barang[i].tipe} <br><span class="text-muted">Ukuran: </span>${barang[i].panjang} x ${barang[i].lebar}</p>
//                                         </div>
//                                         <div class="col-md-3 col-lg-3 col-xl-2">
//                                             <p><span class="text-muted">Stock: </span>${barang[i].in_stock} 
//                                                 <br> <span class="text-muted">Kategori: </span>${barang[i].kategori['nama']}  
//                                             </p>
//                                             <input id="qty" min="0" max="${barang[i].in_stock}" name="quantity[]" onChange="changeQty(${barang[i].harga})" value="1" type="number" class="form-control form-control-sm" />
//                                             <input type="hidden" name="harga[]" value='${barang[i].harga}' >
//                                         </div>
//                                         <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
//                                             <h5 class="mb-0">Rp. ${barang[i].harga}</h5>
//                                         </div>
//                                         <div class="col-md-1 col-lg-1 col-xl-1 text-end">
//                                             <a href="#!" class="text-danger" onclick='handleDelete(${barang[i].id})'><i class='bx bx-trash'></i></a>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>`

//                         $('.carttwo').append(cart);
//                         selectedValues.push(selectedValue);
//                         console.log('selected values: ', selectedValues);

//                         let conString = JSON.stringify(selectedValue);
//                         console.log('STRINGIFY : ', conString)
//                         selectElement.selectedIndex = 0; // Reset select option
//                     }
//                 }
//             }
//         }
//     }

//     function handleDelete(id) {
//         if (selectedValues.length > 0) {
//             var indexNilai = selectedValues.indexOf(id);
//             selectedValues.splice(indexNilai, 1);
//             var parentElementId = "cartbox-" + id;
//             var grandparentElement = document.getElementById("carttwo");
//             var parentElement = document.getElementById(parentElementId);
//             grandparentElement.removeChild(parentElement);
//         }
//     }





//   // selected dinamic 2 value jns kantong

const firstSelect = document.getElementById('jnsktg');
const secondSelect = document.getElementById('ukktg');

firstSelect.onchange = function() {
  const selectedValue = firstSelect.value;
  secondSelect.innerHTML = ''; // Clear existing options

  if (selectedValue === 'Apheresis') {
    addOption(secondSelect, '250 CC', '250 CC');
    addOption(secondSelect, '350 CC', '350 CC');
  } else if (selectedValue === 'Double Besar') {
    addOption(secondSelect, '350 CC', '350 CC');
    addOption(secondSelect, '450 CC', '450 CC');
  }else if (selectedValue === 'Double Kecil') {
    addOption(secondSelect, '250 CC', '250 CC');
  }else if (selectedValue === 'Pediatrix') {
    addOption(secondSelect, '450 CC', '450 CC');
    addOption(secondSelect, '350 CC', '350 CC');
  }else if (selectedValue === 'Quintruple') {
    addOption(secondSelect, '450 CC', '450 CC');
  }else if (selectedValue === 'Quadruple') {
    addOption(secondSelect, '450 CC', '450 CC');
  }else if (selectedValue === 'Single') {
    addOption(secondSelect, '350 CC', '350 CC'); 
  }else if (selectedValue === 'Triple') {
    addOption(secondSelect, '450 CC', '450 CC');
    addOption(secondSelect, '350 CC', '350 CC'); 
  }
};

function addOption(selectElement, text, value) {
  const option = document.createElement('option');
  option.text = text;
  option.value = value;
  selectElement.add(option);
}
</script>



@endsection 