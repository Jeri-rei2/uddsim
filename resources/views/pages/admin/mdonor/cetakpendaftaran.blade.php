
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

  </head>
  <body>
    <style>
    
    </style>
<main>
  <div class="container py-4">
  

    <div class="row align-items-md-stretch mb-2">
    @if (!$antri->count())
    @else
    
    
    <table border="1" style="width: 455px;">
      <tr>
       <td>
         <p><b> Palag Merah Indonesia </b> </br>
            UDD PMI KOTA SURABAYA</p>
     
            
              <div class="mt1 mb-1 text-end">
              
              @if (!$antri->count())
              @else
                <b><div style="font-size: 35px;"> {{ $antri[0]->no_antrian }}  {!! $qrcode !!}</div></b>
                     <div style="font-size: 8px;">Scan me</div>
               
              </div>
              @endif 
          <p> <b>PENDAFTARAN DONOR </b><br/>---------------------------------------------------------------------
          No Daftar :   {{$donor->nodonor}}   ||  {{$donor->tgldaftar}}<br /> 
          No Regisrasi :   {{$donor->noaftp}}  <br /> 
          Nama Donor :   {{$donor->namadonor}}  <br />   
          Jenis Kelamin :   {{$donor->jk}}   &nbsp; &nbsp;&nbsp;&nbsp;         Tgl Lahir :  {{$donor->tgllahir}} <br/>
          Gol darah- Rh : {{$donor->goldar}} &nbsp; &nbsp;&nbsp;&nbsp;         Donor Ke  :  {{$donor->donorke}} <br/>
          ---------------------------------------------------------------------
          <b style="text-decoration-line: underline;">Pemeriksaan Darah Awal </b> <br /> 
          Gol Darah- Rh :    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   HB :    <br /> 
          Petugas Periksa: <br />
          Tanggal / Jam :    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   BB :     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HCT :  
          <br />
          ---------------------------------------------------------------------
          <b style="text-decoration-line: underline;">Pemeriksaan Kesehatan </b> <br /> 
          Hasil Periksa :     &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tensi :   <br/>
          Petugas Periksa :   &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Jns Kantong : <br/>
          Tanggal / Jam :     &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; CC diambil : <br/>
          ----------------------------------------------------------------------
          <b style="text-decoration-line: underline;">Aftaper </b> <br /> 
          Petugas Aftap :  <br/>
          Tanggal / Jam :  <br/>
          ----------------------------------------------------------------------
          Harap Kembali Setelah Tanggal:            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
         15/05/2025
          </p>
          <p> <b> </b>   </p>    
      

       
       </td>
       
       </tr>
      
      &nbsp; &nbsp;&nbsp;&nbsp; 
    </table>
    @endif 

  </div>


</main>

<div class="container-fluid">
    
    <footer class="py-4 text-muted border-top" style="position: absolute; bottom: 0">
       
    </footer>    
</div>


    
<script src="https://cdn.rawgit.com/mrdoob/three.js/master/examples/js/loaders/GLTFLoader.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
  @if(isset($a))
  @foreach($donor as $a)  
  function addDays(date, days) {
   
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
    
}

    // Example
    const newDate = addDays(14-05-2025 , 61);
   document.getElementById("view").innetHTML = "" + newDate;
   
    console.log(newDate.toDateString());
    @endforeach
    @endif
 
        window.print();
  
    
</script>
  </body>
</html>
