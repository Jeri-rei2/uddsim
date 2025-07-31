@extends('backend.adm')

@section('content')

    <div class="section-body">

    <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Tentang Rs setting</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                      <a class="nav-link active" id="Foto-tab3" data-toggle="tab" href="#Foto3" role="tab" aria-controls="Foto" aria-selected="true">Tentang Rs</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="Foto3" role="tabpanel" aria-labelledby="Foto-tab3">
                    <div class="card">
    
                  <div class="card-body">
                  <form action="{{url('upload/artikel')}}" method="post" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="judul" name="judul">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                      <div class="col-sm-12 col-md-7">
                      <textarea name="deskripsi" class="form-control" id="deskripsi" name="deskripsi"></textarea>
                      </div>
                    </div>
                    <div class="text-right">
                    <button type="submit" id="tombol-simpan" class="btn btn-warning"><i class="fas fa-upload"></i> Upload</button>
                    </div>
                </form>

                <div class="card-body">
                <button class="btn btn-success" data-toggle="collapse" href="#tambah" role="button" aria-expanded="false" aria-controls="collapseExample">
                       Edit Artikel <i class="fa fa-edit" aria-hidden="true"> </i> 
                      </button>

                      <div class="collapse" id="tambah">
                        <div class="mt-2">
                        <legend>Edit Artikel</legend>
                      </div>
                        <form action="{{url('update-artikel')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @foreach ($data_artikel as $item)
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $item->judul }}">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                      <div class="col-sm-12 col-md-7">
                      <textarea name="deskripsi" class="form-control" id="deskripsi" name="deskripsi">{{ $item->deskripsi }}</textarea>
                      </div>
                    </div>
                    @endforeach
                    <div class="text-right">
                    <button type="submit" id="tombol-simpan" class="btn btn-warning"><i class="fa fa-upload"></i> Ganti</button>
                    </div>
                </form>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
@endsection
