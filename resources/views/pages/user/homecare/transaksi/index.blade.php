@extends('backend.adm')


@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush


@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">List Keluhan /</span> Konsultasi Dokter</h4>
</div>

@if(session('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    List Konsultasi
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">

                        <table id="example" class="display table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Alamat</th>
                                    <th>Keluhan</th>
                                    <th>Status Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                
                                <tr>
                                    <td</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editData"
                                        data-target="#editData">
                                            Edit
                                        </button>
                                        |
                                        <form method="POST" action="">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm show-alert-delete-box" data-toggle="tooltip" title='Delete'>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>dibuat Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>



           <!-- BUAT KATEGORI -->
           <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    Buat Konsultasi Anda
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-8">
                                <label for="defaultFormControlInput" class="form-label">Nama </label>
                                <input type="text" value="" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">Umur </label>
                                <input type="text" value="" class="form-control @error('umur') is-invalid @enderror" name="umur" id="umur" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('umur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="defaultFormControlInput" class="form-label">No Telp /(Wa) </label>
                                <input type="text" value="" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <label for="defaultFormControlInput" class="form-label">NIK (KTP) </label>
                                <input type="text" value="" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="defaultFormControlInput" class="form-label">Alamat Lengkap</label>
                                <input type="text" value="" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                              <label for="defaultFormControlInput" class="form-label">Area</label>
                              <select class="form-control">
                                  <option value="disable">Pilih Area Anda</option>
                                  <option>Large select</option>
                                  <option>Small select</option>
                              </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="defaultFormControlInput" class="form-label">Keluhan Anda</label>
                                <textarea name="keluhan" id="keluhan" class="form-control" cols="30" rows="7"></textarea>
                                @error('keluhan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Kirim </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- END BUAT KATEGORI -->
    </div>
</div>





@endsection