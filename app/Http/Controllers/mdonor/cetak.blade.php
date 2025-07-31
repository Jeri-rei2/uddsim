
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
      {{-- @dd($cetak) --}}
      

       {{-- @dd($cetak) --}}
      @if (!$cetak->count())
         <h5>Tidak Ada data</h5>
         @else
    <table border="1" style="width: 395px;">
      <tr>
       <td>
        <p><h5 class="card-title">{{$cetak->namadonor}} </h5></p>
        <p> {{$cetak->tgllahir}}</p>
             <div class="mt-4 mb-2 text-end">
                   <p> <b>Golongan Darah </b></p>
              </div>
              <div class="mt2 mb-6 text-end">
                   <p> <b> <H3>B +</H3></b></p>
              </div>
        <p> <left>{!! DNS1D::getBarcodeHTML(002 . $cetak->nodonor, 'C128' ,1,35) !!}</left>
          <left> {{$cetak->nodonor}} </left></p>

       </td>
       
       </tr>
           
    </table>
       @endif
  </div>
  <script>
        window.print();
    </script>
        
        <script>
   window.print();

  
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
