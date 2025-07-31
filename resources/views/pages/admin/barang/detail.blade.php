@extends('layouts.main')
@section('title', 'Detail Barang')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang / </span> Detail Barang</h4>


<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                Detail Barang
            </div>
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-md-4 mb-3">
                        <img src="{{asset('product_image')}}/{{$barang->foto}}" class="img-fluid img-thumbnail rounded" alt="product image">
                    </div>
                    <div class="col-md-8" style="padding-left: 30px">
                        <h4 class="card-title">{{$barang->nmbrg}}</h4>
                        <p class="card-text my-1">Tipe <span class="mx-2">:</span> {{$barang->nmbrg}}</p>
                        <p class="card-text my-1">Panjang <span class="mx-2">:</span> {{$barang->nmbrg}} </p>
                        <p class="card-text my-1">Lebar <span class="mx-2">:</span> {{$barang->nmbrg}} </p>
                        <p class="card-text my-1">Harga <span class="mx-2">:</span> Rp. {{$barang->hrbrg}}</p>
                        <p class="card-text my-1">In Stock <span class="mx-2">:</span> {{$barang->nmbrg}}</p>
                        <p class="card-text my-1">Stock Terjual <span class="mx-2">:</span> {{$barang->nmbrg}}</p>
                        <p class="card-text my-1">Kategori <span class="mx-2">:</span> {{$barang->nmbrg}}</p>
                        <p class="card-text my-1">Keterangan <span class="mx-2">:</span> {{$barang->nmbrg}}</p>

                    </div>
                </div>
                <div class="mt-4 text-end">
                    <a href="{{route('barang.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
