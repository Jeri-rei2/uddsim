@extends('backend.adm')
@section('title', 'User Home')


@section('content')
@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="main-content-inner">



<div class="sales-report-area mt-5 mb-5">
                        <label>DOKTER UMUM</label>
                        <div class="row">
                            <div class="col-md-4">
                                    <a href="{{ route('createumum') }}">
                                        <div class="single-report mb-xs-30">
                                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                                <div class="icon"><i class="fa fa-user-md"></i></div>
                                                <div class="s-report-title d-flex justify-content-between">
                                                    <h4 class="header-title mb-0">Dr.Ferie Kristianto</h4>
                                                    <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                                </div>
                                                <div class="d-flex justify-content-between pb-2">
                                                    <!-- <h2>$ 4567809,987</h2>
                                                    <span>- 45.87</span> -->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                            </div>
                            <div class="col-md-4">
                            <a href="{{ route('createumum') }}">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Jasinda</h4>
                                                <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                   <a href="{{ route('createumum') }}">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Taufiq</h4>
                                                <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                   <a href="{{ route('createumum') }}">
                                    <div class="single-report mb-xs-30">
                                        <div class="s-report-inner pr--20 pt--30 mb-3">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="s-report-title d-flex justify-content-between">
                                                <h4 class="header-title mb-0">Dr.Nurul</h4>
                                                <br/><p>Senin - Minggu  (Sesuai jadwal)</p>
                                            </div>
                                            <div class="d-flex justify-content-between pb-2">
                                                <!-- <h2>$ 4567809,987</h2>
                                                <span>- 45.87</span> -->
                                            </div>
                                        </div>
                                    </div>
                                    </a>
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
