@extends('layouts.main')
@section('title', 'Edit Barang')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Barang / </span> Edit Barang</h4>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
                <form action="{{route('barang.update', $barang->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">Kode Barang</label>
                                    <input type="text" value="{{ $barang->kdbrg }}" class="form-control @error('kdbrg') is-invalid @enderror" name="kdbrg" id="kdbrg" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('kdbrg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-9">
                                    <label for="defaultFormControlInput" class="form-label">Nama Barang</label>
                                    <input type="text" value="{{ $barang->nmbrg }}" class="form-control @error('nmbrg') is-invalid @enderror" name="nmbrg" id="nmbrg" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('nmbrg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="row mt-3">
                        <div class="col-md-4">
                                <label for="satuanbsr" class="form-label">Satuan</label>
                                <input type="text" value="{{ $barang->satuanbsr }}" class="form-control @error('satuanbsr') is-invalid @enderror" name="satuanbsr" id="satuanbsr" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" name="satuankcl" id="satuankcl" value="-">
                                <input type="hidden" name="satuankcl" id="satuankcl" value="-">
                                @error('satuanbsr')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" value="{{ $barang->stok }}" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" name="stoktambah" id="stoktambah" value="-">
                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Stok min</label>
                                <input type="number" value="{{ $barang->stokmin }}" class="form-control @error('stokmin') is-invalid @enderror" name="stokmin" id="stokmin" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('stokmin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="defaultFormControlInput" class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    <input type="text" value="{{ $barang->hrsat }}" class="form-control @error('hrsat') is-invalid @enderror" name="hrsat" id="hrsat" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('hrsat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           
                        </div>
                        <div class="row mt-3">
                        <div class="col-md-6">
                                <label for="jnsbrg" class="form-label">Jenis Barang</label>
                                <select name="jnsbrg" id="jnsbrg" class="form-control form-select @error('jnsbrg') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih Barang --</option>
                                    @foreach ($jnsbarang as $jns)
                                    <option value="{{$jns->id}}">{{$jns->nmbarang}}</option>
                                    @endforeach
                                </select>
                                @error('jnsbrg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jnskantong" class="form-label">Jenis Kantong</label>
                                <select name="jnskantong" id="jnskantong" class="form-control form-select @error('jnskantong') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    @foreach ($jnsKtng as $jnsKtng)
                                    <option value="{{$jnsKtng->id}}">{{$jnsKtng->jenis}}</option>
                                    @endforeach
                                </select>
                                @error('jnskantong')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ukuran" class="form-label">Ukuran CC</label>
                                <select name="ukuran" id="ukuran" class="form-control form-select @error('ukuran') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih CC --</option>
                                    @foreach ($ukurancc as $ukuran)
                                    <option value="{{$ukuran->id}}">{{$ukuran->ML}}</option>
                                    @endforeach
                                </select>
                                @error('ukuran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jnsbrg" class="form-label">Kelompok</label>
                                <select  onchange="changeHiddenInput(this)" name="jnsbrg" id="jnsbrg" name class="form-control form-select @error('jnsbrg') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    @foreach ($Kelompok as $kel)
                                    <option value="{{$kel->kodekelompok}}">{{$kel->NamaKelompok}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="kodekelompok" id="kodekelompok" value="" />
                                @error('kategori_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        <div class="mt-4 mb-2 text-end">
                            <a href="{{route('barang.index')}}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">UBAH</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  function changeHiddenInput (objDropDown)
{
   document.getElementById("kodekelompok").value = objDropDown.value; 
}
</script>

@endsection
