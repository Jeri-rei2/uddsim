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
    }

    .container {
      display: flex;
    }

    .sidebar {
      /* width: 200px; */
      padding: 10px;
      background-color: #eaeaea;
      border-right: 1px solid #ccc;
    }

    .sidebar {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    .sidebar , .sidebar {
      /* width: 50%; */
      padding: 5px;
      margin-top: 5px;
    }

    .plate {
      margin-left: 20px;
      overflow-x: auto;
    }

    table {
      border-collapse: collapse;
      text-align: center;
    }

    th, td {
      border: 1px solid #aaa;
      width: 50px;
      height: 35px;
    }

    th {
      background-color: #f0f0f0;
      font-weight: bold;
    }

    td input {
      width: 90%;
      height: 90%;
      text-align: center;
      border: none;
      background-color: #e6f1ff;
    }

    .row-label {
      background-color: #ffffff;
      font-weight: bold;
    }

    .highlight {
      background-color: #ffffcc !important;
    }

    .header-highlight {
      background-color: #d9f9e2 !important;
    }
  </style>
@endpush

@section('content')
<div class="container" id="alldata">
   <div class="row">

      <div class="col-xl-6">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-top-home"
                          aria-controls="navs-top-home"
                          aria-selected="true"
                        >
                          WorkSheet Umum
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-top-profile"
                          aria-controls="navs-top-profile"
                          aria-selected="false"
                        >
                          Data Pemeriksaan
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-nat"
                          aria-controls="navs-top-messages"
                          aria-selected="false"
                        >
                          Batal Sample NAT
                        </button>
                      </li>
                    <div class="tab-content" style="width: 1200px;">
                      <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel" >
                    <div class="container">
                    <!-- Sidebar -->
                    <div class="sidebar" style="width: 200px;">
                        <label><input type="checkbox" checked> POSTING</label>
                        <label>No. PLATE</label><input type="text" style="width: 130px; hight: 50px;">
                        <button style="width: 50px; hight: 9px;">
                         <i class='bx  bx-search'></i></button>
                        <label>No. WS</label><input type="text" style="width: 180px; hight: 50px;">
                        <label>Tanggal</label><input type="date" style="width: 180px; hight: 50px;">
                        <label>Metode Periksa</label>
                        <select style="width: 180px; hight: 50px;">
                        <option>CMIA</option>
                        </select>
                        <label>Reagen</label>
                        <select style="width: 180px; hight: 50px;">
                        <option>ALINITY</option>
                        </select>
                        <label>Jenis Periksa</label>
                        <select style="width: 180px; hight: 50px;">
                        <option>HBsAg</option>
                        </select>
                        <label>Tahapan Periksa</label>
                        <select style="width: 180px; hight: 50px;">
                        <option>TEST</option>
                        </select>
                    </div>

                    <!-- Plate Layout -->
                    <div class="plate" >
                        <table style="width: 850px;">
                        <tr>
                            <th class="header-highlight">LIS</th>
                            <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th>
                            <th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th>
                                </tr>

                                <!-- Repeat for Rows A to H -->
                                <!-- Row A -->
                                <tr>
                                    <td class="row-label">A</td>
                                    <td class="highlight"><input value="C"></td>
                                    <td><input value="A2"></td>
                                    <td><input value="A3"></td>
                                    <td><input value="A4"></td>
                                    <td><input value="A5"></td>
                                    <td><input value="A6"></td>
                                    <td><input value="A7"></td>
                                    <td><input value="A8"></td>
                                    <td><input value="A9"></td>
                                    <td><input value="A10"></td>
                                    <td><input value="A11"></td>
                                    <td><input value="A12"></td>
                                </tr>

                                <!-- Row B to H -->
                                <!-- Copy and adjust each row accordingly -->
                                <!-- Here's an example for Row B -->
                                <tr>
                                    <td class="row-label">B</td>
                                    <td class="highlight"></td>
                                    <td><input value="B2"></td>
                                    <td><input value="B3"></td>
                                    <td><input value="B4"></td>
                                    <td><input value="B5"></td>
                                    <td><input value="B6"></td>
                                    <td><input value="B7"></td>
                                    <td><input value="B8"></td>
                                    <td><input value="B9"></td>
                                    <td><input value="B10"></td>
                                    <td><input value="B11"></td>
                                    <td><input value="B12"></td>
                                </tr>
                                  <tr>
                                    <td class="row-label">C</td>
                                    <td class="highlight"></td>
                                    <td><input value="C2"></td>
                                    <td><input value="C3"></td>
                                    <td><input value="C4"></td>
                                    <td><input value="C5"></td>
                                    <td><input value="C6"></td>
                                    <td><input value="C7"></td>
                                    <td><input value="C8"></td>
                                    <td><input value="C9"></td>
                                    <td><input value="C10"></td>
                                    <td><input value="C11"></td>
                                    <td><input value="C12"></td>
                                </tr>
                                  <tr>
                                    <td class="row-label">D</td>
                                    <td class="highlight"></td>
                                    <td><input value="D2"></td>
                                    <td><input value="D3"></td>
                                    <td><input value="D4"></td>
                                    <td><input value="D5"></td>
                                    <td><input value="D6"></td>
                                    <td><input value="D7"></td>
                                    <td><input value="D8"></td>
                                    <td><input value="D9"></td>
                                    <td><input value="D10"></td>
                                    <td><input value="D11"></td>
                                    <td><input value="D12"></td>
                                </tr>
                                  <tr>
                                    <td class="row-label">E</td>
                                    <td class="highlight"></td>
                                    <td><input value="E2"></td>
                                    <td><input value="E3"></td>
                                    <td><input value="E4"></td>
                                    <td><input value="E5"></td>
                                    <td><input value="E6"></td>
                                    <td><input value="E7"></td>
                                    <td><input value="E8"></td>
                                    <td><input value="E9"></td>
                                    <td><input value="E10"></td>
                                    <td><input value="E11"></td>
                                    <td><input value="E12"></td>
                                </tr>
                                  <tr>
                                    <td class="row-label">F</td>
                                    <td class="highlight"></td>
                                    <td><input value="F2"></td>
                                    <td><input value="F3"></td>
                                    <td><input value="F4"></td>
                                    <td><input value="F5"></td>
                                    <td><input value="F6"></td>
                                    <td><input value="F7"></td>
                                    <td><input value="F8"></td>
                                    <td><input value="F9"></td>
                                    <td><input value="F10"></td>
                                    <td><input value="F11"></td>
                                    <td><input value="F12"></td>
                                </tr>
                                  <tr>
                                    <td class="row-label">G</td>
                                    <td class="highlight"></td>
                                    <td><input value="G2"></td>
                                    <td><input value="G3"></td>
                                    <td><input value="G4"></td>
                                    <td><input value="G5"></td>
                                    <td><input value="G6"></td>
                                    <td><input value="G7"></td>
                                    <td><input value="G8"></td>
                                    <td><input value="G9"></td>
                                    <td><input value="G10"></td>
                                    <td><input value="G11"></td>
                                    <td><input value="G12"></td>
                                </tr>
                                <tr>
                                    <td class="row-label">H</td>
                                    <td class="highlight"></td>
                                    <td><input value="H2"></td>
                                    <td><input value="H3"></td>
                                    <td><input value="H4"></td>
                                    <td><input value="H5"></td>
                                    <td><input value="H6"></td>
                                    <td><input value="H7"></td>
                                    <td><input value="H8"></td>
                                    <td><input value="H9"></td>
                                    <td><input value="H10"></td>
                                    <td><input value="H11"></td>
                                    <td><input value="H12"></td>
                                </tr>
                                <!-- Lanjutkan sampai baris H -->
                                </table>
                            </div>
                        </div>
                      </div>
                       <div class="tab-pane" id="navs-top-profile" role="tabpanel" >
                    wkwkwkwkwkw
                      </div>
                       <div class="tab-pane" id="navs-nat" role="tabpanel" >
                    eeee
                      </div>
                    </div>
                   

                    </ul>
                  </div>
      </div>








    </div>
</div>














@endsection