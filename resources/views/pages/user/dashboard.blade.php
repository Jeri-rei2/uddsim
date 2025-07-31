@extends('layouts.main')
@section('title', 'User Home')


@section('content')
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="row">
            <div class="col-lg-8 mb-md-0 mb-3">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary display-6">Halo, {{auth()->user()->name}}! 🎉</h5>
                                <p class="mb-4">
                                    {{\Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY');}}
                                </p>
                                <p class="fw-bold text-muted" style="font-size: 13px">
                                  
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{asset('sneat/assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                    <a href="">
                        <div class="col-12">
                            <div class="card-body">
                            <i class='fa fa-medkit' style="font-size: 35px;"></i>

                                <div class="py-2">Resep Dokter</div>
                                <h2></h2>
                            </div>
                        </div>
                </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <a href="">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class='fa fa-laptop' style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Reservasi</span>
                        <h3 class="card-title mb-2"></h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                <a href="">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="fa fa-stethoscope"style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Home Care </span>
                        <h3 class="card-title mb-2"></h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                <a href="">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class="fa fa-calendar" style="font-size: 35px;"></i>
                            
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Jadwal Dokter</span>
                        <h3 class="card-title mb-2"></h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                    </div>
                </a>
                </div>
            </div>
            <!-- <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class='bx bx-box' style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Stock</span>
                        <h3 class="card-title mb-2"></h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                    </div>
                </div>
            </div> -->
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                  <a href="">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class='bx bx-dollar-circle' style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Riwayat Pembayaran</span>
                        <h3 class="card-title mb-2">{{$data['bayar']}}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                    </div>
                 </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class='bx bx-user-circle text-dark' style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pengguna</span>
                        <h3 class="card-title mb-2">{{$data['pengguna']}}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <div class="card">
                  <a href="">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                            <i class='fa fa-book' style="font-size: 35px;"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Detail Pesanan</span>
                        <h3 class="card-title mb-2">{{$data['transaksi']}}</h3>
                        {{-- <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                    </div>
                        </div>
                </div>
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
