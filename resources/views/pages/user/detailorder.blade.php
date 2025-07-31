@extends('backend.adm')
@section('title', 'Detail Order')

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-2 mb-3"><span class="text-muted fw-light">Transaksi /</span> Pembayaran</h4>
  
</div>

<div class="container">
        <h1 class="my-3"></h1>
        <div class="card" style="width: 25rem;">
            <div class="badge bg-warning text-white">
             
            </div>
            <br/>
            <h5 style="text-align:center;">    
            @foreach($dokter as $dok)
              {{$dok->nm_dokter}}
              @endforeach</h5>
        
            <img src="{{asset('./backend/assets/images/poli/ANA/anak1.png')}}" class="card-img-top" alt="...">

            <div class="card-body">
                <h5 class="card-title">Detail Pesanan</h5>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td> : {{$order->user->name}}</td>
                    </tr>
                    <tr>
                        <td>No Hp</td>
                        <td> : {{$order->user->email}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : {{$order->user->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Area/(Lokasi) </td>
                        <td> : {{$hrgbrg->nama}}</td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td> : {{$hrgbrg->harga}}</td>
                    </tr>
                </table>
                <button class="btn btn-primary mt-3" id="pay-button">Bayar Sekarang</button>
            </div>
        </div>
    </div>


    @endsection


    @section('scripts')
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $order->snap_token }}', {
          // Optional
          onSuccess: function(result){
            //
            window.location.href = '{{route('pesanan-success', $grand->id) }}';
            /* You may add your own js here, this is just example */ 
        
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
  
  
    @endsection