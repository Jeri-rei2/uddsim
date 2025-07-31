<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
        }
    </style>
</head>
<body>
    {{-- @dd($tiket[0]->loket->deskripsi); --}}
    @if (!$tiket->count())
   
    <h5>Tidak Ada Antrian HB</h5>

         @else
         <div class="container" style="width: 300px; border: 1px; text-align: center; padding: 20px;">
    <img src="{{asset('sneat/assets/img/logok.png')}}" alt="Logo" width="38" height="38" class="d-inline-block align-text-top">
            <h6 style="font-size: 15px; margin: 0%"> UDD PMI KOTA SURABAYA </h6>
        <h6 style="font-size: 25px; margin: 0%">{{ $tiket[0]->loket->deskripsi }}</h6>
        <h1 style="font-size: 100px; margin: 0;">{{ $tiket[0]->no_antrian }}</h1>
        <h6 style="font-size: 25px; margin: 0%">Ruang {{ $tiket[0]->ruang }}</h6>
        <h6 style="font-size: 12px; margin: 0%">{{ 'Surabaya, ' . date('d-M-Y'); }}</h6>
    
    </div>
   
    <div class="col-md-6">
        <a href="" class="btn btn-sm btn-danger" target="_blank" rel="noopener noreferrer"><i class='bx bxs-printer'></i> Cetak Antrian HB</a>
        <a href="{{route('send-email-pdf')}}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer"> <i class='bx bx-book' ></i>Kirim Antrian</a>
    </div>

       @endif

</body>
</html>