
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title></title>

    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
      .logo-horizontal {
      display: flex;
      align-items: center; /* logo dan teks sejajar secara vertikal */
      gap: 10px; /* jarak antara logo dan teks */
      font-family: Arial, sans-serif;
    }

    .logo-horizontal img {
      width: 50px;
      height: 50px;
    }

    .logo-text {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }
     .waktu-container {
            display: flex;
            gap: 15px;
            font-size: 20px;
            font-weight: bold;
            align-items: center;
        }
         .ttd-container {
      display: flex;
      justify-content: space-between;
      margin-top: 50px;
      padding: 0 40px;
    }

    .ttd-box {
      text-align: center;
      width: 45%;
    }

    .ttd-line {
      margin-top: 80px;
      border-top: 1px solid #000;
      width: 100%;
    }

    .ttd-name {
      margin-top: 5px;
      font-weight: bold;
    }

    .ttd-title {
      font-style: italic;
      font-size: 14px;
    }
     .wrapper {
    display: flex;
  }

  .kiri {
    width: 30%;
    background-color: #d1ecf1;
  }

  .kanan {
    width: 70%;
    background-color: #f8d7da;
  }
  </style>
  </head>
  <body onload="window.print()">
    
<main>
  <div class="container py-4">
  

    <div class="row align-items-md-stretch mb-2">
    
          <div class="logo-horizontal">
            <img src="{{asset('sneat/assets/img/logok.png')}}" alt="Logo" style="text-align: left; width: 35px; height: 35px;">
            <div class="logo-text" style="font-size: 14px; font-weight: bold;">Palang Merah Indonesia <br/>
             UDD PMI KOTA SURABAYA </div>
          </div>

          <div><center style="font-size: 18px; font-weight: bold;">FORMULIR PENGANTAR DARAH & SAMPLE  </center> </div>
          <br/>
          <br/>
        <div style="display: flex;">
            <div style="width: 80%;">
              <!-- Kiri -->
               <div style="text-align: left; font-weight: bold;"> NO FPD :  {{$get->nofpd}} </div>
               <div style="text-align: left; font-weight: bold;"> TGL FPD :  {{$get->tglfpd}} </div>
            </div>
            <div style="width: 80%;">
               <div style="text-align: center; font-weight: bold;">NAT / BIASA  : {{$get->xx}}</div>

            </div>

            <div style="width: 80%;">
              <!-- Kanan -->
               <div style="text-align: right; font-weight: bold;"> ASAL DARAH : 0000   | {{$get->asldrh}}</div>
               <div style="text-align: right; font-weight: bold;"> 
               
              
              </div>
            </div>
          </div>


         
          
          <table border="1" class="table table-bordered">
            <thead>
                <?php $i=1; ?>
                      @php $total = 0; @endphp

                  <tr>
                      <th scope="col">No</th>
                      <th scope="col">No AFTAP</th>
                      <th scope="col">NO Kantong</th>
                      <th scope="col">Jenis </th>
                      <th scope="col">UKURAN </th>
                      <th scope="col">PENUH  </th>
                      <th scope="col">SAMPEL </th>
                      <th scope="col">JNS DONOR </th>
                      <th scope="col">ASL DARAH </th>
                      <th scope="col">PTGS </th>
                      <th scope="col">GOL </th>
                      <th scope="col">RH </th>
                      <th scope="col">No FPUP </th>
                      <th scope="col">KETERANGAN </th>
                      <th scope="col">ID </th>
                      <th scope="col">DURASI </th>



                      <!-- <th scope="col">No Stok</th> -->
                  </tr>

              </thead>
              <tbody>
         @foreach($data2 as $item)
                 
                 <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->noaftap}}</td>
                    <td>{{$item->nokntng}}</td>
                    <td>{{$item->jnskntng}}</td>
                    <td>{{$item->ukuran}}</td>
                    <td>Ya</td>
                    <td>Ya</td>
                    <td>{{$item->jnsdonor}}</td>
                    <td>0000</td>
                    <td>{{$item->ckdptgs}}</td>
                    <td>{{$item->goldar}}</td>
                    <td>{{$item->rhesus}}</td>
                    <td></td>
                    <td>{{$item->ket}} <input type="checkbox" id="" name="" value="Bike"> <input type="checkbox" id="" name="" value="Bike"></td>
                    <td></td>
                    <td>{{$item->durasi}}</td>


                  </tr>
             @endforeach
           
              </tbody>
              
          </table>

            <table border="1" class="table table-bordered" style="width:38%">
         @foreach($data2 as $item)

              <tr>
                <td></td>
                <td>A + </td>
                <td>Total</td>
                <td>O +</td>
                <td>Total</td>

              </tr>
              <tr>
                <td><b> {{$item->jnskntng}} </b> </td>
                <td></td>
                <td></td>
              </tr>
             @endforeach

               <tfoot>
         @foreach($data as $items)

                <tr>
                    <th colspan="2">Total</th>
                
                    <th>{{$items->total}} </th>



                </tr>
             @endforeach


            </tfoot>
            </table>


          <div class="waktu-container" style="font-size: 14px;" >
            Dicetak Tgl :
              <div id="tanggal"></div>
              <div>|</div>
              <div id="jam"></div>
              
          </div><br/><br/>
         
          <div class="ttd-container">
            <!-- TTD Kiri -->
            <div class="ttd-box">
              <div class="">Petugas Yang Meminta</div>
              <div class="ttd-line"></div>
              <div class="ttd-name">Nama Pihak 1</div>
              <!-- <div class="ttd-title">Jabatan / Posisi</div> -->
            </div>

            <!-- TTD Kanan -->
            <div class="ttd-box">
              <div class="">Mengetahui</div>
              <div class="ttd-line"></div>
              <div class="ttd-name">Nama Pihak 2</div>
              <!-- <div class="ttd-title">Jabatan / Posisi</div> -->
            </div>
          </div>
          
 
 
      
  </div>
  <script>
       function updateWaktu() {
            const sekarang = new Date();

            // Format tanggal: Rabu, 5 Juni 2025
            const optionsTanggal = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const tanggal = sekarang.toLocaleDateString('id-ID', optionsTanggal);

            // Format jam: 14:35:08
            const jam = sekarang.toLocaleTimeString('id-ID', { hour12: false });

            // Tampilkan di HTML
            document.getElementById('tanggal').textContent = '🗓️ ' + tanggal;
            document.getElementById('jam').textContent = '⏰ ' + jam;
        }

        updateWaktu();
        setInterval(updateWaktu, 1000); // Update setiap detik
    </script>
    

</main>

<div class="container-fluid">
    
    <footer class="py-4 text-muted border-top" style="position: absolute; bottom: 0">
        &copy; <?= date('Y'); ?>
    </footer>    
</div>


    

<script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  </body>
</html>
