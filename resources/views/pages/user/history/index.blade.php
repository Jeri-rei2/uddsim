@extends('backend.adm')
@section('title', 'Hisory Pesanan')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> History</h4>
    <div class="py-3">
        <a href="{{route('home')}}">
        <button type="button" class="btn btn-primary mb-3">
            <i class="fa fa-arrow-alt-circle-left mr-2"></i> Kembali ke Daftar Menu 
         </button>
        </a>
    </div>
</div>

@if(session('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="fw-bold py-3 mb-4">  RIWAYAT PESANAN  </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">

                <table id="example" class="display table table-bordered py-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pesanan</th>
                            <th>Nama</th>
                            <th>Lihat Semua</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Order</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a=1; ?>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$a++}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>
                                <div class="badge bg-secondary" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#showData{{$order->id}}" data-target="#showData{{$order->id}}"><i class="fa fa-eye" aria-hidden="true"> </i> Tampilkan</div>
                                <div class="modal fade" id="showData{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nomor Pesanan : <span class="font-weight-bold">{{$order->order_id}}</span></h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Area / Lokasi</th>
                                                                    <th>Nama Pasien</th>
                                                                    <th>Status Periksa</th>
                                                                    <th>Total Harga</th>
                                                                    <th>Keluhan</th>
                                                                   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i=1; ?>
                                                                @foreach ($orders as $item)
                                                                <tr>
                                                                    <td>{{$i++}}</td>
                                                                    <td>{{$item->name}}</td>
                                                                    <td>{{$item->user->name}}</td>
                                                                    <td><div class="badge bg-success text-white">{{$item->status}}</div></td>
                                                                    <td>@currency($item->total_harga)</td>
                                                                    <td>{{$item->keluhan}}</td>
                                                                   
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                            
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </td>
                            <td>@currency($order->total_harga)</td>
                            <td>
                                <div class="badge bg-success text-white">
                              
                                {{$order->status}}
                              
                            </div>
                            </td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY')}}</td>
                            

                            @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>No Pesanan</th>
                            <th>Nama</th>
                            <th>Nama Barang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Order</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>


    <!-- Button trigger modal -->
    @foreach ($orders as $order)
    <div class="modal fade" id="inputPembayaran{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('pembayaran.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="pesanan_id" value="{{$order->id}}">
                    <input type="hidden" name="user_id" value="{{$order->user_id}}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Pembayaran</h1>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="defaultFormControlInput" class="form-label">Nama</label>
                                    <input type="text" readonly value="{{$order->user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Nomor Handphone</label>
                                    <input type="text" readonly value="{{$order->user->phone_number}}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Email</label>
                                    <input type="email" readonly value="{{$order->user->email}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="h-100">
                                        <div class="container h-100 py-2">
                                            <div class="row d-flex justify-content-center align-items-center h-100">
                                                <div class="border py-3 rounded text-center">
                                                    <div class="mb-2">
                                                        Total Bayar
                                                    </div>
                                                    <div class="display-4 ">@currency($order->total_harga)</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="defaultFormControlInput" class="form-label">Pembayaran</label>
                                    <select name="type" id="type-{{$order->id}}" class="form-control" onchange="selectPayment({{$order->id}})">
                                        <option value="" selected disabled>-- Pilih Pembayaran --</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="cash-{{$order->id}}" class="cash d-none">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="defaultFormControlInput" class="form-label">Nominal Bayar</label>
                                        <input type="text" class="form-control @error('total_bayar') is-invalid @enderror" name="total_bayar" id="total_bayar" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('total_bayar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="transfer-{{$order->id}}" class="transfer d-none">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="defaultFormControlInput" class="form-label">Pilih Bank</label>
                                        <select name="type_bank" id="type_bank" class="form-control">
                                            <option value="" selected disabled>-- Pilih Bank --</option>
                                            <option value="bri">Bank Rakyat Indonesia (BRI)</option>
                                            <option value="bca">Bank Central Asia (BCA)</option>
                                            <option value="mandiri">Mandiri</option>
                                            <option value="bni">Bank Negara Indonesia (BNI)</option>
                                        </select>
                                        @error('type_bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="defaultFormControlInput" class="form-label">Masukan Nomor Rekening</label>
                                        <input type="number" class="form-control @error('no_rek') is-invalid @enderror" name="no_rek" id="no_rek" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('no_rek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="defaultFormControlInput" class="form-label">Nama Rekening</label>
                                        <input type="text" class="form-control @error('nama_rek') is-invalid @enderror" name="nama_rek" id="nama_rek" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('nama_rek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="defaultFormControlInput" class="form-label">Jumlah Transfer</label>
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="defaultFormControlInput" class="form-label">Bukti Transfer</label>
                                        <input type="file" class="form-control @error('bukti_tf') is-invalid @enderror" name="bukti_tf" id="bukti_tf" {{-- placeholder="John Doe" --}} aria-describedby="defaultFormControlHelp" />
                                        @error('bukti_tf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Modal -->

</div>
<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">
        <h5 class="fw-bold py-3 mb-4">  RIWAYAT RESEP </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">

                <table id="example" class="display table table-bordered py-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Obat</th>
                            <th>Tanggal Resep</th>
                            <th>Tanggal Bayar</th>
                            <th>Nama Pasien</th>
                            <th>Dokter Resep</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a=1; ?>
                        @foreach ($resep as $order)
                        <tr>
                            <td>{{$a++}}</td>
                            <td>{{$order->obat}}</td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY')}}</td>
                            <td>
                            {{\Carbon\Carbon::parse($order->updated_at)->isoFormat('D MMMM YYYY')}}
                            </td>
                            <td>{{$order->pasien}}</td>
                            <td>{{$order->dokter}}</td>
                            <td>
                                @currency($order->total_harga)
                            </td>
                            <td><div class="badge bg-success text-white">{{$order->status_bayar}}</div></td>

                            @endforeach
                    </tbody>
                
                </table>

            </div>
        </div>
    </div>


   

</div>




@endsection

@push('custom-scripts')
<script type="text/javascript">
    function selectPayment(id) {
        console.log(id)
        let type = document.getElementById(`type-${id}`).value;
        let cash = document.getElementById(`cash-${id}`);
        console.log(cash)
        let transfer = document.getElementById(`transfer-${id}`);
        if (type == "Cash") {
            cash.classList.remove("d-none")
            transfer.classList.add("d-none")
        } else {
            transfer.classList.remove("d-none")
            cash.classList.add("d-none")

        }
    }

</script>
@endpush

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });

</script>
@endpush
@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Apakah Anda Yakin Ingin Menghapus Data ini?"
            , text: "Jika ini terhapus, data akan hilang selamanya"
            , icon: "warning"
            , type: "warning"
            , buttons: ["Cancel", "Yes!"]
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });

</script>
<script type="text/javascript">
    $('.finish_alert').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Selesaikan Pesanan ini?"
            , text: "klik Ya apabila proses pesanan telah selesai"
            , icon: "warning"
            , type: "warning"
            , buttons: ["Cancel", "Yes!"]
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Ya, Selesaikan!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });

</script>
@endpush
