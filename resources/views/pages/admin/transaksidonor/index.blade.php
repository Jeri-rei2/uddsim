@extends('layouts.main')
@section('title', 'Aftap')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <style>
    table.dataTable {
      width: 100% !important;
    }
  </style>
@endpush

@section('content')
<div class="container" id="alldata">
   <div class="row">
                <div class="col-xl-6">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-top-home"
                          aria-controls="navs-top-home"
                          aria-selected="true"
                        >
                          Home
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-top-profile"
                          aria-controls="navs-top-profile"
                          aria-selected="false"
                        >
                          Data Donor
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-top-messages"
                          aria-controls="navs-top-messages"
                          aria-selected="false"
                        >
                          Data FPUP
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content" style="width: 1200px;">
                      <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel" >
                       <div class="row" >
                          <div class="card mb-4">
                                        <h5 class="card-header">Aftap - Transaksi Donor</h5>
                                        <!-- Account -->
                                        <div class="card-body">
                                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            
                                            <img
                                              alt=""class="d-block rounded" height="150"width="150" id="fotodonor"
                                            />

                                            <div class="button-wrapper">
                                                  <fieldset class="border" style="width: 870px;">
                                                        <legend  class="float-none w-auto p-4" style="font-size: 18px;">Data Pedonor</legend>
                                                        <table>
                                                        <tr>
                                                              <th>Tanggal  </th>
                                                              <td><input type="text" style="width:135px;" value="" id="tglperiksa" name="tglperiksa" class="form-control" readonly></td>
                                                              <th>No Pendaftaran </th>
                                                              <td><input type="text" style="width:165px;" autofocus value="" id="noaftap" name="noaftap" class="form-control" placeholder="No Pendaftaran"></td>    
                                                        </tr>
                                                        <tr>
                                                            <th>No Donor </th>
                                                            <td>
                                                              <input type="text"  id="nodonor" name="nodonor" value="" class="form-control" readonly placeholder="no donor" >
                                                              <input type="hidden"  id="tglhema" name="tglhema" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="tglaftap" name="tglaftap" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="umur" name="umur" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="kelompokumur" name="kelompokumur" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="nokntng" name="nokntng" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="nofpup" name="nofpup" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="namaos" name="namaos" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="ckdasldrh" name="ckdasldrh" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="asaldrh" name="asaldrh" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="tensi" name="tensi" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="nadi" name="nadi" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="brtbdn" name="brtbdn" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="kelompokbrat" name="kelompokbrat" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="suhu" name="suhu" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="ecg" name="ecg" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="tolak" name="tolak" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="alsntlk" name="alsntlk" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="metodehb" name="metodehb" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="hasilhb" name="hasilhb" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="trombosit" name="trombosit" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="ht" name="ht" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="leokosit" name="leokosit" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="eritrosit" name="eritrosit" value="" class="form-control" readonly placeholder="" >
                                                              <input type="hidden"  id="reaksiambil" name="reaksiambil" value="" class="form-control" readonly placeholder="" >
                                                        


                                                            
                                                            
                                                            </td>
                                                            <th>Nama Donor</th>   
                                                            <td><input type="text" style="width:285px;"  id="namadonor" name="namadonor" value="" class="form-control" readonly placeholder="nama donor" ></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Alamat</th>
                                                            <td><input type="text" id="alamat" name="alamat" value="" class="form-control" readonly placeholder="Alamat" ></td>
                                                            <th>Wilayah</th>
                                                            <td><input type="text" id="wil" name="wil" value="" class="form-control" readonly placeholder="Wilayah" ></td>

                                                        </tr>
                                                        <tr>
                                                            <th>No.Ktp</th>
                                                            <td><input type="text" id="noktp" name="noktp" value="" class="form-control" readonly placeholder="NO ktp" ></td>
                                                            <th>Agama</th>
                                                            <td><input type="text" id="agama" name="agama" value="" class="form-control" readonly placeholder="agama" ></td>
                                                        </tr>
                                                        <tr>
                                                
                                                            <th>Telephone </th>
                                                            <td><input type="text" id="tlp" name="tlp" value="" class="form-control" readonly placeholder=" (+62)" ></td>
                                                            <th>Tgl Lahir</th>
                                                            <td><input type="text" id="tgllahir" name="tgllahir" value="" class="form-control" readonly placeholder="tgllahir" ></td>
                                                            <th>Jk</th>
                                                            <td><input type="text" id="jk" name="jk" value="" class="form-control" readonly placeholder="Jenis Kelamin" ></td>
                                                        </tr>
                                                      </table>
                                                  </fieldset>
                                        
                                            </div>
                                          </div>
                                        </div>
                                        <hr class="my-0" />
                                        <div class="card-body">
                                          <form id="formAccountSettings" method="POST" onsubmit="return false">
                                            <div class="row"> 
                                                  <fieldset class="border" style="width: 1180px;">
                                                        <legend  class="float-none w-auto p-4" style="font-size: 18px;">Darah Donor</legend>
                                                        <table>
                                                            <tr>
                                                              <th>Tgl akhir Donor  </th>
                                                              <td><input type="text" id="tgldonor" style="width: 160px;" name="tgldonor" value="" class="form-control" readonly placeholder="Tgl Donor" ></td>
                                                              <th>Penghargaan Terima  </th>
                                                              <td><input type="text" id="penghargaan" name="penghargaan" value="" class="form-control" readonly placeholder="penghargaan" ></td>
                                                              
                                                            </tr>
                                                            <tr>
                                                                <th> Gol-Rhesus </th>
                                                                <td>
                                                                  <input type="text" id="goldar" name="goldar" value="" class="form-control" readonly placeholder="Goldar" > </td>
                                                                <td> <input type="text" style="width: 85px;" id="rhesus" name="rhesus" value="" class="form-control" readonly placeholder="Rhesus" >
                                                                </td>
                                                                <th> Gol-Lain </th>
                                                                <td><input type="text" id="gol" name="gol" value="" class="form-control" readonly placeholder="Gol-Lain" ></td>
                                                                <th> Donor Ke </th>
                                                                <td><input type="text" id="donorke" name="donorke" value="" class="form-control" readonly placeholder="Donor Ke" ></td>
                                                            
                                                            </tr>
                                                            <tr>
                                                                <th> Periksaan Kesehatan </th>
                                                                <td><input type="text" id="stpriksa" name="stpriksa" value="" class="form-control" readonly placeholder="Pemeriksaan Kesehatan" ></td>
                                                                <th> Periksaan Hematologi </th>
                                                                <td><input type="text" style="width: 160px;" id="priksahb" name="priksahb" value="" class="form-control" readonly placeholder="Pemeriksaan Hematologi" ></td>
                                                                <th> Jenis Kantong Digunakan </th>
                                                                <td><input type="text" id="ktdg" name="ktdg" value="" class="form-control" readonly placeholder="Jenis Kantong Digunakan" ></td>
                                                                <th> Jumlah Darah Diambil </th>
                                                                <td><input type="text" id="ccambil" name="ccambil" value="" class="form-control" readonly placeholder="Jumlah Darah Diambil" ></td>
                                                              </tr>
                                                              <tr>
                                                                <th> Tipe Jns Kantong </th>
                                                                <td><input type="text" id="jnsktg" name="jnsktg" value="" class="form-control" readonly placeholder="" ></td>
                                                                <td><input type="text" id="typektg" name="typektg" value="" class="form-control" readonly placeholder="" ></td>
                                                                <th> Asal Darah </th>
                                                                <td><input type="text" id="kdcab" name="kdcab" value="000000" class="form-control" readonly placeholder="" ></td>
                                                                <td><input type="text" id="nmcab" name="nmcab" value="" style="width: 230px;" class="form-control" readonly placeholder="" ></td>
                                                              </tr>
                                                        </table>
                                                    </fieldset>
                                                  
                                            </div>
                                            <div class="row">
                                              <div class="mb-2 col-md-3">
                                                <label for="almtsrt" class="form-label">Alamat Surat</label>
                                                <input class="form-control"type="text"id="almtsrt"name="almtsrt"value=""  readonly/>
                                              </div>
                                              <div class="mb-2 col-md-4">
                                                <label for="lastName" class="form-label"> - </label>
                                                <input class="form-control"type="text" id="wilsrt" name="wilsrt" value="" placeholder="" readonly
                                                />
                                              </div>
                                              <div class="mb-2 col-md-4">
                                                  <label for="notlp" class="form-label"> - </label>
                                                  <button type="button" class="form-control btn btn-info" onclick="msg()"> <i class='bx bxs-edit-alt'> </i> Ubah Asal Darah </button>
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="notlp" class="form-label">Jenis Donor</label>
                                                <select id="jnsdnr" name="jnsdnr" class="select2 form-select">
                                                  <option value="Sukarela">Sukarela</option>
                                                  <option value="Pengganti">Pengganti</option>
                                                </select>
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="organization" class="form-label">Cara Ambil</label>
                                                <input class="form-control"type="text"id="caraambil"name="caraambil"value="" readonly />
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label class="form-label" for="phoneNumber">Reaksi Donor </label>
                                                <div class="input-group input-group-merge">
                                                <select id="reaksidnr" neme="reaksidnr" class="select2 form-select">
                                                  <option value="Normal">Normal</option>
                                                  <option value="Lain-Lain">Lain-Lain</option>
                                                  <option value="Muntah">Muntah</option>
                                                  <option value="Pingsan">Pingsan</option>
                                                  <option value="Pusing">Pusing</option>
                                                </select>
                                                </div>
                                              </div>
                                              <div class="mb-3 col-md-6">
                                                <label for="lain" class="form-label">Lain - Lain</label>
                                                <input type="text" class="form-control" id="lain" name="lain" placeholder="" />
                                              </div>
                                              <div class="mb-3 col-md-6">
                                                <label for="catatan" class="form-label">Catatan</label>
                                                <input class="form-control" type="text" id="catatan" name="catatan" placeholder="" />
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="zipCode" class="form-label">No.FPUP</label>
                                                <input
                                                  type="text"
                                                  class="form-control"
                                                  id="nofpup"
                                                  name="nofpup"
                                                  placeholder=""
                                                  readonly
                                                />
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label class="form-label" for="country">Nama O.S</label>
                                                <input class="form-control" type="text" id="nmos" name="nmos" placeholder=""readonly />
                                              </div>
                                              <div class="mb-1 col-md-4">
                                                <label for="language" class="form-label">Nama R.S</label>
                                                <input class="form-control" type="text" id="nmrs" name="nmrs" placeholder="" readonly/>
                                              
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="timeZones" class="form-label">Aftap</label>
                                                <input class="form-control" type="text" id="ptgsaftp" name="ptgsaftp" value="{{Auth::user()->name}}" placeholder="" readonly/>
                                                <input class="form-control" type="hidden" id="kdptgsaftp" name="kdptgsaftp" value="{{Auth::user()->bagian}}" placeholder="" readonly/>
                                              
                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="currency" class="form-label">No Kantong </label>
                                                <input class="form-control" type="text" id="nokantong" name="nokantong"  placeholder="scan no kantong"/>

                                              </div>
                                              <div class="mb-1 col-md-3">
                                                <label for="currency" class="form-label">No Selang </label>
                                                <input class="form-control" type="text" id="noselang" name="noselang" placeholder="" />

                                              </div>
                                              <div class="mb-1 col-md-2">
                                                <label for="currency" class="form-label">Lot </label>
                                                <input class="form-control" type="text" id="nolot" name="nolot" placeholder="" readonly/>

                                              </div>

                                              <div class="mb-1 col-md-2">
                                              <fieldset class="border" style="width: 170px;">
                                                  <legend  class="float-none w-auto "style="font-size: 13px;">Sample Darah</legend>
                                                  <table>
                                                  <tr>
                                                    
                                                      <td> <input type="radio" value="ya" id="sampledrh" name="sampledrh" checked > Ya </input>    
                                                          <input type="radio" value="Tidak" id="sampledrh" name="sampledrh">  Tidak </input>  </td>
                                                  </tr>
                                                  
                                                  </table>
                                              </fieldset> 
                                            </div>
                                            <div class="mb-1 col-md-2">
                                              <fieldset class="border" style="width: 175px;">
                                                  <legend  class="float-none w-auto "style="font-size: 13px;">Kantong Penuh</legend>
                                                    <table>
                                                        <tr>
                                                            <td> <input type="radio" value="Ya" id="ktgpenuh" name="ktgpenuh" checked> Ya </input>  
                                                                <input type="radio" value="Tidak" id="ktgpenuh" name="ktgpenuh"> Tidak </input>  </td>
                                                        </tr>
                                                    </table>
                                              </fieldset> 
                                            </div>
                                            <div class="mb-1 col-md-2">
                                              <fieldset class="border" style="width: 175px;">
                                                  <legend  class="float-none w-auto " style="font-size: 13px;">Darah Lancar</legend>
                                                    <table>
                                                        <tr>
                                                            <td> <input type="radio" value="Ya" id="lancar" name="lancar" checked> Ya </input>   
                                                                <input type="radio" value="Tidak" id="lancar" name="lancar"> Tidak </input>  </td>
                                                        </tr>
                                                    </table>
                                              </fieldset> 
                                            </div>
                                            <div class="mb-1 col-md-2">
                                              <fieldset class="border" style="width: 175px;">
                                                  <legend  class="float-none w-auto" style="font-size: 13px;">Penusukan Sulit</legend>
                                                    <table>
                                                        <tr>
                                                            <td> <input type="radio" value="Ya" id="sulit" name="sulit" checked> Ya </input>    
                                                                <input type="radio" value="Tidak" id="sulit" name="sulit"> Tidak </input>  </td>
                                                        </tr>
                                                    </table>
                                              </fieldset> 
                                            </div>
                                            <div class="mb-1 col-md-2">
                                              <fieldset class="border" style="width: 310px;">
                                                  <legend  class="float-none w-auto" style="font-size: 13px;">Donor Sewaktu Puasa</legend>
                                                    <table>
                                                        <tr>
                                                            <td> <input type="radio" value="Ya" id="puasa" name="puasa"> Ya </input>   
                                                                <input type="radio" value="Tidak" id="puasa" name="puasa" checked> Tidak </input>  </td>
                                                        </tr>
                                                    </table>
                                              </fieldset> 
                                            </div>

                                                <div class="mb-2 col-md-3">
                                                  <fieldset class="border" style="width: 240px;">
                                                        <legend  class="float-none w-auto" style="font-size: 13px;">Donor Sewaktu Waktu</legend>
                                                          <table>
                                                              <tr>
                                                                  <td> <input type="radio" value="Ya" id="waktu" name="waktu" checked> Ya </input>   
                                                                      <input type="radio" value="Tidak" id="waktu" name="waktu"> Tidak </input>  </td>
                                                              </tr>
                                                          </table>
                                                    </fieldset> 
                                                </div>
                                                <div class="mb-2 col-md-3">
                                                  <fieldset class="border" style="width: 260px;">
                                                        <legend  class="float-none w-auto" style="font-size: 13px;">Bersedia Dikirim Surat</legend>
                                                          <table>
                                                              <tr>
                                                                  <td> <input type="radio" value="Ya" id="surat" name="surat"checked> Ya </input>  
                                                                      <input type="radio" value="Tidak" id="surat" name="surat"> Tidak </input>  </td>
                                                              </tr>
                                                          </table>
                                                    </fieldset> 
                                                </div>
                                                <div class="mb-5 col-md-8">
                                                  <fieldset class="border" style="width: 980px;">
                                                        <legend  class="float-none w-auto" style="font-size: 17px;">Jenis Darah Minta</legend>
                                                          <table>
                                                              <tr>
                                                                  <th><label class="form-label" for="country">Stop Pada </label> </th>
                                                                  <td><input type="text" id="stoppd" name="stoppd" value="" class="form-control"  placeholder="" ></td>
                                                                      <td><label class="form-label" for="country">(CC)</label> </td>
                                                                  <th><label class="form-label" for="country">Satelit </label>  </th>
                                                                  <td><input type="text" id="satlit" name="satlit" value="" class="form-control"  placeholder="" readonly></td>
                                                                  <th><label class="form-label" for="country">CC Ambil  </label>  </th>
                                                                  <td><input type="text" id="ambildrh" name="ambildrh" value="" readonly class="form-control"  placeholder="" ></td>
                                                              </tr>
                                                              <tr>
                                                                  <th><label class="form-label" for="country">ID Mesin Timbangan </label>  </th>
                                                                  <td><input type="text" id="idtmb" name="idtmb" value="" class="form-control"  placeholder="" required></td>
                                                                  <th><label class="form-label" for="country">Durasi </label>  </th>
                                                                  <td><input type="text" id="durasi" name="durasi" value="" class="form-control"  placeholder="" ></td>
                                                              </tr>
                                                          </table>
                                                    </fieldset> 
                                                </div>
                                            </div>
                                            <div id="result"></div>
                                          
                                            <div class="mt-2">
                                              <button type="submit" class="btn btn-primary me-2" id="saveBtn"><i class='bx bxs-save'> </i> Simpan</button>
                                              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                          </form>
                                        </div>
                                          <!-- /Account -->
                                
                                            <table border="1" class="table table-striped" id="items-table" style="display:none" >
                                                <thead>
                                                    <tr>
                                                        <th>No Kantong</th>
                                                        <th>Merk</th>
                                                        <th>Jns Kantong</th>
                                                        <th>CC</th>
                                                        <th>No LOT</th>
                                                        <th>Type Kantong</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                
                                            </table>
                                            
                                            <table border="1" class="table table-striped" id="itmktg"  style="display:none"  >
                                                <thead>
                                                    <tr>
                                                        <th>No LOT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data akan dimuat di sini dengan AJAX -->                  
                                                </tbody>
                                                
                                            </table>



                            </div> 

                        </div>



                      </div>
                      <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                          
                          <h6 class="text-muted">Data Transaksi Donor</h6> 
                         <form id="searchForm">
                              <input type="text" name="nokntng" placeholder="No kantong">
                              <input type="text" name="noaftap" placeholder="No AFTAP">
                              <input type="text" name="goldar" placeholder="Golongan Darah">

                              <!-- <select name="role">
                                  <option value="">-- Pilih Jenis Kantong --</option>
                                  <option value="admin">Admin</option>
                                  <option value="user">User</option>
                              </select> -->
                              <button type="submit" class="btn btn-danger"><i class='bx  bx-search'></i>  Cari</button>

                          </form>
                            <br/>
                            <table class="table table-striped" id="result-table">
                              <thead>
                                  <tr>
                                      <th>No Donor</th>
                                      <th>Nama Donor</th>
                                      <th>No Aftap</th>
                                      <th>Tgl Aftap</th>
                                      <th>No Kantong </th>
                                      <th>No FPD </th>
                                      <th>Jns Kantong </th>
                                      <th>Asl Darah </th>
                                      <th>Gol Darah </th>
                                      <th>CC Ambil</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- Data akan dimuat di sini dengan AJAX -->                  
                              </tbody>
                              
                          </table>
                      </div>
                      <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                       <form id="searchfpup">
                              <input type="text" name="nokantong" placeholder="No FPUP">
                              <input type="text" name="noaftap" placeholder="Nama RS">
                              <!-- <input type="text" name="goldar" placeholder="Golongan Darah"> -->

                              <!-- <select name="role">
                                  <option value="">-- Pilih Jenis Kantong --</option>
                                  <option value="admin">Admin</option>
                                  <option value="user">User</option>
                              </select> -->
                              <button type="submit" class="btn btn-danger"><i class='bx  bx-search'></i>  Cari</button>

                          </form>
                            <br/>
                            <table class="table table-striped" id="result-fpup">
                              <thead>
                                  <tr>
                                      <th>No FPUP</th>
                                      <th>Nama RS</th>
                                      <th>No Reg</th>
                                      <th>Tgl FPUP</th>
                                      <th>Nama O.S </th>
                                      <th>Jenis Permintaan </th>
                                      <th>Bagian </th>
                                      <th>Diagnosa Klinis </th>
                                      <th>Dokter Yang Meminta </th>
                                      <!-- <th>CC Ambil</th> -->
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- Data akan dimuat di sini dengan AJAX -->                  
                              </tbody>
                              
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>


