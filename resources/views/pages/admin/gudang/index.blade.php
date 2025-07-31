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
  </style>
@endpush

@section('content')

@if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
<div class="container">
    <div class="row">
    <!-- <form action="{{ route('generate.store') }}" method="POST" id="dataform"> -->
    <!-- @csrf -->
        <div class="card">
          <h5 class="card-header">Gudang</h5>
           <form   method="POST">
              @csrf
               <table>
                 <tr>
                    <td> 
                        <label for="notlp" class="form-label">Merk Kantong</label>
                    <select id="mrkkntng" name="mrkkntng" class="select2 form-select">
                    <option value="0" selected readonly> Pilih </option>
                    @foreach ($jnskntng as $cc)
                    <option value="{{$cc->Merk}}" data-option="{{$cc->Merk}}">{{$cc->Merk}}</option>
                    @endforeach 

                    </select>
                    </td>
                    <td>
                    <label for="organization" class="form-label">Jenis Kantong</label>
                      <select id="jnskntng" neme="jnskntng" class="select2 form-select">
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
                    </td>
                    <td>
                        <label class="form-label" for="phoneNumber">Type Kantong </label>
                        <select id="typekntng" neme="typekntng" class="select2 form-select">
                        </select>
                    </td>
                    <td>
                        <label for="state" class="form-label">Ukuran</label>
                        <select id="ukuran" neme="ukuran" class="select2 form-select">
                    </td>
                   
                 </tr>
                 <tr>
                    <td>
                        <label for="state" class="form-label">No LOT</label>
                            <input type="text" class="form-control" id="nolot" name="nolot">
                    </td>
                    <td>
                        <label for="state" class="form-label">Duplicat </label>
                        <input type="number" min="1" class="form-control" id="jmlcetak" name="jmlcetak" >
                       

                    </td>
                    <td>
                     
                        <label for="state" class="form-label">No Kantong</label>
                        <input  class="form-control" id="nokntng" name="nokntng"  value=""readonly >
                          <!-- <strong id="nokntng" name="nokntng">Loading...</strong> -->
                  
                    </td>
                    <td>
                        <label for="state" class="form-label">Jumlah Cetak</label>
                        <input type="number" min="0" class="form-control" id="duplikat" name="duplikat"onchange="updateInput(this.value)" >
                    </td>
                 </tr>
               </table>
            </form>   
        </div>
        <div class="card">
            <div class=" text-end">
                <hr class="my-0" />
                <tr>
                    <th> <label for="address" class="form-label">Jumlah</label></th> <br/>
                </tr>
                <tr>
                   <div  > </div>
                   <input type="value" class="form-control jml" id="jml" name="jml" style="width:85px;  float: right; " />

                   <input type="hidden" class="form-control" id="tglbrcode" name="tglbrcode" style="width:85px;  float: right; " value="<?php echo date("d-m-Y H:i:s")?>"/>
                   <input type="hidden" class="form-control" id="nat" name="nat" style="width:85px;  float: right; " value="T"/>
                   <input type="hidden" class="form-control" id="id" name="nat" style="width:85px;  float: right; " value="T"/>

                   <input type="hidden" id="tahun" maxlength="2" value="<?php echo 
                     $year = date('y');
                     $year = substr($year, -2);
                     ?>">
                   <input type="hidden" id="bulan" maxlength="2" value="<?php echo 
                     $year = date('m');
                     $year = substr($year, -2);
                     ?>">

                <td></td>
                </tr>
            
            </div>
            <div class="mt-4 mb-2 text-end">
            <button type="submit" class="btn btn-info tombol-simpan"  onclick="addRow()"><i class='bx bx-run'></i> Run</button> 
                <a href="#" class="btn btn-secondary"  > <i class='bx bx-stop'></i> Stop</a>
             <a href="#" class="btn btn-warning" onclick="sendData()" > <i class='bx bx-save'></i> Simpan</a>
             <button type="submit" class="btn btn-danger" id="cetak" name="cetak" onclick="cetak()"> <i class="bx-solid bx-print"></i> Cetak</button>
             <!-- <a href="#" class="btn btn-info" onclick="fetchLatest()">🔄 Ambil Data</a> -->
            </div>
        </div>

    </div>
    <!-- </form> -->
