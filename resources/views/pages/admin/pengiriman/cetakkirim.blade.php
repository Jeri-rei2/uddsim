@extends('layouts.main')
@section('title', 'Cetak ')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Generate Data</h4>
    <!-- <div class="py-3">
        <a href="{{route('barang.create')}}" class="btn btn-primary float-right">Tambah Baru</a>
    </div> -->
</div>
<div class="row">
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>
                <button style="border: none; background: transparent; font-size: 14px;" id="MyTableCheckAllButton">
                <i class="far fa-square"></i>  
                </button>
            </th>
            <th>No Pengiriman</th>
            <th>No Permintaan</th>
            <th>Tgl Pengiriman</th>
            <th>No Permintaan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach ($kirimbanyak as $item)
        <tr>
            <td></td>
            <td> {{$item->nokeluar}}</td>
            <td>{{$item->nopermintaan}}</td>
            <td>{{$item->tglkeluar}}</td>
            <td>{{$item->nopermintaan}}</td>
            <td>
            <a class="dropdown-item" href="{{route('generate', $item->id)}}" ><i class="bx bx-edit-alt me-1"> </i>Buat QR <i class='bx bx-qr' > </i></a>
              
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>
</div>

<script>
$(document).ready(function() {
    let myTable = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0,
        }],
        select: {
            style: 'os', // 'single', 'multi', 'os', 'multi+shift'
            selector: 'td:first-child',
        },
        order: [
            [1, 'asc'],
        ],
    });

  myTable.on('select deselect draw', function () {
        var all = myTable.rows({ search: 'applied' }).count(); // get total count of rows
        var selectedRows = myTable.rows({ selected: true, search: 'applied' }).count(); // get total count of selected rows

        if (selectedRows < all) {
            $('#MyTableCheckAllButton i').attr('class', 'fa fa-square');
        } else {
            $('#MyTableCheckAllButton i').attr('class', 'fa fa-check-square');
        }

    });

    $('#MyTableCheckAllButton').click(function () {
        var all = myTable.rows({ search: 'applied' }).count(); // get total count of rows
        var selectedRows = myTable.rows({ selected: true, search: 'applied' }).count(); // get total count of selected rows


        if (selectedRows < all) {
            //Added search applied in case user wants the search items will be selected
            myTable.rows({ search: 'applied' }).deselect();
            myTable.rows({ search: 'applied' }).select();
        } else {
            myTable.rows({ search: 'applied' }).deselect();
        }
    });
});
</script>
<link rel="stylesheet" href="https:////code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"></link>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.jqueryui.min.css"></link>
   <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.2/css/scroller.jqueryui.min.css"></link>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.21/js/dataTables.jqueryui.min.js"></script>
   <script src="https://cdn.datatables.net/scroller/2.0.2/js/dataTables.scroller.min.js"></script>
@endsection