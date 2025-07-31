@extends('layouts.main')
@section('title', 'Pengiriman')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Master /</span> Pengiriman Darah </h4>
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
 <div class="row">
        <div class="card">
                        <div class="card-header">
                            DATA PENGIRIMAN
                        </div>
                        <div class="card-body">
                            <div class="button-action" style="margin-bottom: 20px">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">
                                <i class='bx bxs-file-import'> </i>  IMPORT
                                </button>
                                <a href="{{ route('kirim.export') }}" class="btn btn-primary btn-md"> <i class='bx bx-export' > </i> Export</a>
                                <a   class="btn btn-warning me-1 print" id="print" href="{{route('ctkkirim')}}" target="_blank"><i class='bx bx-qr' > </i> Buat QR</a>
                            </div>
                        
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">No Pengeluaran</th>
                                        <th scope="col">No Permintaan</th>
                                        <th scope="col">Tgl Permintaan</th>
                                        <th scope="col">Tgl Pengeluaran </th>
                                        <th scope="col">Dikirim Ke</th>
                                        <!-- <th scope="col">No Stok</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($kirimbanyak as $item)
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->nokeluar}}</td>
                                        <td>{{$item->nopermintaan}}</td>
                                        <td>{{$item->tglpermintaan}}</td>
                                        <td>{{$item->tglkeluar}}</td>
                                        <td>{{$item->pengirim}}</td>
                                        <!-- <td>{{$item->nostok}}</td> -->

                                    
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


<!-- modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kirim.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File</label>
                        <input type="file" name="file" class="form-control" required>
                        <span class="label label-default" style="font-size:10px;">Format File xl, xls</span>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success"><i class='bx bxs-save' ></i> simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>


@endsection