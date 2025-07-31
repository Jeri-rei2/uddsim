@extends('backend.adm')
@section('title', 'Resep Masuk')


@section('content')
@push('custom-css')


@endpush

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> Resep Masuk</h4>

<div class="card border-0 shadow-sm rounded">
                                                <div class="card-body">
                                                @if ($message = Session::get('success'))
                                                    <div class="alert alert-success">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                @endif
                                                <table id="resep" class="display" >
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
                                                            <th scope="col">Status</th>


                                                            <th scope="col">AKSI</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $a=1; ?>
                                                        @forelse ($data as $data)
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
                                                                <td>
                                                                @if ($data->status_bayar == "Belum Dibayar")
                                                                    <div class="badge bg-danger text-white">{{$data->status_bayar}}</div>
                                                                    @elseif($data->status_bayar == "Sudah Dibayar")
                                                                    <div class="badge bg-warning text-white">{{$data->status_bayar}}</div>
                                                                    @else
                                                                    <div class="badge bg-success text-white">{{$data->status_bayar}}</div>
                                                                    @endif 
                                                                </td>
                                                               
                                                                <td>                          
                                                                     @if($data->status_bayar == "Belum Dibayar")
                                                                    <a href="{{route('add.obat',[$data->user_id] )}}">
                                                                    <input type="hidden" name="user_id" id="user_id" value="{{$data->user_id}}">
                                                                    <button type="button" class="btn dropdown-item" id="pay-button" style="height: 45px;">
                                                                            <i class="fa fa-money"> </i> Bayar Sekarang
                                                                    </button>
                                                                    </a>
                                                                    <!-- <button type="button" class="btn dropdown-item" data-bs-toggle="modal" data-bs-target="#inputPembayaran" data-target="#inputPembayaran">
                                                                        <i class='bx bx-wallet me-1'></i> Input Pembayaran
                                                                    </button> -->
                                                                    @endif

                                                                        <a href="{{route('invoiceobat',$data->user_id)}}" target="_blank" class="dropdown-item">
                                                                            <i class='bx bx-receipt me-1'></i> Bukti Pembayaran Resep</a>
                                                                 
                                                                      
                                                                       
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
                                            <div class="modal fade" id="exampleModalLong" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Resep</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                
                                                    <form action="" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                    <label for="obat">Dokter</label>
                                                    <input type="text" readonly class="form-control" id="obat" name="obat"
                                                        value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="obat">Nama Obat</label>
                                                    <select name="obat" id="obat"  class="form-control @error('obat') is-invalid @enderror" required >
                                                    <option disabled>-- Pilih Obat --</option>
                                                    
                                                    <option value=""></option>
                                                  
                                                   </select>
                                                    <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" rows="3" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="jumlah">Aturan Pakai</label>
                                                    <input type="text" class="form-control" id="aturanpakai" name="aturanpakai" rows="3" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="jumlah">Keterangan</label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" rows="3" value="" required>
                                                    </div>
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
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span> History Pembayaran Resep</h4>
<div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="myTable" class="display" >
                        <thead>
                        <tr>
                            <th>#</th>   
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Tanggal Resep</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <?php $a=1; ?>
                        @forelse ($masuk as $data)
                        <tbody>
                        <tr>
                        <td>{{$a++}}</td>
                            <td>{{$data->obat}}</td>
                            <td>{{\Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY')}}</td>
                            <td>{{\Carbon\Carbon::parse($data->updated_at)->isoFormat('D MMMM YYYY')}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->pasien}}</td>
                            <td>{{$data->dokter}}</td>
                            <td>
                            @if ($data->status_bayar == "Belum Dibayar")
                            <div class="badge bg-danger text-white">{{$data->status_bayar}}</div>
                            @elseif($data->status_bayar == "Sudah Dibayar")
                            <div class="badge bg-warning text-white">{{$data->status_bayar}}</div>
                            @else
                            <div class="badge bg-success text-white">{{$data->status_bayar}}</div>
                            @endif 
                            </td>
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
</div>

                                        
@endsection

@push('custom-scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
$(document).ready( function () {
    $('#resep').DataTable();
} );

</script>



@endpush