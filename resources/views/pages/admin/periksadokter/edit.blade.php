@extends('layouts.main')

@section('title', 'Edit Dokter')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">


<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
 <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 10px;
    }
    .form-container {
      display: flex;
      justify-content: space-between;
      max-width: 1200px;
      margin: auto;
      gap: 20px;
    }
    .form-column {
      flex: 1;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    .form-actions {
      text-align: left;
      margin-top: 20px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
@endpush

@section('content')
<div class="container mt-4">
    <h2>Edit Questioner</h2>

  <form action="{{ route('show.update', $post->id) }}" method="POST">
        @csrf @method('PUT')
    <div class="form-container">
      <!-- Kolom Kiri -->
      <div class="form-column">
        <div class="form-group">
          <label for="nama">No Donor</label>
          <input type="text" id="nodonor" name="nodonor" value="{{ $post->nodonor }}">
        </div>
        <div class="form-group">
          <label for="text">Sehat Hari Ini</label>
          <input type="text" id="sehat" name="sehat" value="{{ $post->sehat }}">
        </div>
        <div class="form-group">
          <label for="telepon">Op 3 Bln ini</label>
          <input type="text" id="sakit" name="sakit"value="{{ $post->sakit }}">
        </div>
         <div class="form-group">
          <label for="telepon">Sakit Diabetes</label>
          <input type="text" id="diabet" name="diabet" value="{{$post->diabet}}">
        </div>
          <div class="form-group">
          <label for="txt">Sakit Asma</label>
          <input type="text" id="asma" name="asma" value="{{$post->asma}}">
        </div>
          <div class="form-group">
          <label for="txt">Sakit TBC</label>
          <input type="text" id="tbc" name="tbc" value="{{$post->tbc}}">
        </div>  <div class="form-group">
          <label for="txt">Sakit Kejang</label>
          <input type="text" id="kenjang" name="kenjang" value="{{$post->kenjang}}">
        </div>
      </div>

      <!-- Kolom Kanan -->
      <div class="form-column">
        <div class="form-group">
          <label for="ginjal">Sakit Ginjal</label>
          <input type="text" id="ginjal" name="ginjal" value="{{$post->ginjal}}">
        </div>
        <div class="form-group">
          <label for="jenis_kelamin">Sakit Radang</label>
          <input type="text" id="radang" name="radang" value="{{$post->radang}}">
        
        </div>
        <div class="form-group">
          <label for="txt">Sakit Jantung</label>
          <input type="text" id="jantung" name="jantung" value="{{$post->jantung}}">
        </div>
          <div class="form-group">
          <label for="txt">Sakit Hemofilia</label>
          <input type="text" id="jantung" name="jantung" value="{{$post->hemofilia}}">
        </div>
          <div class="form-group">
          <label for="txt">Sakit hiv</label>
          <input type="text" id="asma" name="asma" value="{{$post->hiv}}">
        </div>
        <div class="form-group">
          <label for="txt">Sakit Hepatitis</label>
          <input type="text" id="hepatitis" name="hepatitis" value="{{$post->hepatitis}}">
        </div> 
         <div class="form-group">
          <label for="txt">Sakit Sifilis</label>
          <input type="text" id="sifilis" name="sifilis" value="{{$post->sifilis}}">
        </div>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary" >Ubah</button>
    </div>
  </form>





</div>


<script>

    
// //ALERT
   @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

</script>
@endsection