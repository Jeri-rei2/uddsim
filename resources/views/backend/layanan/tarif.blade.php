@extends('backend.adm')
@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />


<div class="container">
<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
<i class="fa fa-import"></i>Import Data</button>
<a href="/tarif/export_excel"> <button class="btn btn-success" target="_blank">
   <i class="fa fa-download" aria-hidden="true"> </i> Download Template</button></a>
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light"></h3>
           
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     $(function() {

// add new employee ajax request
$("#add_tarif").submit(function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#add_employee_btn").text('Adding...');
  $.ajax({
    url: '{{ route('tarifs') }}',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(response) {
      if (response.status == 200) {
        Swal.fire(
          'Berhasil!',
          'Data Berhasil Disimpan!',
          'success'
        );
        return redirect('/');
        fetchAllEmployees();
      }
      $("#add_employee_btn").text('Add Data');
      $("#add_tarif")[0].reset();
      $("#addEmployeeModal").modal('hide');
    }
  });
});

// edit employee ajax request
$(document).on('click', '.editIcon', function(e) {
  e.preventDefault();
  let id = $(this).attr('id');
  $.ajax({
    url: '{{ route('edit') }}',
    method: 'get',
    data: {
      id: id,
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      $("#kd_kamar").val(response.kd_kamar);
      $("#kd_bangsal").val(response.kd_bangsal);
      $("#trf_kamar").val(response.trf_kamar);
      $("#status").val(response.status);
      $("#kelas").val(response.kelas);
      // $("#avatar").html(
      //   `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
      $("#emp_id").val(response.id);
      // $("#emp_avatar").val(response.avatar);
    }
  });
});

// update employee ajax request
$("#edit_employee_form").submit(function(e) {
  e.preventDefault();


  const fd = new FormData(this);
  $("#edit_employee_btn").text('Updating...');
  $.ajax({
    url: '{{ route('ubah') }}',
    method: 'post',
    data: fd,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(response) {
      if (response.status == 200) {
        Swal.fire(
          'Updated!',
          'Data Berhasil Update!',
          'success'
        )
        // fetchAllEmployees();
      }
      $("#edit_employee_btn").text('Update ');
      $("#edit_employee_form")[0].reset();
      $("#editEmployeeModal").modal('hide');
    }
  });
});

// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
  e.preventDefault();
  let id = $(this).attr('id');
  let csrf = '{{ csrf_token() }}';
  Swal.fire({
    title: 'Anda yakin ingin Dihapus?',
    text: "Anda tidak akan dapat mengembalikan ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '{{ route('delete') }}',
        method: 'delete',
        data: {
          id: id,
          _token: csrf
        },
        success: function(response) {
          console.log(response);
          Swal.fire(
            'Deleted!',
            'Data Berhasil Dihapus.',
            'success'
          )
          fetchAllEmployees();
        }
      });
    }
  })
});

// fetch all employees ajax request
fetchAllEmployees();

function fetchAllEmployees() {
  $.ajax({
    url: '{{ route('datatarif') }}',
    method: 'get',
    success: function(response) {
      $.noConflict();
      $("#show_all_employees").html(response);
      $("table").DataTable({
        order: [0, 'desc']
      });
    }
  });
}
});
</script>

@endsection
{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
      <form action="#" method="POST" id="add_tarif" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
                 <div class="modal-body">
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                 </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}


{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="nama">Kode Kamar</label>
              <input type="text" name="kd_kamar" id="kd_kamar" class="form-control" placeholder="Kode Kamar" required>
            </div>
            <div class="col-lg">
              <label for="no_bed">Kode Bangsal</label>
              <input type="text" name="kd_bangsal" id="kd_bangsal" class="form-control" placeholder="Kode Bangsal" required>
            </div>
          </div>
          <div class="my-2">
            <label for="cara_bayar">Tarif Kamar</label>
            <input type="text" name="trf_kamar" id="trf_kamar" class="form-control" placeholder="Tarif Kamar" required>
          </div>
          <div class="my-2">
            <label for="tarif_kamar">Status Kamar</label>
            <select class="form-control" name="status" id="status">
              <option value="ISI">Isi</option>
              <option value="Kosong">Kosong</option>
              <option value="Dibersihkan">Dibersihkan</option>
              <option value="Dibooking">Dibooking</option>
            </select>
           <!-- <input type="text"  class="form-control" placeholder="status" required> -->
          </div>
          <div class="my-2">
            <label for="post">Kelas</label>
            <select class="form-control" name="kelas" id="kelas">
              <option value="VIP">VIP</option>
              <option value="Kelas 1">Kelas 1</option>
              <option value="Kelas 2">Kelas 2</option>
              <option value="Kelas 3">Kelas 3</option>
              <option value="VVIP">VVIP</option>

            </select>
            
          </div>
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}
