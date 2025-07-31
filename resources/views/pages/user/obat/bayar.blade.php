@extends('backend.adm')
@section('title', 'Bayar Resep')

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-2 mb-3"><span class="text-muted fw-light">Pembayaran /</span> Resep</h4>
  
</div>

<div class="container">
        <h1 class="my-3"></h1>
        <div class="card" style="width: 59rem;">
            <div class="badge bg-warning text-white">
             
            </div>
            <br/>
            <h5 style="text-align:center;">    
           </h5>

            <div class="card-body">
                <h2 class="card-title">Detail Pembayaran </h2>
             
                <table>
                <input type="hidden" name="obat_id[]" class="obat_id">
                @forelse ($userbayar as $data)
                    <tr>
                        <td style="display: inline-block; font-size: 18px;">Nama Pasien</td>
                        <td style="display: inline-block; font-size: 18px;"> : &nbsp; {{$data->pasien}}</td>
                    </tr>
                @empty
                <div class="alert alert-danger">
                    Data Resep belum Tersedia.
                </div>
                @endforelse
                 
                    <tr>
                        
                        <td style="display: inline-block; font-size: 18px;">Resep Obat</td>
                       
                        <td style="display: inline-block; font-size: 18px;">&nbsp;&nbsp; : 
                        @forelse ($resep as $ob)  
                         <b> &nbsp;{{$ob->obat}}&nbsp; &nbsp;  ( {{$ob->jumlah}} )&nbsp;  ( {{$ob->aturanpakai}} )
                         &nbsp; &nbsp;  <br/> &nbsp; &nbsp; 
                         </b>
                         @empty
                        <div class="alert alert-danger">
                            Data Resep belum Tersedia.
                        </div>
                        @endforelse
                        </td>
                      
                    </tr>
              
                    <tr>
                        <td style="display: inline-block; font-size: 18px;">Catatan Dokter </td>
                        <td style="display: inline-block; font-size: 18px;"> : 
                        @forelse ($resep as $ob)   
                        &nbsp;{{$ob->keterangan}}
                        @empty
                        <div class="alert alert-danger">
                            Data Resep belum Tersedia.
                        </div>
                        @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td style="display: inline-block; font-size: 18px;">Dokter Pemberi Resep </td>
                        <td style="display: inline-block; font-size: 18px;"> : 
                        @forelse ($dokter as $dok)   
                        {{$dok->dokter}}
                        @empty
                        <div class="alert alert-danger">
                            Data Resep belum Tersedia.
                        </div>
                        @endforelse

                        </td>
                    </tr>
                    <tr>
                        <td style="display: inline-block; font-size: 18px;">Total Harga</td>
                        <td style="display: inline-block; font-size: 18px;"> : 
                        @foreach ((array) $harga as $total)  
                        Rp.  &nbsp;<b>{{$total}}<strong class="grandtotal">0</strong><b>
                        &nbsp;
                        @endforeach

                        </td>
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
        snap.pay('{{$bayar->snap_token}}', {
          // Optional
          onSuccess: function(result){
            //
            window.location.href = '{{route('obat-success', $resepkan->id) }}';
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

      let barang_id = document.querySelector('.barang_id');
      barang_id.value = bid
      bid.push(value.id)
    </script>
  
  
    @endsection