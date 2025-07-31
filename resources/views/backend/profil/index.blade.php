@extends('backend.adm')
@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />


<div class="col-12 col-sm-12 col-lg-12">
                <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                    <div class="card-body" id="show_all_profile">
                      <!-- <img alt="image" src="./storage/default.png" class="rounded-circle author-box-picture"> -->
                    </div>
                      <div class="clearfix"></div>
                      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprofile"> 
                      <i class="fa fa-upload" aria-hidden="true"></i> Create Profile</button>

                      <!-- <a href="#" class="btn btn-primary mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Follow</a> -->
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#">Hasan Basri</a>
                      </div>
                      <div class="author-box-job">Web Developer</div>
                      <div class="author-box-description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.</p>
                      </div>
                     
                      <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-github">
                        <i class="fab fa-github"></i>
                      </a>
                      <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <div class="w-100 d-sm-none"></div>
                      <div class="float-right mt-sm-0 mt-3">
                        <a href="#" class="btn">View Posts <i class="fas fa-chevron-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card card-danger">
                 
              </div>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  // fetch all employees ajax request
fetchAllEmployees();

function fetchAllEmployees() {
  $.ajax({
    url: '{{ route('fetchAll') }}',
    method: 'get',
    success: function(response) {
      $.noConflict();
      $("#show_all_profile").html(response);
      $("table").DataTable({
        order: [0, 'desc']
      });
    }
  });
}

 $(function() {

// add new employee ajax request
$("#add_profile_form").submit(function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  $("#add_profile_btn").text('Adding...');
  $.ajax({
    url: '{{ route('store') }}',
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
        )
        fetchAllEmployees();
      }
      $("#add_profile_btn").text('Add Data');
      $("#add_profile_form")[0].reset();
      $("#addprofile").modal('hide');
    }
  });
});



});
</script>


@endsection
{{-- add new  modal start --}}
<div class="modal fade" id="addprofile" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="#" method="POST" id="add_profile_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="nama">Nama </label>
              <input type="text" name="nama" class="form-control" placeholder="Nama Kamar" required>
            </div>
            <div class="col-lg">
              <label for="divisi">Divisi</label>
                <select id="divisi" name="divisi" class="form-control" >
                    <option value="0">-- Pilih--</option>
                    <option value="IT">IT</option>
                    <option value="Kasir">Kasir</option>
                    <option value="FO">FO</option>
                    <option value="FARMASI">FARMASI</option>
                    <option value="IGD">IGD</option>
                    <option value="VK">VK</option>
                    <option value="NEO">NEO</option>
                    <option value="OK">OK</option>
                    <option value="LAB">LAB</option>

                </select>
            </div>
          </div>
          <div class="my-2">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="E-Mail" required>
          </div>
          <div class="my-2">
            <label for="phone">phone</label>
            <input type="tel" name="phone" class="form-control" placeholder="phone" required>
          </div>
          <div class="my-2">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" placeholder="deskripsi" required>
          </div>
          <div class="my-2">
            <label for="avatar">Select Avatar</label>
            <input type="file" name="avatar" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_profile_btn" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new  modal end --}}