@extends('backend.adm')
@section('title', 'Pembayaran Berhasil')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-success">Pembayaran Berhasil</h1>
                  <p class="text-success">Terimakasih Telah Melakukan Pembayaran Obat</p>
                <a href="{{route('resepmasuk')}}" class="btn btn-primary mt-3"> Lihat Rincian </a>
            </div>
        </div>
    
    </div>





@endsection