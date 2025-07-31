@extends('layouts.main')
@section('title', 'Edit Wilayah')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Wilayah / </span> Edit Wilayah</h4>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
                <form action="{{route('wilayah.update', $wilayah->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                            <label for="defaultFormControlInput" class="form-label">Kode Wilayah</label>
                                <input type="text" value="{{ $wilayah->kdwil }}" class="form-control @error('kdwil') is-invalid @enderror" name="kdwil" id="kdwil" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @foreach ($cabang as $cabang)
                                 <input type="hidden" value="{{ $cabang->kdcab}}" name="kdcab" id="kdcab">
                                 @endforeach
                                 <input type="hidden" value="-" name="kdptgs" id="kdptgs">

                                 @error('kdwil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-9">
                                <label for="defaultFormControlInput" class="form-label">Nama Wilayah</label>
                                <input type="text" value="{{ $wilayah->nmwil }}" class="form-control @error('nmwil') is-invalid @enderror" name="nmwil" id="nmwil" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('nmwil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                       
                        <div class="mt-4 mb-2 text-end">
                            <a href="{{route('wilayah.index')}}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-warning">UBAH</button>
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