</div>
<table class="table table-dark" id="alldata">
  <thead>
    <tr>
      <th scope="col">Merk</th>
      <th scope="col">Jns Kantong</th>
      <th scope="col">Vol</th>
      <th scope="col">Tgl Barcode </th>
      <th scope="col">Jumlah</th>
      <th scope="col">No Lot </th>
      <th scope="col">Nat</th>
      <th scope="col">Uk Ktg</th>
      <th scope="col">No Kantong</th>


    </tr>
  </thead>
  <tbody >
    <tr>
     
    
    </tr>
   
  </tbody>
</table>


  <div id="printArea">
  <table id="dataTable" >
    <tbody id="tableBody">
    <tr>
    </tr>
    </tbody>
   
  </table>
  </div>
<script>
 // 3. Fungsi untuk print hanya area tabel
    function cetak() {
      const originalContent = document.body.innerHTML;
      const printContent = document.getElementById("printArea").innerHTML;

      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = originalContent;
      // location.reload(); // reload untuk kembalikan tombol print
    }

let lastCodeNumber = 0;
let prefixYYMM = '';
let totalRows = 0;
  function fetchLatest() {
          fetch('http://localhost:8000/api/ambilbos') // Ganti dengan URL endpoint yang benar
    .then(res =>  res.json())
    .then(data => {
      // const ambil = data.data;
      // const targetBody = document.querySelector("#dataTable tbody");
      // targetBody.innerHTML = ""; // Kosongkan tabel sebelum isi baru
      const list = document.getElementById('dataTable');
            list.innerHTML = ''; // Kosongkan list
            
      
      
    })
    .catch(error => {
      console.error("Terjadi kesalahan:", error);
    });




  }
    // Otomatis fetch saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchLatest);
    




//save data
function sendData() {

            // Ambil data dari tabel
            let ids = [];
            // $('#alldata tbody tr').each(function() {
                let row =[];
              //   $(this).find('td').each(function () {
              //   row.push($(this).text());
              // });
              const jmlcetak = document.getElementById('jmlcetak').value;
              const rows = document.querySelectorAll("#alldata tbody tr");
              rows.forEach(row => {
                const mrkkntng = row.cells[0].textContent;
                const jnskntng = row.cells[1].textContent;
                const ukuran = row.cells[2].textContent;
                const tglbrcode = row.cells[3].textContent;
                const duplikat = row.cells[4].textContent;
                const nolot = row.cells[5].textContent;
                const nat = row.cells[6].textContent;
                const typekntng = row.cells[7].textContent;
                const nokntng = row.cells[8].textContent;
                const jmlcetak = row.cells[9].textContent;

                ids.push({ 
                  mrkkntng: mrkkntng,
                  jnskntng : jnskntng,
                  ukuran : ukuran,
                  tglbrcode :tglbrcode,
                  duplikat  : duplikat,
                  nolot : nolot,
                  nat  : nat,
                  typekntng : typekntng,
                  nokntng : nokntng,
                  jmlcetak : jmlcetak,

                  
                 });
              });
                // ids.push(row);
            // });
            console.log('ID yang dikirim:', ids);
            // Kirim data ke backend menggunakan AJAX
            $.ajax({
                url: '{{ route("generate.store") }}', // URL untuk route Laravel
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: ids // Mengirim data tabel ke controller
                    // ids: ids,/
                },
                success: function(response) {
                    // Tampilkan pesan sukses setelah data berhasil dikirim
                    alert('Data berhasil simpan!');
                        location.reload();  // Reload the page
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error jika terjadi kesalahan
                    alert('Terjadi kesalahan dalam pengiriman data!');
                }
            });

          }





