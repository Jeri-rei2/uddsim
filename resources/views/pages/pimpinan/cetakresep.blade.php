<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resep Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">
                        <img src="{{asset('fe/assets/kop.png')}}" class="rounded" style="width: 560px">
                    </div>
                    <div class="col-xl-3 float-end">
                        <a class="btn text-capitalize border-0" data-mdb-ripple-color="dark" onclick="window.print()"><i class="fas fa-print text-primary"></i> Print</a>
                    </div>
                    <hr style="  border: 3px solid black;">
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <!-- <p class="pt-0 display-6">RESEP</p> -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                            @forelse ($alamat as $data)
                                <li  style="color:#000000 ;">Dokter  : <span style="color:#5d9fc5 ;">  &nbsp;&nbsp;&nbsp;<b> {{$data->dokter}}</b> </span></li>
                                <li  style="color:#000000 ;">Tanggal : <span style="color:#000000 ;">  &nbsp;&nbsp;<b>{{\Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY')}}</b> </span></li>
                                @empty
                            <div class="alert alert-danger">
                                Data resep belum Tersedia.
                            </div>
                                @endforelse
                            </ul>
                        </div>
                      
                    </div>






                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    @forelse ($cetak as $obat)
                    <div class="row">
                        <div class="col-xl-8">
                           <ul class="list-unstyled">
                            <li><b>{{$obat->obat }} &nbsp;&nbsp;&nbsp;&nbsp; {{$obat->jumlah }} <b> &nbsp;&nbsp;&nbsp; 
                                         {{$obat->aturanpakai }} <b>  </li>  
                           </ul>


                       </div>
                    </div>
                    @empty
                    <div class="alert alert-danger">
                        Data resep belum Tersedia.
                    </div>
                    @endforelse
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
    
                
                    
                    <hr>
                                @forelse ($alamat as $data)
                    <div class="row">
                    <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li  style="color:#000000 ;">Nama   : <span style="color:#color:#000000;"> &nbsp;&nbsp;&nbsp; <b>{{$data->pasien}} </b></span></li>
                                @empty
                                <div class="alert alert-danger">
                                    Data nama tidak ada
                                </div>
                                @endforelse
                                <li  style="color:#000000 ;">Alamat : <span style="color:#color:#000000;"> &nbsp;&nbsp; <b>-</b> <b>
                                    @forelse($alamat as $alt)
                                    -</b> </span>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data alamat tidak ada
                                    </div>
                                    @endforelse
                                   
                                </li>
                                <li  style="color:#000000 ;">No.ID :</li>

                              
                            </ul>
                        </div>


                        <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
               
                    <hr>
                        <div class="col-xl-10">
                            <p>Terima Kasih Sehat Selalu</p>
                        </div>
                    </div>
                 

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
