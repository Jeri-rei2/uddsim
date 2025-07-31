@extends('layouts.main')
@section('title', 'Serologi')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <style>
     body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f9f9f9;
    }

    .tabs, .sub-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
    }

    .tabs button, .sub-tabs button {
      padding: 10px 20px;
      cursor: pointer;
      background-color: #ddd;
      border: none;
      border-radius: 5px;
    }

    .tabs button.active, .sub-tabs button.active {
      background-color: #4CAF50;
      color: white;
    }

    .tab-content, .sub-content {
      display: none;
    }

    .tab-content.active, .sub-content.active {
      display: block;
    }

    .card {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-top: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 8px 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
 .header-bar {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .summary {
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
@endpush

@section('content')
 <div class="container">
     <!-- Tab Utama -->
  <div class="tabs">
    <button class="tab-btn active" data-tab="tab1">Alinity</button>
    <button class="tab-btn" data-tab="tab2">Sysmex</button>
  </div>

  <!-- Tab 1 Content -->
  <div id="tab1" class="tab-content active">
    <div class="sub-tabs">
      <button class="sub-btn active" data-sub="sub1-1">WorkCell A</button>
      <button class="sub-btn" data-sub="sub1-2">WorkCell B</button>
      <button class="sub-btn" data-sub="sub1-3">WorkCell C</button>
    </div>

    <div id="sub1-1" class="sub-content active">
      <div class="card">
        <!-- <h3>Data WorkCell A </h3> -->
          <div class="header-bar">
                    <div>
                    <h4>Nama Menu: Alinity</h4>
                    </div>
                    <div>
                    <input type="text" class="form-control" placeholder="Plain Number">
                    </div>
                </div>
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>

    <div id="sub1-2" class="sub-content">
      <div class="card">
        <!-- <h3>Data WorkCell B </h3> -->
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>

    <div id="sub1-3" class="sub-content">
      <div class="card">
        <!-- <h3>Data WorkCell C</h3> -->
        
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>
  </div>

  <!-- Tab 2 Content -->
  <div id="tab2" class="tab-content">
    <div class="sub-tabs">
      <button class="sub-btn active" data-sub="sub2-1">HISCL 1</button>
      <button class="sub-btn" data-sub="sub2-2">HISCL 2</button>
      <button class="sub-btn" data-sub="sub2-3">HISCL 3</button>
    </div>

    <div id="sub2-1" class="sub-content active">
      <div class="card">
        <!-- <h3>Data HISCL 1 - Tab 2</h3> -->
          <div class="header-bar">
                    <div>
                    <h4>Nama Menu: Sysmex</h4>
                    </div>
                    <div>
                    <input type="text" class="form-control" placeholder="Plain Number">
                    </div>
                </div>
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>

    <div id="sub2-2" class="sub-content">
      <div class="card">
        <!-- <h3>Data HISCL 2 - Tab 2</h3> -->
        <div class="header-bar">
                    <div>
                    <h4>Nama Menu: Sysmex</h4>
                    </div>
                    <div>
                    <input type="text" class="form-control" placeholder="Plain Number">
                    </div>
                </div>
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>

    <div id="sub2-3" class="sub-content">
      <div class="card">
        <!-- <h3>Data HISCL 3 - Tab 2</h3> -->
         <div class="header-bar">
                    <div>
                    <h4>Nama Menu: Sysmex</h4>
                    </div>
                    <div>
                    <input type="text" class="form-control" placeholder="Plain Number">
                    </div>
                </div>
        <table>
           <thead>
                    <tr>
                        <th>NO</th>
                        <th>SID</th>
                        <th>OD</th>
                        <th>COV</th>
                        <th>Result</th>
                        <th>Idx : Carrier Machine SN</th>
                        <th>Assay</th>
                        <th>CompltTime</th>
                        <th>Reagen</th>
                        <th>Expire</th>
                        <th>File Name</th>
                        <th>Petugas</th>

                    </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                    </tbody>
        </table>
         <div class="summary">
                    Jumlah: 0 Sampel Darah
                </div>
      </div>
    </div>
  </div>

  </div>

  <script>
   // Tab switching
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active'));
        tabContents.forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById(btn.dataset.tab).classList.add('active');

        // Reset sub-tabs on tab change
        document.querySelectorAll('.tab-content').forEach(tab => {
          const firstSub = tab.querySelector('.sub-btn');
          if (firstSub) firstSub.click();
        });
      });
    });

    // Sub-tab switching
    const allSubButtons = document.querySelectorAll('.sub-btn');

    allSubButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const parentTab = btn.closest('.tab-content');
        const subButtons = parentTab.querySelectorAll('.sub-btn');
        const subContents = parentTab.querySelectorAll('.sub-content');

        subButtons.forEach(b => b.classList.remove('active'));
        subContents.forEach(c => c.classList.remove('active'));

        btn.classList.add('active');
        parentTab.querySelector('#' + btn.dataset.sub).classList.add('active');
      });
    });
  </script>

 






@endsection