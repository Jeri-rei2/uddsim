@extends('layouts.main')
@section('title', 'Supplier')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master  /</span> Supplier</h4>
    <div class="py-3">
        <a href="{{route('supplier.create')}}" class="btn btn-primary float-right">Tambah Baru</a>
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
            List Supplier
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">

            <table id="example" class="display table table-bordered py-3 table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telphone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->kodesupplier}}</td>
                        <td>{{$item->nama_supplier}}</td>
                        <td>{{$item->alamat}} </td>
                        <td>{{$item->telepon}}</td>
                        <td class="d-flex justify-content-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('supplier.show', $item->id)}}" class="dropdown-item"><i class='bx bx-search-alt'></i> Detail</a>
                                    <a class="dropdown-item" href="{{route('supplier.edit', $item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form method="POST" action="{{route('supplier.destroy', $item->id)}}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn dropdown-item show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="bx bx-trash me-1"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>#</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telphone</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>

        </div>
        </div>
    </div>
</div>
@endsection

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
@endpush
