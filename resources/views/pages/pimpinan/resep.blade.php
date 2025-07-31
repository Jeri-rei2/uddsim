@extends('backend.adm')
@section('title', 'Resep Dokter')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <style type="text/css">
        	.signature-pad{
        		border: 1px solid #ccc;
        		border-radius: 5px;
        		width: 100%;
        		height: 260px;
        	}
        </style>
<meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
@if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dokter / </span> Resep Obat</h4>

                    <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Input Resep</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Data Resep</a>
                                    </li>
                                   
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="row">
                                                <div class="col-12">
                                                    <div class="card mb-4">
                                                        <div class="container py-4">
                                                        <form method="POST" action="{{ route('signaturepad.upload') }}">
                                                                    @csrf
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="defaultFormControlInput" class="form-label">Kode Barang</label>
                                                                            @foreach($users as $res)
                                                                            <input type="hidden" id="status_bayar" name="status_bayar" value="Belum Dibayar">
                                                                            <input type="hidden" id="pesanan_id" name="pesanan_id" value="{{$res->id}}">
                                                                            <input type="hidden" id="user_id" name="user_id" value="{{$res->user->id}}">
                                                                            @endforeach
                                                                            <input type="text" readonly value="" class="form-control " name="kode_brng" id="kode_brng"/>
                                                                            <input type="hidden" readonly value="" class="form-control " name="nama_brng" id="nama_brng"/>
                                                                            @error('kode_brng')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="" class="form-label">Nama Pasien</label>
                                                                            <select name="pasien" id="pasien"  class="form-control @error('pasien') is-invalid @enderror" required >
                                                                               <option disabled>-- Pilih Obat --</option>
                                                                                @foreach($users as $res)
                                                                                <option value=" {{$res->user->name}}">{{$res->user->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                      
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-4">
                                                                            <label for="defaultFormControlInput" class="form-label">Jumlah obat</label>
                                                                            <input type="number" value="{{ old('jumlah') }}" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah"  aria-describedby="defaultFormControlHelp" />
                                                                            @error('jumlah')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="defaultFormControlInput" class="form-label">Aturan Pakai</label>
                                                                            <select name="aturanpakai" id="aturanpakai"  class="form-control  @error('aturanpakai') is-invalid @enderror" placeholder="Select City" required >
                                                                                <option disabled>-- Pilih Obat --</option>
                                                                                <option value="1x1">1 x 1</option>
                                                                                <option value="1 x 1 Sesudah Makan">1 x 1 Sesudah Makan</option>
                                                                                <option value="3 x 1">3 x 1 </option>
                                                                                <option value="3 x 1">3 x 2 Sehari</option>
                                                                                <option value="3 x 1">3 x 3 Sehari Sebelum Makan</option>

                                                                            </select>
                                                                        
                                                                            @error('aturanpakai')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="defaultFormControlInput" class="form-label">Tanggal Resep</label>
                                                                            <input type="date"class="form-control @error('tglresep') is-invalid @enderror" name="tglresep" id="tglresep" aria-describedby="defaultFormControlHelp" />
                                                                            @error('tglresep')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                    <div class="col-md-6">
                                                                            <label for="obat" class="form-label">Nama Obat</label>
                                                                            
                                                                            <select name="obat" id="obat"  class="form-control select2 @error('obat') is-invalid @enderror" required >
                                                                               <option disabled>-- Pilih Obat --</option>
                                                                                @foreach($obat as $res)
                                                                                
                                                                                <option value="{{$res->kode_brng}}">{{$res->nama_brng}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('obat')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="defaultFormControlInput" class="form-label">Dokter Resep</label>
                                                                            <input type="text" readonly value=" {{ Auth::user()->name }}" class="form-control @error('in_stock') is-invalid @enderror" name="dokter" id="dokter" aria-describedby="defaultFormControlHelp" />
                                                                            @error('in_stock')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                    
                                                                    <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                                                <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="13" name="keterangan"></textarea>
                                                                                @error('keterangan')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{$message}}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                    <!-- <label for="foto" class="form-label">TTD Dokter</label>
                                                                            <div class="text-right">
                                                                                <button type="button" class="btn btn-default btn-sm" id="undo"><i class="fa fa-undo"></i> Undo</button>
                                                                                <button type="button" class="btn btn-danger btn-sm" id="clear"><i class="fa fa-eraser"></i> Clear</button>
                                                                            </div>
                                                                    <br> -->

                                                                            <!-- <div class="wrapper">
                                                                            <canvas id="signature-pad" class="signature-pad"></canvas>
                                                                            </div>
                                                                            <br>
                                                                            <button type="button" class="btn btn-primary btn-sm" id="save-png">Save as PNG</button>
                                                                            <button type="button" class="btn btn-info btn-sm" id="save-jpeg">Save as JPEG</button>
                                                                            <button type="button" class="btn btn-default btn-sm" id="save-svg">Save as SVG</button>
                                                                            <a href="{{route('pimpinan.home')}}">
                                                                             <button type="button" class="btn btn-warning btn-sm" ><i class="fa fa-arrow-alt-circle-left mr-2"> </i> Kembali</button></a> -->

                                                                    <!-- Modal untuk tampil preview tanda tangan-->
                                                                    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Preview Tanda Tangan</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                    <button type="button" class="btn btn-danger btn-sm" ><i class="fa fa-times"></i> Cancel</button>
                                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                                                 </div>          
                                                                    </div>
                                                                    
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                         </div>
                                  
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        
                                    <div class="card border-0 shadow-sm rounded">
                                                <div class="card-body">
                                                @if ($message = Session::get('success'))
                                                    <div class="alert alert-success">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                @endif
                                                <div class="table-responsive text-nowrap">
                                                <table id="myTable" class="display" >
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                           
                                                            <th scope="col">Nama Obat</th>
                                                            <th scope="col">Jumlah Resep</th>
                                                            <th scope="col">Atutran Pakai</th>
                                                            <th scope="col">Tanggal Resep</th>
                                                            <th scope="col">Keterangan</th>
                                                            <th scope="col">Nama Pasien</th>
                                                            <th scope="col">Dokter</th>


                                                            <th scope="col">AKSI</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $a=1; ?>
                                                      
                                                               @forelse ($resep as $data)
                                                            <tr>
                                                                <td>{{$a++}}</td>
                                                                <td>{{$data->obat}}</td>
                                                                <td>{{$data->jumlah}}</td>
                                                                <td>{{$data->aturanpakai}}</td>
                                                                <td>{{\Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY')}}</td>
                                                                <td>{{$data->keterangan}}</td>
                                                              
                                                                <td>
                                                                    {{$data->pasien}}   
                                                             </td>
                                                                <td>
                                                                    {{$data->dokter}}   
                                                                </td>
                                                              
                                                                <td class="text-center">
                                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('hapusresep', $data->id) }}" method="POST">
                                                                        <a href="{{route('resepcetak', $data->id)}}" target="_blank"class="btn btn-sm btn-dark"> <i class="fa fa-eye" aria-hidden="true"> </i> Lihat Resep</a>
                                                                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"> </i> EDIT</a>
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> HAPUS</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <div class="alert alert-danger">
                                                                Data Resep belum Tersedia.
                                                            </div>
                                                            @endforelse
                                                        </tbody>
                                                    </table>  
                                                    
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModalLong" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Resep</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    @foreach($resep as $data)
                                                    <form action="{{ route('editresep.update', $data->id) }}" method="post">
                                                    @endforeach
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                    <label for="obat">Dokter</label>
                                                    @foreach($resep as $data)
                                                    <input type="text" readonly class="form-control" id="obat" name="obat"
                                                        value="{{ $data->dokter }}" required>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="obat">Nama Obat</label>
                                                    <select name="obat" id="obat"  class="form-control @error('obat') is-invalid @enderror" required >
                                                    <option disabled>-- Pilih Obat --</option>
                                                    @foreach($obat as $res)
                                                    <option value="{{$res->kode_brng}} ( {{$res->nama_brng}} )">{{$res->nama_brng}}</option>
                                                    @endforeach
                                                   </select>
                                                    <div class="form-group">
                                                    @foreach($resep as $data)
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" rows="3" value="{{ $data->jumlah }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="jumlah">Aturan Pakai</label>
                                                    <input type="text" class="form-control" id="aturanpakai" name="aturanpakai" rows="3" value="{{ $data->aturanpakai }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="jumlah">Keterangan</label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" rows="3" value="{{ $data->keterangan }}" required>
                                                    </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ubah Resep</button>
                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


@endsection
@push('custom-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
        <script src="{{asset('ttdonline/signature-pad.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();

    $('#obat').on('change', function() {
        var selectedOption = $(this).find(':selected');
        var selectedValue = selectedOption.val();
        var selectedText = selectedOption.text();

  $('#kode_brng').val(selectedValue);
  $('#nama_brng').val(selectedText);



        console.log("Selected value is: " + selectedValue);
        console.log("Selected text is: " + selectedText);
    });
});

</script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );


</script>
@endpush