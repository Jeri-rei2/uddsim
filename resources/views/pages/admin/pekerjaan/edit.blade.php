@extends('layouts.main')
@section('title', 'Edit Pekerjaan')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pekerja / </span> Edit Pekerjaan</h4>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="container py-4">
                <form action="{{route('pekerjaan.update', $pekerjaan->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                            <label for="defaultFormControlInput" class="form-label">Kode Pekerjaan</label>
                                <input type="text" value="{{ $pekerjaan->kdpkrj }}" class="form-control @error('kdpkrj') is-invalid @enderror" name="kdpkrj" id="kdpkrj" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @foreach ($cabang as $cabang)
                                 <input type="hidden" value="{{ $pekerjaan->kdcab}}" name="kdcab" id="kdcab">
                                 @endforeach
                                 <input type="hidden" value="-" name="kdptgs" id="kdptgs">

                                 @error('kdpkrj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                                <div class="col-md-9">
                                <label for="defaultFormControlInput" class="form-label">Nama Pekerjaan</label>
                                <input type="text" value="{{ $pekerjaan->nmpkrj }}" class="form-control @error('nmpkrj') is-invalid @enderror" name="nmpkrj" id="nmpkrj" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                @error('nmpkrj')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                       
                        <div class="mt-4 mb-2 text-end">
                            <a href="{{route('pekerjaan.index')}}" class="btn btn-secondary">Kembali</a>
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
