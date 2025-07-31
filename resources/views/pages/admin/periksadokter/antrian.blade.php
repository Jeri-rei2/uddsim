@extends('layouts.main')
@section('title', 'Periksa Dokter')

@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Antrian Dokter</h4>
</div>


<div class="container">
    <div class="row">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">Pemanggilan Antrian Dokter</h5>

                <div class="row">
                    <div class="col-lg-35 grid-margin stretch-card">
                        <div class="card">      
                        <div class="card-body">

                                <div class="col-lg-12 mb-7">
                                    <form action="{{route('dashboard.antrian')}}" class="input-group">
                                        <div class="col-md-6">
                                            <select class="form-select loket mb-3" name="id_loket">
                                                <option selected disabled>Pilih Loket</option>
                                                @foreach ($loket as $l)
                                                @if ($l->id == request('id_loket'))    
                                                <option value="{{ $l->id }}" selected>{{ $l->nama_loket }}</option>
                                                @else
                                                <option value="{{ $l->id }}">{{ $l->nama_loket }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-sm btn-info mx-1"><i class='bx bx-check' ></i>  Pilih</button>
                                            <a href="{{route('loket.antrian')}}" class="btn btn-sm btn-danger" target="_blank" rel="noopener noreferrer"><i class='bx bxs-printer'></i> Cetak Antrian HB</a>
                                            <a href="{{route('list.antrian')}}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer"> <i class='bx bx-book' ></i>  Lihat Daftar antrian</a>
                                        </div>
                                    </form>
                                </div>
                                
                                @if ($antrian)
                                        <table class="table table-responsive table-bordered" id="antri">
                                            <thead class="table-info">
                                                <tr class="text-center">
                                                    <th class="col-md-2">No</th>
                                                    <th class="col-md-5">No Antrian</th>
                                                    <th class="col-md-10">Nama Pedonor</th>
                                                    <th class="col-md-6">Ruang</th>
                                                    <th class="col-md-6">Status</th>
                                                    <th class="col-md-6">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            @foreach ($antrian as $index => $a)
                                                <tr class="{{ $a->loket_id == 1 || $a->loket_id == 0 ? 'table-danger' : '' }}" id="rowId{{ $a->id }}">
                                                    <td width="50">{{ $loop->iteration }}</td>
                                                    <td>{{ $a->nomor }}</td>
                                                    <td>{{ $a->namadonor }}</td>
                                                    <td>{{ $a->ruang }}</td>
                                                    <td>
                                                        @if ($a->status == 'menunggu')
                                                           <p> Menunggu </p> 
                                                        @elseif($a->status == 'dipanggil')
                                                            <p> Dipanggil </p>
                                                        @else
                                                            <p> Selesai </p>
                                                        @endif
                                                    </td>
                                                    <td width="550" class="tombolAksi">

                                                    <form method="POST" action="{{ route('antrian.next') }}">
                                                        @csrf
                                                       
                                                        <a type="button" class="btn btn-sm btn-success tombolPanggil" id="panggilBtn" ><i class='bx bxs-bell-ring' ></i> Panggil</a>
                                                         <br/>
                                                         <br/>
                                                        <button type="submit" class="btn btn-danger"><i class='bx bx-skip-next' ></i> Lanjut</button>
                                                       
                                                        <input type="text" hidden name="id_donor" value="{{ $a->id_donor }}">
                                                        <input type="text" hidden name="namadonor" value="{{ $a->namadonor }}">
                                                    
                                                        <input type="text" hidden name="antrian" value="{{ $a->id }}">
                                                        <input type="text" hidden name="kode" value="{{ $a->nomor }}">
                                                   
                                                   
                                                    </form>

                                                 
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                        @endif
                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
 
                            </div>
                        </div>
                    </div>
              <!--/ Accordion -->
    </div>


    <script>
       // Fungsi untuk memainkan suara
        function playSuara(nomor, tujuan,ruang) {
            const kalimat = "Nomor antrian " + nomor + ", Periksa," + tujuan + ", Ruang ," + ruang + "";
            const utterance = new SpeechSynthesisUtterance(kalimat);
            utterance.lang = 'id-ID';

            // Atur kecepatan (semakin kecil, semakin lambat)
            utterance.rate = 0.8; // 0.1 - 1.0 (normal = 1.0)
            // Cari suara laki-laki bahasa Indonesia
            const voices = window.speechSynthesis.getVoices();
            const voiceLaki = voices.find(v =>
                v.lang === 'id-ID' && v.name.toLowerCase().includes('male')
            );

            if (voiceLaki) {
                utterance.voice = voiceLaki;
            }

            speechSynthesis.speak(utterance);
        }

        // Pastikan suara dimuat dulu
        window.speechSynthesis.onvoiceschanged = function() {
            window.speechSynthesis.getVoices();
        };
        // Klik tombol
        $('#panggilBtn').on('click', function() {
            $.ajax({
                url: '{{ route("antri.panggil") }}',
                method: 'GET',
                success: function(res) {
                    if (res.status === 'sukses') {
                        const nomor = res.data.nomor;
                        const tujuan = res.data.tujuan;
                        const ruang = res.data.ruang;
                        $('#nomor').text(nomor);
                        playSuara(nomor,tujuan,ruang);
                        // setTimeout(function() {
        location.reload();  // Reload halaman setelah beberapa detik
    // }, 1000); 
                    } else {
                        alert(res.message);
                    }
                },
                error: function(err) {
                    alert('Terjadi kesalahan');
                    console.error(err);
                }
            });
        });

    </script>
 


@endsection