window.onload = function() {
  fetch('http://localhost:8000/api/last-temp-code')
    .then(res => res.json())
    .then(data => {
      const today = new Date();
      const yy = today.getFullYear().toString().slice(2); // '24'
      const mm = String(today.getMonth() + 1).padStart(2, '0'); // '05'
      prefixYYMM = yy + mm;

      const lastCode = data.last_code;
      if (lastCode && lastCode.startsWith(prefixYYMM)) {
        lastCodeNumber = parseInt(lastCode.slice(-4)); // Get NNNN
      } else {
        lastCodeNumber = 0; // Start over if month changed
      }
    })
    .catch(err => console.error('Error fetching last code:', err));



   
};

let arrayItems = [];

// Fungsi untuk menambah baris baru secara dinamis
function addRow() {
        // Close the print window 
   lastCodeNumber++;
   totalRows++;
   document.getElementById("dataTable").style.display = 'block';
  const mrkkntng = document.getElementById('mrkkntng').value;
  const jnskntng = document.getElementById('jnskntng').value;
  const typekntng = document.getElementById('typekntng').value;
  const ukuran = document.getElementById('ukuran').value;
  const tglbrcode = document.getElementById('tglbrcode').value;
  const duplikat =  parseInt(document.getElementById('duplikat').value);
  const jmlcetak = document.getElementById('jmlcetak').value;
  const nolot = document.getElementById('nolot').value;
  const nat = document.getElementById('nat').value;
  // const nokntng = document.getElementById('nokntng').value;
  const table = document.getElementById('alldata').getElementsByTagName('tbody')[0];
  // for (let i = 1; i <= duplikat; i++) {
      const hasil = totalRows + duplikat;
    
     
     

      // Kosongkan semua baris lama
      table.innerHTML = '';

      for (let i = 1; i <= duplikat; i++) {

      // var newRow;
      // if(table.rows.length == 0){
         newRow = table.insertRow();
      // }else{
      //   newRow = table.rows[0];
      // }

      const currentRowCount = table.rows.length;
      const nokntng = prefixYYMM + String(currentRowCount + lastCodeNumber).padStart(4, '0');


          const cell1 = newRow.insertCell(0);
          cell1.textContent =  currentRowCount+1;
          const cell2 = newRow.insertCell(1);
          const cell3 = newRow.insertCell(2);
          const cell4 = newRow.insertCell(3);
          const cell5 = newRow.insertCell(4);
          const cell6 = newRow.insertCell(5);
          const cell7 = newRow.insertCell(6);
          const cell8 = newRow.insertCell(7);
          const cell9 = newRow.insertCell(8);
          const cell10 = newRow.insertCell(9);
          const cell11 = newRow.insertCell(10);



            // Tambahkan input field pada baris baru
            cell1.innerHTML  = mrkkntng;
            cell2.innerHTML = jnskntng;
            cell3.innerHTML = ukuran;
            cell4.innerHTML = tglbrcode;
            cell5.innerHTML = duplikat;
            cell6.innerHTML = nolot;
            cell7.innerHTML = nat;
            cell8.innerHTML = typekntng;
            cell9.innerHTML = nokntng;
            cell10.innerHTML = jmlcetak;
            // cell11.innerHTML = `<button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class='bx bxs-message-alt-x'> </i> Hapus baris </button>`;
           
          }
          
          const rows = table.querySelectorAll('tbody tr');
          const kirim = [];
          rows.forEach(row => {
              const cells = row.querySelectorAll('td');
              kirim.push({
                mrkkntng: cells[0].textContent.trim(),
                jnskntng: cells[1].textContent.trim(),
                ukuran: cells[2].textContent.trim(),
                tglbrcode: cells[3].textContent.trim(),
                duplikat: cells[4].textContent.trim(),
                nolot: cells[5].textContent.trim(),
                nat: cells[6].textContent.trim(),
                typekntng: cells[7].textContent.trim(),
                nokntng: cells[8].textContent.trim(),
                jmlcetak: cells[9].textContent.trim(),
              });
            });
          console.log('ID yang dikirim:', kirim);
            // Kirim data ke backend menggunakan AJAX
            $.ajax({
                url: '{{ route("barcode.temp") }}', // URL untuk route Laravel
                method: 'POST',
                data: JSON.stringify({kirim: kirim}),
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Tampilkan pesan sukses setelah data berhasil dikirim
                    // alert('gene!');


                  
                          console.log('ID yang dikirim:', response);
                          let html = '';
                            const jumlahCetak = {};
            response.forEach(item => {
                            const kantng = item.nokntng;
                     if (jumlahCetak[kantng]) {
                        jumlahCetak[kantng]++;
                    
                       
                      } else {
                        jumlahCetak[kantng] = 1;
                          for(let i = 0; i < jmlcetak; i++){
                       html +=`<tr > 
                                    <td>
                                      
                                        <span style="text-align:left; font-size: 10px;">UDD PMI KOTA SBY</span><br/>`;
                                 
                      html +=`  <div style="margin-bottom: 5px;">
                                 <div id="barcode">${item.barcode} </div>
                                
                            </div>`; 
                       html +=`  <b></b><span style="text-align:left;">${item.nokntng}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span style="text-align:right;">${item.nmkntng}</span></b>
                                      
                                    </td>
                                    </tr>
                                      `;
                                      
                                      //  document.getElementById('barcode').innerHTML = item.barcode;
                             var cell = document.getElementById("dataTable");
                             var buat = document.createElement("barcode");
                            //  cell.innerHTML = '';
                             var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                               
                              cell.appendChild(buat);
                              buat.appendChild(svg);

                                   JsBarcode(svg, kantng, {
                                              format: "CODE128",
                                              lineColor: "#0aa",
                                              displayValue: false,
                                              width: 30,
                                              height: 20,
                                              margin: 0,
                                              displayValue: true
                                          });
                         }
                           let i = 0;
                              while (i < item.data.length) {
                                const current = item.data[i];
                                  html += `<tr><td><br/><br/>
                                            </td></tr><br/><br/>`;
                                console.log(current);

                                // Hitung berapa kali item yang sama berurutan
                                let count = 1;
                                while (item.data[i + count] === current) {
                                    html += `<tr>
                                        <td colspan="1" style="border-top: 2px solid black;"><br/><br/> </td>
                                        </tr>`;

                                   html += `<tr><td>${item.data[i]}</td></tr><br/><br/><br/><br/>`;
                                  console.log(item.data[i + count]);

                                  count++;
                                }
                              html += `<tr>
                                        <td colspan="1" style="border-top: 2px solid black;"><br/><br/> </td>
                                        </tr>`;
                                console.log("------------"); // Garis pemisah setelah duplikat selesai
                                i += count; // Lompat ke item berikutnya yang berbeda
                              }

                      }
                    

                       
                               console.log(jumlahCetak);
                  });
                      $('#dataTable').html(html);
                         
                    

                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan error jika terjadi kesalahan
                    alert('Terjadi kesalahan dalam pengiriman data!');
                }
            });

    
  }
  fetch("http://localhost:8000/api/last-temp-code")
  .then(res => res.json())
  .then(data => {
    let lastCode = data.last_code; // Misal: "24050023"
    let nextNumber = "0001"; // default jika belum ada
    // let duplikat = document.getElementById("duplikat").value;
    if (lastCode) {
      // Ambil 4 digit terakhir dari kode
      let lastNumber = parseInt(lastCode.slice(-4));
      nextNumber = (lastNumber + 1).toString().padStart(4, "0"); // jadi 0024
    }

    // Ambil yymm sekarang
    const now = new Date();
    const yy = now.getFullYear().toString().slice(-2); // 2024 → 24
    const mm = String(now.getMonth() + 1).padStart(2, '0'); // bulan (1-12)

    const newCode = yy + mm + nextNumber;

    console.log("Kode berikutnya:", newCode); // contoh: 24050024
    document.getElementById("nokntng").value = newCode;
    
  });
