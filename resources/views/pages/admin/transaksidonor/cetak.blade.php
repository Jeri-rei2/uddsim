
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

          <div><center style="font-size: 18px; font-weight: bold;">PERMINTAAN KANTONG DARAH AFTAP KE GUDANG </center> </div>
          <br/>
          <br/>


          <div style="text-align: left; font-weight: bold;"> NO MINTA AFTAP :  {{$get->notrans}}</div>
          <table border="1" class="table table-bordered">
            <thead>
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Merk Kantong</th>
                  <th scope="col">Jenis Kantong</th>
                  <th scope="col">Ukuran Kantong</th>
                  <th scope="col">Jumlah</th>
                  <!-- <th scope="col">No Stok</th> -->
              </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                      @php $total = 0; @endphp

                @foreach($data as $item)
                  @php
                      $total += $item['jumlah'];
                  @endphp
                 <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->merk}}</td>
                    <td>{{$item->jnsktg}}</td>
                    <td>{{$item->ukktg}}</td>
                    <td>{{number_format($item->jumlah)}}</td>
                  </tr>
                @endforeach
              </tbody>
               <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th>{{ number_format($total, 0,) }}</th>
                </tr>
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