<!-- Modal -->
<div class="modal fade" id="scanModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Scan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="kodeBarang" class="form-control mb-3" placeholder="Scan barang..." autofocus>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody id="resultTable">
                <!-- Data hasil scan barang akan tampil di sini -->
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
<script>   @if(Session::has('success'))
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





 let scannoaftp = [];
    let totalnoaftp = 0;
   // Event listener untuk menangkap input perubahan barcode
    $('#noaftap').on('change', function() {
        var noaftap = $(this).val();
        // Kirim data barcode ke server untuk disimpan
        $.ajax({
            url: '{{ route("cari.nodaftar") }}',
            method: 'POST',
            data: {
                noaftp: noaftap,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
              console.log(response);
                //  $('#noaftp').val('');
                if(response.success) {
                  
               // Cek duplikat
                    if (scannoaftp.find(item => item.noaftp === response.data.noaftp)) {
                        alert('No Pendaftaran sudah di cari');
                             
                    } else {


                      let input = document.getElementById('noaftap').value;
                      let jnsdnr = document.getElementById('jnsdnr').value;
                      let nofpup = document.getElementById('nofpup').value;
                      let namaos = document.getElementById('namaos').value;
                      let ptgsaftp = document.getElementById('ptgsaftp').value;
                      let kdptgsaftp = document.getElementById('kdptgsaftp').value;
                      let stpriksa = document.getElementById('stpriksa').value = 'SUDAH DIPERIKSA';
                      let kdcab = document.getElementById('kdcab').value;
                      let priksahb = document.getElementById('priksahb').value = 'SUDAH DIPERIKSA';
                      let reaksiambil = document.getElementById('reaksiambil').value = 'BAIK';
                      let reaksidnr = document.getElementById('reaksidnr').value;
                      let puasa =  document.getElementById('puasa').value = 'Tidak';
                      let waktu = document.getElementById('waktu').value;
                      let ktgpenuh = document.getElementById('ktgpenuh').value;
                      let sampledrh = document.getElementById('sampledrh').value;
                      let sulit = document.getElementById('sulit').value;
                      let lancar = document.getElementById('lancar').value;
                      let surat = document.getElementById('surat').value;
                      let catatan = $('#catatan').val();
                      let durasi = $('#durasi').val();

                      
                    

                      // totalScan++;
                      document.getElementById('durasi').value = durasi;
                      document.getElementById('catatan').value = catatan;


                        scannoaftp.push({
                            durasi: durasi,
                            stpriksa: stpriksa,
                            nodonor: response.data.nodonor,
                            namadonor: response.data.namadonor,
                            tglperiksa: response.data.tglperiksa,
                            alamat: response.data.alamat,
                            wil: response.data.almsrt2,
                            noktp: response.data.noktp,
                            kdcab: response.data.ckdasldrh,
                            nmcab: response.data.asldrh,
                            tgldonor: response.data.tgldaftar,
                            tglhema: response.data.tglhma,
                            tglaftap: response.data.tglaftap,
                            tgllahir: response.data.tgllahir,
                            umur:  response.data.usia,
                            kelompokumur:  response.data.usia,
                            jnsdnr: jnsdnr,
                            nofpup:nofpup,
                            namaos:namaos,
                            ptgsaftp: ptgsaftp,
                            kdptgsaftp: kdptgsaftp,
                            noaftap: input,
                            tensi: response.data.tensi,
                            nadi: response.data.nadi,
                            brtbdn: response.data.brtbdn,
                            kelompokbrat: response.data.kelompokbrat,
                            ecg: response.data.ecg,
                            suhu: response.data.suhu,
                            tolak: response.data.tolak,
                            alsntlk: response.data.alsntlk,
                            ambildrh: response.data.ccambi,
                            jnsktg: response.data.jnsktg,
                            priksahb: priksahb,
                            metodehb: response.data.metodehb,
                            hasilhb: response.data.hasilhb,
                            trombosit:  response.data.trombosit,
                            ht:  response.data.ht,
                            leokosit:  response.data.leokosit,
                            eritrosit: response.data.eritrosit,
                            stoppd: response.data.ccambil,
                            reaksiambil: reaksiambil,
                            reaksidnr: reaksidnr,
                            puasa: puasa,
                            waktu: waktu,
                            ktgpenuh: ktgpenuh,
                            sulit: sulit,
                            lancar: lancar,
                            sampledrh: sampledrh,
                            surat: surat,
                            donorke: response.data.donorke,
                            catatan: catatan,
                            nolot: response.data.nolot,
                            nokntng: response.data.nokntng,
                            goldar: response.data.goldar,
                            rhesus: response.data.rhesus,
                        });
                         $('#catatan value').append( document.getElementById("catatan").value = catatan);
                         $('#durasi value').append( document.getElementById("durasi").value = durasi);

                         $('#nolot value').append( document.getElementById("nolot").value = `${response.data.nolot}`);
                        $('#nokntng value').append( document.getElementById("nokntng").value = `${response.data.nokntng}`);
                        $('#goldar value').append( document.getElementById("goldar").value = `${response.data.goldar}`);
                        $('#rhesus value').append( document.getElementById("rhesus").value = `${response.data.rhesus}`);
                        $('#fotodonor').attr('src', '/storage/captures/'+ `${response.data.photo}`);
                        $('#nodonor value').append( document.getElementById("nodonor").value = `${response.data.nodonor}`);
                        $('#namadonor value').append( document.getElementById("namadonor").value = `${response.data.namadonor}`);
                        $('#tglperiksa value').append( document.getElementById("tglperiksa").value = `${response.data.tglperiksa}`);
                        $('#tglhema value').append( document.getElementById("tglhema").value = `${response.data.tglhema}`);
                        $('#tglaftap value').append( document.getElementById("tglaftap").value = `${response.data.tglaftap}`);
                        $('#umur value').append( document.getElementById("umur").value = `${response.data.usia}`);
                        $('#kelompokumur value').append( document.getElementById("kelompokumur").value = `${response.data.usia}`);
                        $('#tensi value').append( document.getElementById("tensi").value = `${response.data.tensi}`);
                        $('#nadi value').append( document.getElementById("nadi").value = `${response.data.nadi}`);
                        $('#brtbdn value').append( document.getElementById("brtbdn").value = `${response.data.brtbdn}`);
                        $('#brtbdn value').append( document.getElementById("brtbdn").value = `${response.data.brtbdn}`);
                        $('#kelompokbrat value').append( document.getElementById("kelompokbrat").value = `${response.data.kelompokbrat}`);
                        $('#suhu value').append( document.getElementById("suhu").value = `${response.data.suhu}`);
                        $('#ecg value').append( document.getElementById("ecg").value = `${response.data.ecg}`);
                        $('#tolak value').append( document.getElementById("tolak").value = `${response.data.tolak}`);
                        $('#alsntlk value').append( document.getElementById("alsntlk").value = `${response.data.alsntlk}`);
                        $('#metodehb value').append( document.getElementById("metodehb").value = `${response.data.metodehb}`);
                        $('#hasilhb value').append( document.getElementById("hasilhb").value = `${response.data.hasilhb}`);
                        $('#trombosit value').append( document.getElementById("trombosit").value = `${response.data.trombosit}`);
                        $('#ht value').append( document.getElementById("ht").value = `${response.data.ht}`);
                        $('#leokosit value').append( document.getElementById("leokosit").value = `${response.data.leokosit}`);
                        $('#eritrosit value').append( document.getElementById("eritrosit").value = `${response.data.eritrosit}`);
                       
                        $('#alamat value').append( document.getElementById("alamat").value = `${response.data.alamat}`);
                        $('#wil value').append( document.getElementById("wil").value = `${response.data.almsrt2}`);
                        $('#noktp value').append( document.getElementById("noktp").value = `${response.data.noktp}`);
                        $('#agama value').append( document.getElementById("agama").value = `${response.data.agama}`);
                        $('#tlp value').append( document.getElementById("tlp").value = `${response.data.tlp}`);
                        $('#tgllahir value').append( document.getElementById("tgllahir").value = `${response.data.tgllahir}`);
                        $('#jk value').append( document.getElementById("jk").value = `${response.data.jk}`);
                        $('#tgldonor value').append( document.getElementById("tgldonor").value = `${response.data.tgldaftar}`);
                        $('#stpriksa value').append( document.getElementById("stpriksa").value = `${response.data.tolak}`);
                        $('#donorke value').append( document.getElementById("donorke").value = `${response.data.donorke}`);
                        $('#ktdg value').append( document.getElementById("ktdg").value = `${response.data.jnsktg}`);
                        $('#jnsktg value').append( document.getElementById("jnsktg").value = `${response.data.jnsktg}`);
                        $('#ccambil value').append( document.getElementById("ccambil").value = `${response.data.ccambil}`);
                        $('#typektg value').append( document.getElementById("typektg").value = `${response.data.typektg}`);
                        $('#kdcab value').append( document.getElementById("kdcab").value = `${response.data.ckdasldrh}`);
                        $('#nmcab value').append( document.getElementById("nmcab").value = `${response.data.asldrh}`);
                        $('#almtsrt value').append( document.getElementById("almtsrt").value = `${response.data.almsrt1}`);
                        $('#wilsrt value').append( document.getElementById("wilsrt").value = `${response.data.nmwil}`);
                        $('#caraambil value').append( document.getElementById("caraambil").value = `${response.data.mtdpeng}`);
                        $('#stoppd value').append( document.getElementById("stoppd").value = `${response.data.ccambil}`);
                        $('#ambildrh value').append( document.getElementById("ambildrh").value = `${response.data.ccambil}`);
                        $('#satlit value').append( document.getElementById("satlit").value = `${response.data.satelit}`);


                          // Tampilkan modal
                var modal = new bootstrap.Modal(document.getElementById('resultModal'));
                modal.show();
                        $('#items-table tbody').append(`
                            <tr data-kode="${response.data.id}">
                                <td>${response.data.nodonor}</td>
                                <td>${response.data.namadonor}</td>
                                <td>${response.data.tglperiksa}</td>
                                <td>${response.data.alamat}</td>
                                <td>${response.data.almsrt2}</td>
                                <td>${response.data.noktp}</td>

                                <td><button class="btn btn-danger btn-sm removeBtn">Hapus</button></td>
                            </tr>
                        `);
                    }// Menambahkan baris baru di awal tabel
                } else {
                    alert(response.message);  // Jika barcode sudah ada
                }
                  // $('#noaftp').val('').focus();
            },
            error: function() {
                alert('Error pencarian data');
            }
        });
    });



