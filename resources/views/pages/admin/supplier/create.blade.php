@extends('layouts.main')
@section('title', 'Tambah Supplier')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Supplier / </span> Tambah Baru</h4>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
                <form action="{{route('supplier.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="defaultFormControlInput" class="form-label">Kode Supplier</label>
                                <input type="text" value="{{ old('kodesupplier') }}" class="form-control @error('kdbrg') is-invalid @enderror" name="kodesupplier" id="kodesupplier" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('kodesupplier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-9">
                                <label for="defaultFormControlInput" class="form-label">Nama Supplier</label>
                                <input type="text" value="{{ old('nama_supplier') }}" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" id="nama_supplier" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('nama_supplier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-7">
                                <label for="defaultFormControlInput" class="form-label">Alamat</label>
                                <input type="text" value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Telephone</label>
                                <input type="text" value="{{ old('telepon') }}" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                          
                        </div>
                      
                            </div>
                        </div>

                        <div class="mt-4 mb-2 text-end">
                            <a href="{{route('barang.index')}}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
