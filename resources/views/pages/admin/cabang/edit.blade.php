@extends('layouts.main')
@section('title', 'Edit Cabang')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Cabang / </span> Edit Cabang</h4>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
                <form action="{{route('cabang.update', $cabang->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">Kode Cabang</label>
                                        <input type="text" value="{{ $cabang->kdcab }}" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('kdcab')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="col-md-9">
                                <label for="defaultFormControlInput" class="form-label">Nama Cabang</label>
                                    <input type="text" value="{{ $cabang->nmcab }}" class="form-control @error('nmcab') is-invalid @enderror" name="nmcab" id="nmcab" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('nmcab')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                            </div>
                            </div>
                       
                            <div class="row mt-2">
                            <div class="col-md-7">
                            <label for="defaultFormControlInput" class="form-label">Telephone</label>
                                <input type="text" value="{{ $cabang->tlp }}" class="form-control @error('tlp') is-invalid @enderror" name="tlp" id="tlp" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('tlp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="stok" class="form-label">Kota</label>
                                <input type="text" value="{{ $cabang->kota }}" class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                <input type="hidden" name="stoktambah" id="stoktambah" value="-">
                                @error('kota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="defaultFormControlInput" class="form-label">Kode Pos</label>
                                <input type="text" value="{{ $cabang->kdpos }}" class="form-control @error('kdpos') is-invalid @enderror" name="kdpos" id="kdpos" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('kdpos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-9">
                                <label for="defaultFormControlInput" class="form-label">Status</label>
                                <select  onchange="changeHiddenInput(this)" name="status" id="status" name class="form-control form-select @error('jnsbrg') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih  --</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                                <input type="hidden" name="kodekelompok" id="kodekelompok" value="" />
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" value="{{ $cabang->alamat }}" class="form-control @error('alamat') is-invalid @enderror" rows="5" name="alamat" id="alamat"></input>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
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