function msg() {
  alert("Hello world!");
}
      // Hapus dari tabel
    $(document).on('click', '.removeBtn', function () {
        let row = $(this).closest('tr');
        let kode = row.data('nokntng');

        scannedItems = scannedItems.filter(item => item.nokntng !== kode);
        row.remove();
    });


 $('#saveBtn').click(function () {
          
        if (scannoaftp.length=== 0) {
            alert('Belum ada data yg di push');
            return;
        }
         var durasi = $('#durasi').val(); 
         var catatan = $('#catatan').val(); 


        $.ajax({
                    url: '{{ route("svtransdnr") }}',
                    method: 'POST',
                    data: {
                        aftp: scannoaftp,
                        durasi: durasi,
                        catatan: catatan,
                    },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    success: function(res) {
                      
                            alert(res.message);
          //  if (res.message === 'success') {
                            console.log('save: ',res);
                            scannoaftp = [];
                    // Swal.fire({
                    //     toast: true,
                    //         position: 'top-end',
                    //         icon: 'success',
                    //         title: 'Berhasil disimpan',
                    //         showConfirmButton: false,
                    //         timer: 3000,
                    //         timerProgressBar: true
                    // }).then(() => {

                            $('#items-table tbody').empty();
                             $('#noaftp').val('');
                             $('#jnsdnr').val('');
                             $('#nofpup').val('');
                             $('#namaos').val('');
                             $('#ptgsaftp').val('');
                             $('#kdptgsaftp').val('');
                             $('#kdcab').val('');
                             $('#priksahb').val('');
                             $('#reaksiambil').val('');
                             $('#reaksidnr').val('');
                             $('#puasa').val('');
                             $('#waktu').val('');
                             $('#ktgpenuh').val('');
                             $('#sampledrh').val('');
                             $('#sulit').val('');
                             $('#lancar').val('');
                             $('#surat').val('');
                             $('#catatan').val('');
                             $('#nmos').val('');
                             $('#nmrs').val('');
                             $('#nokantong').val('');
                             $('#noselang').val('');
                             $('#nolot').val('');
                            // Tunggu 1 detik lalu reload halaman
                            setTimeout(function () {
                              location.reload();
                            }, 1000);
                                  //  location.reload();
                    // });
                             
                          // Clear semua checkbox
                          // document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);

                  // }

                        },


                });
        
     
    });

    


$(document).ready(function () {
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('data.reload') }}",
            type: 'GET',
            data: formData,
            success: function (data) {
                let rows = '';
                if (data.length === 0) {
                    rows = '<tr><td colspan="12">Data tidak ditemukan</td></tr>';
                } else {
                    data.forEach(function (i) {
                        rows += `<tr>
                                <td>${i.nodonor}</td>
                                <td>${i.namadonor}</td>
                                <td>${i.noaftap}</td>
                                <td>${i.tglaftap}</td>
                                <td>${i.nokntng}</td>
                                <td> - </td>
                                <td>${i.jnsktg}</td>
                                <td>${i.nmcab}</td>
                                <td>${i.goldar}</td>
                                <td>${i.ccamb}</td>
                                </tr>`;
                    });
                }

                $('#result-table  tbody').html(rows);
            }
        });
    });
});
</script>



@endsection