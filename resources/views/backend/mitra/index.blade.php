@extends('backend.adm')



@section('content')
<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Input Pasien</h4>
                  </div>
                  <div class="card-body">
                    <p>
                      <a class="btn btn-warning" data-toggle="collapse" href="#tambah" role="button" aria-expanded="false" aria-controls="collapseExample">
                       Buka Form <i class="fa fa-eye" aria-hidden="true"> </i> 
                      </a>
                      <button class="btn btn-Secondary" type="button" data-toggle="collapse" data-target="#Edit" aria-expanded="false" aria-controls="collapseExample">
                      Buka Data <i class="fa fa-edit" aria-hidden="true">  </i>
                      </button>
                    </p>
                    <div class="collapse" id="tambah">
                    <fieldset style="background: #f6f8ff; border: 2px solid #4238ca; width:">
                        <legend>Registration Form</legend>
                          <form action="/tutorial/action.html">
                            

                              <div class="row">
                                <div class="form-group col-4">
                                  <label for="text" class="d-block">No RM</label>
                                  <input id="no_rm" type="text" class="form-control"  name="no_rm" style="width: 170px; height: 40px;" required >
                                  <label for="nama" class="d-block">Nama</label>
                                  <input id="nama" type="text" class="form-control" name="nama" style="width: 340px; height: 40px;" required>
                                  <label for="no_ktp" class="d-block">Nomor Ktp</label>
                                  <input id="no_ktp" type="text" class="form-control" name="no_ktp" style="width: 340px; height: 40px;" required>
                                  <label for="alamat" class="d-block">Alamat</label>
                                  <input id="alamat" type="text" class="form-control" name="alamat" style="width: 1120px; height: 40px;" required>
                  
                                </div>
                                <div class="form-group col-4">
                                 <label for="text" class="d-block">Tgl Daftar</label>
                                  <input id="tgl_daftar" type="date" class="form-control" style="width: 270px; height: 40px;"  name="tgl_daftar"  required >
                                  
                                  <label for="text" class="d-block">Tgl Lahir </label>
                                  <input id="tgl_lahir" type="date" class="form-control" style="width: 270px; height: 40px;"  name="tgl_lahir"  required >
                                  <label for="tlp" class="d-block">No Tlp </label>
                                  <input id="tlp" type="text" class="form-control" style="width: 270px; height: 40px;"  name="tlp"  required >
                                  
                                </div>
                                <div class="form-group col-4">
                                 <label for="text" class="d-block">Jenis Kelamin </label>
                                 <select id="jk" name="jk" class="form-control" >
                                    <option value="0">-- Pilih--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                  </select>
                                  <label for="text" class="d-block">Agama </label>
                                  <select id="Agama" name="Agama" class="form-control" >
                                      <option value="0">-- Pilih--</option>
                                      <option value="islam">Islam</option>
                                      <option value="Kristen">Kristen</option>
                                      <option value="Protestan">Protestan</option>
                                      <option value="Hindu">Hindu</option>
                                      <option value="Budha">Budha</option>
                                      <option value="Konghucu">Konghucu</option>
                                      <option value="Kepercayaan">Kepercayaan</option>
                                    </select>
                                    <label for="text" class="d-block">Pekerjaan </label>
                                    <select id="pekerjaan" name="pekerjaan" class="form-control" >
                                        <option value="0">-- Pilih--</option>
                                        <option value="Swasta">Swasta</option>
                                        <option value="PNS">PNS</option>
                                        <option value="TNI/POLRI">TNI/POLRI</option>
                                        <option value="Lain-Lain">Lain-Lain</option>

                                      </select>
                                </div>
                               
                              </div>
                              <button type="button" name="button" class="btn btn-success" id="simpan">
                                      <i class="fa fa-save"></i><span class="hidden-xs"> Simpan</span></button>
                              <button type="button" name="button" class="btn btn-info" id="ext">
                                      <i class="fa fa-times"></i><span class="hidden-xs"> Keluar</span></button>
                            </div>
                              
                          </form>     
                          </fieldset>
                    </div>
                    <div class="collapse" id="Edit">
                      <p>
                       tampilan tambah  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Multiple Targets</h4>
                  </div>
                  <div class="card-body">
                    <p class="buttons">
                      <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>
                    </p>
                    <div class="row">
                      <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                          <p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </p>
                        </div>
                      </div>
                      <div class="col">
                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                          <p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              </div>
            </div>
          </div>





@endsection


      <!-- Modal Mitra   -->
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p> <label for="lname">Last name:</label><br>
                  <input type="text" id="lname" name="lname"></p>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>





