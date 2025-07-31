@extends('backend.adm')
@section('title', 'Dokter Home')

@push('custom-css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <style>
        #map { height: 180px; }
    </style>

@endpush

@section('scripts')
@if (\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
@endif

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-2 mb-3"><span class="text-muted fw-light">Dokter /</span> Periksa</h4>
  
</div>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-0">
            <div class="container-fluid py-5">
                <div class="row">
                    <aside class="col-lg-9">
                       
                        <div class="card mb-3">

                            <div class="table-responsive">
                                <form action="" method="POST">
                                    @csrf
                                    @method('POST')

                                    <table class="table table-bordered table-shopping-cart">
                                      @foreach ($periksa as $order)
                                        <thead class="text-muted">
                                        @if ($order->user_id)
                                           
                                            <tr class="small text-uppercase">
                                                <th scope="col" width="20%" class="align-middle">Nama</th>
                                                <th scope="col"><input type="text" name="nama" class="nama form-control" id="nama" value="{{$order->user->name}}" readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Email</th>
                                                <th scope="col"><input type="text" name="email" class="email form-control" id="email" value="{{$order->user->email}}"readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Nomor Handphone</th>
                                                <th scope="col"><input type="text" name="phone_number" class="phone_number form-control" id="phone_number" value="{{$order->user->phone_number}}"readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">NIK (KTP)</th>
                                                <th scope="col"><input type="text" name="nik" class="nik form-control" id="nik" value="{{$order->user->nik}}"readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Alamat Lengkap</th>
                                                <th scope="col"><input type="text" name="alamat" class="alamat form-control" id="alamat" value="{{$order->user->alamat}}"readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Keluhan</th>
                                                <th scope="col"><input type="text" name="alamat" class="alamat form-control" id="alamat" value="{{$order->keluhan}}"readonly></th>
                                            </tr>
                                        </thead>
                                        @elseif($order->user->id)

                                        @else
                                        @endif

                                        @endforeach
                                    </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                            <div id="googleMap" style="width:100%;height:400px;"></div>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-lg-3">
                        <div class="card">
                            <input type="hidden" name="quantity[]" class="quantity">
                            <input type="hidden" name="total" class="input_total">
                            <input type="hidden" name="barang_id[]" class="barang_id">
                            <input type="hidden" name="harga[]" class="harga">
                            <input type="hidden" name="nik[]" class="nik">
                            <input type="hidden" name="alamat[]" class="alamat">
                            <!-- <input type="hidden" name="keluhan[]" class="keluhan"> -->

                              
                            <div class="card-body">
                            @foreach ($periksa as $order)
                               @if ($order->user->id)
                              <th><a href="https://api.whatsapp.com/send?phone=62{{$order->user->phone_number}}" class="btn btn-success btn-sm float-right"><i class="fa fa-whatsapp" aria-hidden="true"> </i> Chat Pasien</a></th>
                              <th><a href="https://www.google.com/maps/place/{{$order->user->alamat}}" class="btn btn-warning btn-sm float-left"><i class="fa fa-map-marker" aria-hidden="true"> </i> Lihat Map</a> </th>
                           
                              <th>   <br />    <br /> 
                              <form action="{{ route('otwperiksa.update', $order->id) }}"method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                 <input type="hidden" name="pesanan_id" value="{{$order->id}}">

                                 <!-- <input type="hidden" name="name" value="{{$order->name}}"> -->
                                 <input type="hidden" name="status" value="Sudah Diperiksa">
                                 <input type="hidden" name="user_id" value="{{$order->user_id}}">
                                 <input type="hidden" name="total_harga" value="{{$order->total_harga}}">
                                 <input type="hidden" name="snap_token" value="{{$order->snap_token}}">
                                 <input type="hidden" name="keluhan" value="{{$order->keluhan}}">
                                 
                                

                                 <button type="submit" class="btn btn-danger btn-sm float-center">
                                      <i class="fa fa-check" aria-hidden="true"> </i> Konfirmasi Kedatangan</a> </th>
                                </form>
                             
                              @elseif($order->user->id == "2")
                            @else
                            @endif

                            @endforeach
                             
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <!-- Footer-->
    </section>






@endsection


<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="{{asset('/vendor/datatables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 