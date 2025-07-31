@extends('backend.adm')

@section('content')

<div class="section-body">

            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-header">
                    <h4>Upload <code>Format File(jpg,img,png,xls,pdf)</code></h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="Foto-tab3" data-toggle="tab" href="#Foto3" role="tab" aria-controls="Foto" aria-selected="true">Gambar</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="File-tab3" data-toggle="tab" href="#File3" role="tab" aria-controls="File" aria-selected="false">File</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="slide-tab4" data-toggle="tab" href="#slide4" role="tab" aria-controls="slide" aria-selected="false">Image Slide</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="Foto3" role="tabpanel" aria-labelledby="Foto-tab3">
                      <div class="row">
                        <div class="col-13">
                            <div class="card">
                                <div class="card-body">
                                    {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{url('upload/gambar')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="file_gambar" name="file_gambar">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <textarea name="keterangan_gambar" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('keterangan')
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
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Aksi</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- menampilkan data  --}}
                                        @foreach ($data_gambar as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                {{-- jika ekstensi file adalah png, jpg atau jpeg maka tampilkan gambar  --}}
                                                @if( in_array(pathinfo($item->file_gambar, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                                <!-- <div class="gallery-item" data-image="{{asset('/public/file_upload')}}/{{$item->file}}" data-title="Image 1" href="{{asset('/public/file_upload')}}/{{$item->file}}" title="Image 1" style="background-image: url(&quot;{{asset('/public/file_upload')}}/{{$item->file}}&quot;);">
                                              </div>     -->
                                                <img src="{{asset('berkas_gambar')}}/{{$item->file_gambar}}" style="height: 50%">
                                                @else
                                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                                    style="height: 10%">
                                                @endif
                                            </td>
                                            <td>{{$item->keterangan_gambar}}</td>
                                            <td>
                                        <a href="" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#ModalEdit"><i class="far fa-edit"></i> Ubah</a>
                                            &nbsp;
                                            <a href="{{ url('delete-gambar',$item->id) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    
                    <div class="tab-pane fade" id="slide4" role="tabpanel" aria-labelledby="slide-tab4">
                      <div class="row">
                        <div class="col-13">
                            <div class="card">
                                <div class="card-body">
                                    {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{url('upload/slide')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="file_slide" name="file_slide">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <textarea name="keterangan_slide" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('keterangan')
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
                                            <th scope="col">Gambar Slide</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Aksi</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- menampilkan data  --}}
                                        @foreach ($data_slide as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                {{-- jika ekstensi file adalah png, jpg atau jpeg maka tampilkan gambar  --}}
                                                @if( in_array(pathinfo($item->file_slide, PATHINFO_EXTENSION), ['png', 'jpg', 'JPEG']))
                                                <!-- <div class="gallery-item" data-image="{{asset('/public/file_upload')}}/{{$item->file}}" data-title="Image 1" href="{{asset('/public/file_upload')}}/{{$item->file}}" title="Image 1" style="background-image: url(&quot;{{asset('/public/file_upload')}}/{{$item->file}}&quot;);">
                                              </div>     -->
                                                <img src="{{asset('berkas_slide')}}/{{$item->file_slide}}" style="height: 50%">
                                                @else
                                                    <img src="https://www.freeiconspng.com/uploads/file-txt-icon--icon-search-engine--iconfinder-14.png"
                                                    style="height: 10%">
                                                @endif
                                            </td>
                                            <td>{{$item->keterangan_slide}}</td>
                                            <td>
                                        <a href="" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#ModalEdit4"><i class="far fa-edit"></i> Ubah</a>
                                            &nbsp;
                                            <a href="{{ url('delete-slide',$item->id) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    

                    
                             
                      <div class="tab-pane fade" id="File3" role="tabpanel" aria-labelledby="File-tab3">
                      <div class="row">
                        <div class="col-13">
                            <div class="card">
                                <div class="card-body">
                                {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{url('upload/file')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan File</label>
                                            <input type="file" class="form-control" id="file" name="file">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <textarea name="keterangan_file" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('keterangan')
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
                                            <th scope="col">Nama File</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Aksi</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- menampilkan data  --}}
                                        @foreach ($data_file as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->file}}</td>
                                            <td>{{$item->keterangan_file}}</td>
                                            <td>
                                        <a href="" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#ModalEdit"><i class="far fa-edit"></i> Ubah</a>
                                            &nbsp;
                                            <a href="{{ url('delete-file',$item->id) }}" class="btn btn-icon btn-danger"><i class="fas fa-times"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
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
                                    <form action="{{ url('update-gambar') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="file_gambar" name="file_gambar">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <textarea name="keterangan_gambar" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('keterangan')
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

<div class="modal fade" tabindex="-1" role="dialog" id="ModalEdit4">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Slide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="card-body">
                                    {{-- jika mengirim file wajib menggunakan enctype="multipart/form-data" --}}
                                    <form action="{{ url('update-slide') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tambahkan Gambar</label>
                                            <input type="file" class="form-control" id="file_slide" name="file_slide">
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <textarea name="keterangan_slide" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        {{-- pesan error  --}}
                                        @error('keterangan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror  
                                        <button type="submit" id="tombol-simpan" class="btn btn-warning"><i class="fa fa-upload"></i> Upload</button>                                 
                                      </form>
                                </div>
                              </div>
                          </div>
          </div>
        </div>
      </div>