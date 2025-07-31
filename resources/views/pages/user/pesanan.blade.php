@extends('backend.adm')
@section('title', 'User Home')

@push('custom-css')
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{asset('fe/css/styles.css')}}" rel="stylesheet" />
@endpush

@section('scripts')
 <!-- Bootstrap icons-->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{asset('fe/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}" />
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <style>
        body {
            background-color: #eeeeee;
            /* font-family: 'Open Sans', serif; */
            font-size: 14px;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        footer {
            position: absolute;
            width: 100%;
            /* bottom: -100px; */
        }

    </style>
@endsection

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Pesanan /</span> Keluhan</h4>
    <div class="py-3">
        <a href="{{route('home')}}">
        <button type="button" class="btn btn-primary mb-3">
            <i class="fa fa-arrow-alt-circle-left mr-2"></i> Kembali ke Daftar Menu 
         </button>
        </a>
    </div>
</div>


    <!-- Section-->
    <section class="py-5 mb-5 mt-3">
        <div class="container px-4 px-lg-5 mt-0 py-5">
            <div class="card">
                <div class="card-header">
                    List Pesanan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-bordered py-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Pesanan</th>
                                    <th>Nama</th>
                                    <th>Keluhan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal Order</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a=1; ?>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->keluhan}}
                                    <td>@currency($order->total_harga)</td>
                                    <td>
                                        @if ($order->status == "Belum Dibayar")
                                        <div class="badge bg-danger text-white">{{$order->status}}</div>
                                        @elseif($order->status == "Sudah Dibayar")
                                        <div class="badge bg-warning text-white">{{$order->status}}</div>
                                        @else
                                        <div class="badge bg-success text-white">{{$order->status}}</div>
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY')}}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($order->status == "Belum Dibayar")
                                                <button type="button" class="btn dropdown-item" id="pay-button">
                                                    <i class='bx bx-wallet me-1'></i> Bayar Sekarang
                                                </button>
                                                <!-- <button type="button" class="btn dropdown-item" data-bs-toggle="modal" data-bs-target="#inputPembayaran{{$order->id}}" data-target="#inputPembayaran{{$order->id}}">
                                                    <i class='bx bx-wallet me-1'></i> Input Pembayaran
                                                </button> -->
                                                @endif

                                                <a href="{{route('fe.pesanan.invoice', $order->order_id)}}" target="_blank" class="dropdown-item"><i class='bx bx-receipt me-1'></i> Cetak Receipt</a>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>No Pesanan</th>
                                    <th>Nama</th>
                                    <!-- <th>Nama Barang</th> -->
                                    <th>Keluhan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal Order</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Button trigger modal -->
    @foreach ($orders as $order)
    <div class="modal fade" id="inputPembayaran{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
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
             


    <!-- Footer-->
    <footer class="py-5 bg-dark footer mt-5">
        <div class="container">
            <p class="m-0 text-center text-white">
                Copyright &copy; IT RS SURABAYA MEDICAL SERVICE
            </p>
        </div>
    </footer>

 
    @endsection
    @section('scripts') 
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });

    </script>
    <script type="text/javascript">
        let data = JSON.parse(localStorage.getItem('listaCards'))
        let cart = document.querySelector('.cart');

        cart.innerText = data.length
        console.log(data)

    </script>
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
        function destroyLocalStorage() {
            localStorage.clear();
        }
    </script>
@endsection