// }
 // Fungsi untuk menghapus baris
 function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
}

 





</script>






<script>


const rowCount = document.getElementById('duplikat').value;

function getInitials(lastName) {
  return (lastName[0]).toUpperCase()
}

const d = new Date();
const n = d.getFullYear();
const month = (d.getMonth() + 1).toString().padStart(2, '0');

function getYear() {
  // return (new Date).getFullYear() % 100
  return n.toString().substring(2)
  
}

function paddedNumber(number) {
  // var result = ""
  for(let i = 1; i < rowCount; i++) {
    // result += "0"
    document.getElementById("nokntng").value =   n.toString().substring(2) + month  + String(lastName).padStart(4, '0') ;

  }
  // return result + number
}

function makeStudentID( lastName) {
  return n.toString().substring(2) + month + String(lastName).padStart(4, '0') 
}

let counterPerMonth = {};

function generateKode() {
  const nilai = document.getElementById('duplikat').value;
  if (nilai === '') return;

  const now = new Date();
  const yy = String(now.getFullYear()).slice(-2); // 2 digit tahun
  const mm = String(now.getMonth() + 1).padStart(2, '0'); // 2 digit bulan
  const yymm = yy + mm;
  const total =  nilai *1;
 

  // Inisialisasi urutan bulan jika belum ada
  if (!counterPerMonth[yymm]) {
    counterPerMonth[yymm] = 0;
  }

  // Tambah urutan
  counterPerMonth[yymm]++;

  // Format nomor urut 4 digit
  const nomorUrut = String(counterPerMonth[yymm] + total).padStart(4, '0');

  // Gabungkan format
  const kode =  data + nilai;

  // Tampilkan
  document.getElementById('nokntng').value = kode;
}
 // Objek untuk menyimpan jumlah nomor yang sudah dibuat berdasarkan YYMM
 const dataNomor = {};

