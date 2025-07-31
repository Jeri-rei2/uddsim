@extends('backend.adm')

@section('content')
<div class="section-body">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Input Layanan</h4>
                  </div>
 @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Input gagal.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
         <form method="post" action="{{ route('simpanlayanan') }}" >
                  @csrf
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Anak</label>
      <input type="text" class="form-control" id="polianak" name="polianak" required/>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Kandungan</label>
      <input type="text" class="form-control" id="polikandungan" name="polikandungan" required/>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Bedah</label>
      <input type="text" class="form-control" id="polibedah" name="polibedah" required/>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Penyakit Dalam</label>
      <input type="text" class="form-control" id="polipenyakitdalam" name="polipenyakitdalam" required/>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Orthopedi</label>
      <input type="text" class="form-control" id="poliorthopedi" name="poliorthopedi" required/>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Umum</label>
      <input type="text" class="form-control" id="poliumum" name="poliumum" required/>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Gigi</label>
      <input type="text" class="form-control" id="poligigi" name="poligigi" required/>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">-Poli Khitan</label>
      <input type="text" class="form-control" id="poiikhitan" name="polikhitan" required/>
  </div>
  </div>
  
@foreach ($inputlayanan as $item)
<div class="text-danger"><h7>*Hapus data sebelum input yang baru</h7>
</div>
<div class="col-3">
      <a class="btn btn-danger btn-sm" data-id="{{ $item->id }}" href="{{ url('deletelayanan',$item->id)}}">
                              <i class="fas fa-trash">
                              </i>
                              Hapus Data
                          </a>   
                  </div>
@endforeach
  <div class="card-footer">
                <div class="row">
                  <div class="col-lg-10">
                  </div>
                  <div class="col-lg-2">
                  
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                  </div>
                </div>
                </form>


  @endsection