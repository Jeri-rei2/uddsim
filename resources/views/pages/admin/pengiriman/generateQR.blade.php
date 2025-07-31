@extends('layouts.main')
@section('title', 'Cetak ')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<style>
 
</style>
</head>
<body>

<!-- <h2>No Pengiriman</h2> -->
 <table  style="width: 535px;">
    <tr >
        <td> <p style="float: left;  font-size: 12px;"><b>UDD PMI KOTA Surabaya </b> <br/>
        Jl.Embong Ploso No.7-15 </p>
                   
            
        </td>
      
      
    </tr>
    <tr>
        
    <td>
      <p style="float: right;  font-size: 19px;"><b>{{$data->nokeluar }}
        <br/>{{$tglkirim}} <b> </p>
      
      <br/> <br/>
      <hr><br/>
                    <center >
                <p class="font-bold" style="font-size: 10px;">
                             {!! $qrcode !!} 
                    </center>
                    <center> NO BOX :  {{$data->nokeluar }} </center>
                    <center> {!! DNS1D::getBarcodeHTML($data->nokeluar , 'C128',1.5,45) !!} </center>
                </p>
       <hr>
                    <center>
                            Jumlah produk : 32 Kantong <br>
                          Tanggal donasi awal: 12-12-2024 <br>
                          Tanggal donasi akhir: 12-12-2024
                    </center>
       <hr>

    </td>
    </tr>
    </table>
    <br/>
<table style="width: 535px;  border: 1px solid black; border-collapse: collapse;">

  <tr >
  @foreach($minta as $key)
      @if( (($loop->iteration-1)  % 3) == 0 )
          </tr>
          <tr>
      @endif
      <td style="width: 535px;  border: 1px solid black; border-collapse: collapse;" class="border-b py-3 pl-2">{!! DNS1D::getBarcodeHTML($key->nopermintaan. $key->nostok, 'C128',1.5,45) !!} 
      &nbsp;{{$key->nostok}}  &nbsp;&nbsp; 
      </td>
  @endforeach()
  </tr>
 
</table>

<br/>
<div class="button-action" style="margin-bottom: 20px">
    <!-- <button type="button" onclick="window.print();" class="btn btn-success" data-toggle="modal" data-target="#import">
        Cetak
    </button>
     -->
    <!-- <a href="" class="btn btn-primary btn-md">Export Excel</a> -->

</div>
<script>
        window.print();
    </script>
    
<script>
 $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>

</body>
</html>



@endsection