//onchange jumlah cetak 
function updateInput(ish){
    document.getElementById("jml").value = ish;
}



    const firstSelect = document.getElementById('jnskntng');
    const secondSelect = document.getElementById('typekntng');
    const threeSelect = document.getElementById('ukuran');

firstSelect.onchange = function() {
  const selectedValue = firstSelect.value;

  secondSelect.innerHTML = ''; // Clear existing options


  if (selectedValue === 'Apheresis') {
    addOption(secondSelect, 'AP', 'AP');
    addOption(secondSelect, 'AP2', 'AP2');
    addOption(secondSelect, 'AP3', 'AP3');
    addOption(secondSelect, 'APc', 'APc');
    addOption(secondSelect, 'APk', 'APk');
    addOption(secondSelect, 'APp', 'APp');
    addOption(secondSelect, 'AP', 'AP');
    addOption(threeSelect, '350 CC', '350 CC');
    addOption(threeSelect, '250 CC', '250 CC');
    addOption(threeSelect, '450 CC', '450 CC');
    addOption(threeSelect, '550 CC', '550 CC');
    
  } else if (selectedValue === 'Double Besar') {
    addOption(secondSelect, 'DB', 'DB');
    addOption(threeSelect, '350 CC', '350 CC');
    addOption(secondSelect, 'DJ', 'DJ');
    addOption(threeSelect, '450 CC', '450 CC');

  }else if (selectedValue === 'Double Kecil') {
    addOption(secondSelect, 'DK', 'DK');
    addOption(threeSelect, '250 CC', '250 CC');

  }else if (selectedValue === 'Pediatrix') {
    addOption(secondSelect, 'PD', 'PD');
    addOption(threeSelect, '450 CC', '450 CC');
    addOption(threeSelect, '350 CC', '350 CC');
    
  }else if (selectedValue === 'Quintruple') {
    addOption(secondSelect, 'QT', 'QT');
    addOption(threeSelect, '450 CC', '450 CC');

  }else if (selectedValue === 'Quadruple') {
    addOption(secondSelect, 'QR', 'QR');
    addOption(secondSelect, 'QD', 'QD');
    addOption(secondSelect, 'QW', 'QW');
    addOption(threeSelect, '450 CC', '450 CC');

  }else if (selectedValue === 'Single') {
    addOption(secondSelect, 'SG', 'SG'); 
    addOption(threeSelect, '350 CC', '350 CC');

  }else if (selectedValue === 'Triple') {
    addOption(secondSelect, 'TJ', 'TJ');
    addOption(secondSelect, 'TR', 'TR'); 
    addOption(threeSelect, '350 CC', '350 CC');
    addOption(threeSelect, '450 CC', '450 CC');

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
