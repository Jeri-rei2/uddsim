@extends('backend.adm')
@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />


<div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <h3 class="text-light">Jadwal Dokter</h3>
            <button class="btn btn-default" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Tambah Jadwal</button>
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
$("#add_employee_form").submit(function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  
  $("#add_employee_btn").text('Adding...');
  $.ajax({
    url: '{{ route('praktek.import') }}',
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
          'Data Berhasil Di import!',
          'success'
        )
        // fetchAllEmployees();
      }
      $("#add_employee_btn").text('Add Data');
      $("#add_employee_form")[0].reset();
      $("#addEmployeeModal").modal('hide');
    }
  });
});

// edit employee ajax request
$(document).on('click', '.editIcon', function(e) {
  e.preventDefault();
  let id = $(this).attr('id');
  $.ajax({
    url: '{{ route('editjadwal') }}',
    method: 'get',
    data: {
      id: id,
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      $("#kd_dokter").val(response.kd_dokter);
      $("#nm_dokter").val(response.nm_dokter);
      $("#hari_kerja").val(response.hari_kerja);
      $("#jam_mulai").val(response.jam_mulai);
      $("#jam_selesai").val(response.jam_selesai);
      $("#kd_poli").val(response.kd_poli);
      $("#kuota").val(response.kuota);
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
    url: '{{ route('update') }}',
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
        fetchAllEmployees();
      }
      $("#edit_employee_btn").text('Update Employee');
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
    confirmButtonText: 'Ya, Hapus Sekarang!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '{{ route('hapus') }}',
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
    url: '{{ route('fetchAll') }}',
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
        <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php 
      
      
      $huruf = 'K';
            
      ?>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
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
        <h5 class="modal-title" id="exampleModalLabel">Ubah Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <!-- <input type="hidden" name="emp_avatar" id="emp_avatar"> -->
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="kd_dokter">ID Dokter</label>
              <input type="text" readonly name="kd_dokter" id="kd_dokter" class="form-control" placeholder="ID Dokter" required>
            </div>
              <div class="col-lg">
              <label for="nm_dokter">nama dokter</label>
              <input type="text" readonly name="nm_dokter" id="nm_dokter" class="form-control" placeholder="Jam Mulai" required>
            </div>
            <div class="col-lg">
              <label for="jam_mulai">Jam Mulai</label>
              <input type="text" name="jam_mulai" id="jam_mulai" class="form-control" placeholder="Jam Mulai" required>
            </div>
          
          </div>
          <div class="my-2">
            <label for="hari_kerja">Praktek</label>
            <!-- <input type="text" name="hari_kerja" id="hari_kerja" class="form-control" placeholder="Praktek" required> -->
            <select class="form-control" name='hari_kerja' id='hari_kerja'>
              <option  value='Senin'>Senin</option>
              <option value='Selasa'>Selasa</option>
              <option value='Rabu'>Rabu</option>
              <option value='Kamis'>Kamis</option>
              <option  value='Jumat'>Jumat</option>
              <option  value='Sabtu'>Sabtu</option>
              <option  value='Minggu'>Minggu</option>
            </select>
           </div>
          
          <div class="my-2">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="text" name="jam_selesai" id="jam_selesai" class="form-control" placeholder="Jam Selesai" required>
          </div>
          <div class="my-2">
            <label for="kd_poli">Poli</label>
            <input type="text" name="kd_poli" id="kd_poli" class="form-control" placeholder="Poli" required>
          </div>
          <div class="my-2">
            <label for="kuota">Kuota</label>
            <input type="text" name="kuota" id="kuota" class="form-control" placeholder="Kuota" required>
          </div>
          <!-- <div class="my-2">
            <label for="avatar">Ganti Gambar</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div> -->
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
