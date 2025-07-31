@extends('backend.adm')

@section('content')

    <div class="section-body">

    <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Dokter setting</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="Foto-tab3" data-toggle="tab" href="#Foto3" role="tab" aria-controls="Foto" aria-selected="true">Dokter</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="Foto3" role="tabpanel" aria-labelledby="Foto-tab3">
                      <div class="row">
                        <div class="col-13">
                            <div class="card">
                                <div class="card-body">
                                    {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{url('upload/dokter')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="gambar_dokter" name="gambar_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('gambar_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                         <label>Nama Dokter</label>
                                         <input type="hidden" class="form-control" id="kd_dokter" name="1">
                                         <input type="text" class="form-control" id="nama_dokter" name="nama_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('nama_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                         <label>Jabatan Dokter</label>
                                         <input type="text" class="form-control" id="jabatan_dokter" name="jabatan_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('jabatan_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <button type="submit" id="tombol-simpan" class="btn btn-warning"><i class="fas fa-upload"></i> Upload</button>                     
                                      </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                                
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Nama Dokter</th>
                                            <th scope="col">Jabatan Dokter</th>
                                            <th scope="col">Aksi</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- menampilkan data  --}}
                                        @foreach ($data_dokter as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                {{-- jika ekstensi file adalah png, jpg atau jpeg maka tampilkan gambar  --}}
                                                @if( in_array(pathinfo($item->gambar_dokter, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                                <!-- <div class="gallery-item" data-image="{{asset('/public/file_upload')}}/{{$item->file}}" data-title="Image 1" href="{{asset('/public/file_upload')}}/{{$item->file}}" title="Image 1" style="background-image: url(&quot;{{asset('/public/file_upload')}}/{{$item->file}}&quot;);">
                                              </div>     -->
                                                <img src="{{asset('berkas_dokter')}}/{{$item->gambar_dokter}}" style="height: 50%">
                                                @else
                                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                                    style="height: 10%">
                                                @endif
                                            </td>
                                            <td>{{$item->nama_dokter}}</td>
                                            <td>{{$item->jabatan_dokter}}</td>
                                            <td>
                                        <a href="" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#ModalEdit"><i class="far fa-edit"></i> Ubah</a>
                                            &nbsp;
                                            <a href="{{ url('delete-dokter',$item->id) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

<div class="modal fade" tabindex="-1" role="dialog" id="ModalEdit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="card-body">
                                    {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{ url('update-dokter') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="gambar_dokter" name="gambar_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('gambar_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                         <label>Nama Dokter</label>
                                         <input type="text" class="form-control" id="nama_dokter" name="nama_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('nama_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                         <label>Jabatan Dokter</label>
                                         <input type="text" class="form-control" id="jabatan_dokter" name="jabatan_dokter">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('jabatan_dokter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror  
                                        <button type="submit" id="tombol-simpan" class="btn btn-warning"><i class="fas fa-upload"></i> Upload</button>                                 
                                      </form>
                                </div>
                              </div>
                          </div>
          </div>
        </div>
      </div>
