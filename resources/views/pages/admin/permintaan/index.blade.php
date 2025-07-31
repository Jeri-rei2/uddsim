@extends('layouts.main')
@section('title', 'Permintaan')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Master /</span> Permintaan </h4>
    <!-- <div class="py-3">
        <a href="{{route('barang.create')}}" class="btn btn-primary float-right">Tambah Baru</a>
    </div> -->
</div>

@if(session('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif($message =  Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
 @endif
 <div class="button-action" style="margin-bottom: 20px">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">
        Import Data Permintaan
    </button>
    <a href="{{ route('kirim.export') }}" class="btn btn-primary btn-md">Export</a>
</div>
 <div class="card mb-4">
                    <h5 class="card-header">Permintaan Darah External</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">No Permintaan</label>
                        <div class="col-md-2">
                          <input class="form-control" type="text" id="nominta" name="nominta" readonly value="{{$nopermintaan}}" id="html5-text-input">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">Tanggal</label>
                        <div class="col-md-4">
                        <input class="form-control" type="datetime-local" id="tglminta" name="tglminta" value="2021-06-18T12:30:00" id="html5-datetime-local-input">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-email-input" class="col-md-2 col-form-label">Petugas</label>
                        <div class="col-md-10">
                          <input class="form-control" type="text" id="ptgs" name="ptgs" readonly value="{{Auth::user()->name}}" id="petugas">
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-url-input" class="col-md-2 col-form-label">Institusi Lain</label>
                        <div class="col-md-10">
                        <select class="form-control" id="position">
                            <option value="form-control" readonly>-- pilih --</option>
                            @foreach($tujuan as $item)
                                <option value="{{ $item->kdrs }}">{{ $item->kdrs }} {{ $item->nmrs}}</option>
                            @endforeach
                       </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-tel-input" class="col-md-2 col-form-label">Jenis Biaya</label>
                        <div class="col-md-10">
                        <select class="form-control" id="jnsbiaya">
                            <option value="form-control" readonly> --- PILIH ---</option>
                            <option value="Dropping">Dropping</option>
                            <option value="Konvalesen">Konvalesen</option>
                       </select>
                        </div>
                      </div>
                     
                      <hr width="100%" color="green"  style="border: 1px solid black;"/>
                      <div class="col-14">
                              <div class="col-md-4">
                                <label for="defaultFormControlInput" class="form-label">Keterangan/os</label>
                            
                                <input type="hidden" value="" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" />
                                <input type="text"  value="" class="form-control @error('kdcab') is-invalid @enderror" name="kdcab" id="kdcab" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                
                                @error('kdcab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-7">
                                <label for="defaultFormControlInput" class="form-label">Donor Pengganti </label>
                                <select class="form-control" id="dnrpg" name="dnrpg" onchange="showstuff('show', 'YA', this);">
                                      <option value="form-control" readonly> --- PILIH ---</option>
                                      <option value="YA"> Ya </option>
                                      <option value="TIDAK">Tidak</option>
                                </select>

                                @error('kdcab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div classs="col-md-5" id="show" style="display: none">
                                <label for="html5-email-input" class="col-md-2 col-form-label">NO.BDL :</label>
                                <div class="col-md-10">
                                  <input class="form-control" type="text" value="" name="nobdl" id="nobdl" placeholder="EXT " readonly>
                                </div>
                            </div>


                            <br/>
                            <div class="button-action" style="margin-bottom: 20px">
                              <a href="#" class="btn btn-info btn-md" id="tambahstok">Tambah Stok Darah Ext</a>
                              <!-- <a href="" class="btn btn-danger btn-md">Simpan</a> -->
                           
                            </div>

                        </div>

<div class="container">
<hr width="100%" color="green"  style="border: 1px solid black;"/>
        <div class="card mb-4">
                <h5 class="card-header">Data Permintaan External</h5>
        </div>
     
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading"></h4>
        </div>
        <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
               <input type="hidden" name="product_id" id="product_id">
                <div class="form-group">
                    <label for="name" class="col-sm-5 control-label">Jenis Darah</label>
                    <div class="col-sm-6">
                      <select name="jnsdr" id="jnsdr" class="form-control">      
                          <option value="form-control">Select Option</option>
                              @foreach($jnsdrh as $item)
                                  <option value="{{ $item->nmln }}"> {{ $item->nmln}}</option>
                              @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Gol Darah</label>
                    <div class="col-sm-10">
                    <select name="jnsdr" id="jnsdr" class="form-control">      
                          <option value="form-control" readonly>Select Option</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">RH </label>
                    <div class="col-sm-10">
                       <select name="jnsdr" id="jnsdr" class="form-control">      
                          <option value="form-control" disabled>Select Option</option>
                                  <option value="positif">Positif</option>
                                  <option value="negatif">Negatif</option>
                        </select>
                    </div>
                </div><div class="form-group">
                    <label class="col-sm-6 control-label">Jumlah Minta</label>
                    <div class="col-sm-10">
                        <input type="number" id="detail" name="detail" required="" placeholder="Masukkan Jumlah" class="form-control"></input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">CC </label>
                    <div class="col-sm-8">
                        <input type="number" id="detail" name="detail" required="" placeholder="Masukkan CC" class="form-control"></input type="text">
                    </div>
                </div><div class="form-group">
                    <label class="col-sm-7 control-label">Tgl Minta</label>
                    <div class="col-sm-9">
                        <input type="date" value="<?php echo date('Y-m-d');?>" id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></input type="text">
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan
                 </button>
               </div>
            </form>
        </div>
    </div>
</div>

</div>


</div>


                 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">    
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

function showstuff(element, option, t){
   if(t.options[t.selectedIndex].value==option){
      document.getElementById(element).style.display="block";
   }else{
       document.getElementById(element).style.display="none";
   }
}

$(function () {
$.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

});

  

/*------------------------------------------

--------------------------------------------

Render DataTable

--------------------------------------------

--------------------------------------------*/

var table = $('.data-table').DataTable({

    processing: true,

    serverSide: true,

    ajax: "{{ route('permintaan.index') }}",

    columns: [

        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'detail', name: 'detail'},
        {data: 'action', name: 'action', orderable: false, searchable: false},

    ]

});

  

/*------------------------------------------

--------------------------------------------

Click to Button

--------------------------------------------

--------------------------------------------*/

$('#tambahstok').click(function () {

    $('#saveBtn').val("create-product");
    $('#product_id').val('');
    $('#productForm').trigger("reset");
    $('#modelHeading').html("ADD Darah Minta External");
    $('#ajaxModel').modal('show');

});

  

/*------------------------------------------

--------------------------------------------

Click to Edit Button

--------------------------------------------

--------------------------------------------*/

$('body').on('click', '.editProduct', function () {

  var product_id = $(this).data('id');

  $.get(" " +'/' + product_id +'/edit', function (data) {
      $('#modelHeading').html("Edit Product");
      $('#saveBtn').val("edit-user");
      $('#ajaxModel').modal('show');
      $('#product_id').val(data.id);
      $('#name').val(data.name);
      $('#detail').val(data.detail);

  })

});

  

/*------------------------------------------

--------------------------------------------

Create Product Code

--------------------------------------------

--------------------------------------------*/

$('#saveBtn').click(function (e) {

    e.preventDefault();

    $(this).html('Sending..');

  

    $.ajax({

      data: $('#productForm').serialize(),

      url: "",

      type: "POST",

      dataType: 'json',

      success: function (data) {

   

          $('#productForm').trigger("reset");

          $('#ajaxModel').modal('hide');

          table.draw();

       

      },

      error: function (data) {

          console.log('Error:', data);

          $('#saveBtn').html('Save Changes');

      }

  });

});

  

/*------------------------------------------

--------------------------------------------

Delete Product Code

--------------------------------------------

--------------------------------------------*/

$('body').on('click', '.deleteProduct', function () {

 

    var product_id = $(this).data("id");

    confirm("Are You sure want to delete !");

    

    $.ajax({

        type: "DELETE",

        url: "{{ route('permintaan.store') }}"+'/'+product_id,

        success: function (data) {

            table.draw();

        },

        error: function (data) {

            console.log('Error:', data);

        }

    });

});

   

});




// In your Javascript (external .js resource or <script> tag)
$('select').select2({
        theme: 'bootstrap4',
    })






</script>


 @endsection