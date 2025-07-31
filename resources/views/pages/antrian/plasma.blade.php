<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="10" > 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
      body{
        background-image: url('/img/working-bg.jpg');
        margin: 0;
        padding: 0;
     height: 100%;
      }
    </style>
  </head>
  <body>
    
    <nav class="navbar navbar-dark bg-danger">
        <div class="container">
          <a class="navbar-brand text-black bg-white p-2 rounded-3" href="#">
            <img src="{{asset('sneat/assets/img/logok.png')}}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
         UDD PMI KOTA SURABAYA
          </a>

          <div class="d-flex">
            <h6 class="text-white">{{ 'Surabaya, ' . date('d-M-Y'); }}</h6>
          </div>
        </div>
    </nav>

    <div class="container-fluid px-7 mt-1 position-relative" style="min-height:91vh !important;padding-bottom:100px;">
      <div class="row">
              <div class="col-md-4">      
              <div class="row p-2">
                  <div class="col-sm">
                      <div class="card text-center">
                        @if (!empty($loket1) &&  !empty($loket1->status == 'menunggu'))
                           <h5 class="card-header bg-warning text-white"> </h5>
                          <div class="card-body">
                          <h5 class="card-header bg-danger text-white"> RUANG </h5>
                            <h1 class="card-text" style="font-size: 100px; margin: 0;">
                              {{ $loket1->ruang }}
                            </h1>
                          </div>
                          <h5 class="card-header bg-danger text-white">Antrian {{ $loket1->nomor }}</h5>
                          <h5 class="card-header bg-warning text-white"> </h5>

                        @else
                          <h5>Belum Ada Antrian</h5>
                       
                        @endif
                      </div>
                  </div>
              </div>
              
              <div class="row p-2">
                <div class="col-sm">
                    <div class="card text-center">
                    @if (!empty($loket2) && !empty($loket2->status == 'dipanggil'))
                 
                      <h5 class="card-header bg-success text-white"> </h5>
                          <div class="card-body">
                          <h5 class="card-header bg-warning text-white"> RUANG</h5>
                            <h1 class="card-text" style="font-size: 100px; margin: 0;">
                              {{ $loket2->ruang }}
                            </h1>
                          </div>
                          <h5 class="card-header bg-warning text-white">Antrian {{ $loket2->nomor }}</h5>
                          <h5 class="card-header bg-success text-white"> </h5>

                        @else
                             <h5>Belum Ada Antrian</h5>
                        @endif
                    </div>
                </div>
            </div>
                
            </div>
  
            <div class="col-8">
                <div class="row">
                  <div class="card mt-2 border-0" style="background-color: rgba(0, 0, 0, 0)">
                  <div class="col-sm">
                      <div class="card text-center">
                        @if (!empty($loket1) &&  !empty($loket1->status == 'menunggu'))
                        <h5 class="card-header bg-danger text-white">ANTRIAN Periksa Dokter </h5>
                          <div class="card-body">
                            <h5 class="card-title">Nomor Antrian</h5>
                            <h1 class="card-text" style="font-size: 100px; margin: 0;">
                              {{ $loket1->nomor }}
                            </h1>
                          </div>
                          <h5 class="card-header bg-danger text-white">RUANG {{ $loket1->ruang }}</h5>

                        @else
                          <h5>Belum Ada Antrian</h5>
                       
                        @endif
                      </div>
                   </div>
                </div>
              </div>
              <div class="col-13">
                <div class="row">
                  <div class="card mt-2 border-0" style="background-color: rgba(0, 0, 0, 0)">
                  <div class="col-sm">
                      <div class="card text-center">
                        @if (is_array($loket2))
                            <h5 class="card-header bg-success text-white">ANTRIAN {{ strtoupper($loket2->loket->deskripsi)  }}</h5>
                          <div class="card-body">
                            <h5 class="card-title">Nomor Antrian</h5>
                            <h1 class="card-text" style="font-size: 100px; margin: 0;">
                              {{ $loket2->nomor }}
                            </h1>
                          </div>
                          <h5 class="card-header bg-success text-white">RUANG {{ $loket2->ruang }}</h5>
                        @else
                          <h5>Belum Ada Antrian</h5>

                        @endif
                      </div>
                   </div>
                </div>
              </div>
            </div>
            </div>

          
             
        </div>
      

        <div class="footer position-absolute mx-0 start-0 end-0 bottom-0 border-top border-4 border-success">
          <div class="card bg-dark rounded-0">
              <div class="card-body">
                <marquee behavior="" direction="" class="text-white">
                  <img src="{{asset('sneat/assets/img/logok.png')}}" width="30" height="30" alt=""> Selamat Datang di Sistem Informasi Antrian UDD PMI KOTA SURABAYA, Untuk Informasi Lebih lanjut Hubungi, CS: </marquee>
              </div>
          </div>
      </div>
      </div>
      
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>