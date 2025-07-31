<?php

namespace App\Http\Controllers;


use App\Models\Ukurancc;
use App\Models\JnsKtng;
use App\Models\JnsKtngmerk;
use App\Models\Donor;
use App\Models\Cabang;
use App\Models\Setnodonor;
use App\Models\Kelompok;
use App\Models\Pekerjaan;
use App\Models\Periksadonor;
use App\Models\Kewarganegaraan;
use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Msldrh;
use App\Models\User;
use App\Models\Mobileunit;
use App\Models\AftpDrhH;
use App\Models\AftpDrhD;
use App\Models\TempOrd;
use App\Models\TerimaKtg;
use App\Models\KtgOrd;
use App\Models\KtgRusak;
use App\Models\PengeluaraanKtgMu;
use App\Models\PengembalianKtgMu;
use App\Models\DetailPengeluaraanKtgMu;
use Illuminate\Support\Facades\DB;
use App\Models\Quesioner;
use App\Models\AftpTrnsDnr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PemeriksaanRequest;
  use Illuminate\Support\Facades\Validator;
  use App\Notifications\NewRequestNotification;

class TransaksiDonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function saveheader(Request $request)
    {
        // $items = $request->input('items');
        $header = $request->input('item');
    
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitungall = is_array($header) ? count($header) : 0;
        $urutkan = 1;
        

      
        // dd($header);
    //   for ($i = 1; $i <= $ids['jml']; $i++) {
        foreach ($header as $item) {
            AftpDrhD::create([
                'nofpd' => $item['nofpd'],
                'tglfpd' => $tanggal,
                'urut' => $urutkan,
                'nokntng' => $item['nokntng'],
                'jnskntng' => $item['jnskntng'],
                'noaftap' => $item['noaftap'],
                'tglaftap' => $item['tglaftap'],
                'nodonor' => $item['nodonor'],
                'namadonor' => $item['namadonor'],
                'asldrh' => $item['asldrh'],
                'goldar' => $item['goldar'],
                'rhesus' => $item['rhesus'],
                'tolak' => $item['tolak'],
                'ket' => $item['ket'],
                'status' => 'Waiting',
                'tglsimpan' => $tanggal,
                'suhu' => $item['suhu'],
                'jnsdonor' => $item['jnsdnr'],
                'xx' => $item['typektg'],

                'id_logger' => $item['longger'],
                'kdcab' => $item['kdcab'],

                // 'id_coolbox' => $item['tgldonor'],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);    

           
           $urutkan++;
        }
     $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

     
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }



      public function cariktgffp(Request $request)
    {
        $barang = AftpTrnsDnr::where('nokntng', $request->barcode)->first();

        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Kantong tidak ditemukan'
            ]);
        }
    }
    public function cetakFpd($id)
    {
        // Ambil data dengan ID terakhir (terbesar)
        // $postTerakhir = AftpDrhD::findOrFail($id);
          $data2 = DB::table('aftpFpdrhd')
            ->join('kantong', 'kantong.nokntng', '=', 'aftpFpdrhd.nokntng')
             ->join('aftpTrnsDnr', 'aftpTrnsDnr.noaftap', '=', 'aftpFpdrhd.noaftap')
            ->select('kantong.*','aftpFpdrhd.*', 'aftpTrnsDnr.durasi')
            ->get();
    
          $data =  DB::table('aftpFpdrhd')
             ->join('aftpFpdrhH', 'aftpFpdrhd.nofpd', '=', 'aftpFpdrhH.nofpd')
            ->where('aftpFpdrhd.id', $id)
            ->select('aftpFpdrhd.*','aftpFpdrhH.*')
            ->get();

             $get = AftpDrhD::findOrFail($id);

        return view('pages.admin.transaksidonor.cetakkirimfpd',compact('data','get','data2') );
    }

     public function savefpd(Request $request)
    {
        $tanggal = Carbon::now('Asia/Jakarta');
       

        // contoh menyimpan data user yang dipilih
        $userIds = $request->input('kirim'); // array of user IDs
        $user = Auth::user()->name; 
        $kdptgs = Auth::user()->bagian; 


        // dd($userIds);
        $hitungall = is_array($userIds) ? count($userIds) : 0;
        foreach ($userIds as $item) {
            // contoh logika, bisa disesuaikan
            AftpDrhH::create([
                // 'CKDCAB' => $item['kdcab'],
                'nofpd' => $item['nofpd'],
                'tglfpd' => $item['tglaftap'],
                'total' => $hitungall,
                'ket' => $item['jnsdonor'],
                'suhu' => $item['suhu'],
                'nat' => $item['nat'],
                'proseskirim' => 'Dikirim ke Komponen',
                'ckdptgs' => $kdptgs,
                'ckdptgsperiksa' => $user,
                'type' => $item['jnskntng'],

                'id_logger' => $item['id_logger'],

                // 'id_coolbox' => $item['tgldonor'],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        }

        // return redirect()->back()->with(['success' => true, 'message' => 'Data berhasil disimpan']);
         return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
    }
      public function viewdata(Request $request)
    {
        $data = AftpDrhD::all();
        // // Ambil 1 produk per kategori (ID terkecil)
        // $products = DB::table('aftpfpdrhd')
        //     ->select('NOFPD',DB::raw('COUNT(NOFPD) as totals'),)
        //     ->where('NOFPD', 'like', "%{$request->keyword}%")
        //     ->groupBy('NOFPD')
        //     ->get();
        $products = AftpDrhD::where('nofpd', $request->keyword)
        ->orderBy('created_at', 'desc') // Or any other column
        ->first();

        $filtered = AftpDrhD::whereIn('nofpd', $products->pluck('nofpd'))->get();
    


        return response()->json($filtered);


        return response()->json($filtered, true);

    }

     public function indexffp(Request $request)
    {
        $random = mt_rand(1000, 9999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'PD' . date('y') . date('m') . strtoupper(Str::random(4));
        $lastaftp= AftpDrhD::latest('id')->first();// Get the latest order
        $random = 'PD' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 4, '0', STR_PAD_LEFT);
        $nofpd = new AftpDrhD();
        $nofpd = $random;
        
        //    $gt = DB::table('aftpFpdrhd')
        //       ->whereRaw('EXTRACT(DAY FROM created_at) = ?',  date('d') )
        //             ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m') )
        //     ->select('NOFPD','id',DB::raw('COUNT(NOFPD) as totals'))
        //     ->where('NOFPD', 'like', "%{$request->keyword}%")
        //     ->groupBy('NOFPD')
        //     ->get();
            // dd($gt);
        // $dtcetak = AftpDrhD::whereIn('NOFPD', $gt->pluck('id'))->get();
        // $lastid= AftpDrhD::max('id');

        return view('pages.admin.transaksidonor.pengirimanffp',compact('nofpd',));
    }


      public function cetaklaporan(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $data = TerimaKtg::whereBetween('tglterima', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        return view('pages.admin.transaksidonor.cetaklaporan', compact('data', 'request'));
    }
 public function saveterima(Request $request)
    {
        // $items = $request->input('items');
        $tanggal = Carbon::now('Asia/Jakarta');
            // dd($items);
           // Validasi bahwa item adalah array
        $request->validate([
            'items' => 'required|array',
            'items.*.minta' => 'required|string',
        ]);

        // dd($request);
        // Hitung jumlah data dalam array item
        $jumlahData = count($request->items);

        foreach ($request->items as $item) {
           $data =  TerimaKtg::create([
                'nominta' => $item['nominta'],
                'notrans' => $item['notrans'],
                'nokntng' => $item['nokntng'],
                'jnskntng'=> $item['jnskntng'],
                'ukuran'=> $item['ukuran'],
                'merkktg'=> $item['merkktg'],
                'jmlkirimgd'=> $item['jml'],
                'jmlterima'=> $jumlahData,
                'tglterima' => $tanggal,
                'status'=> 'Sudah Diterima',
                'type_stok'=> 'Masuk',
                'realpermintaan'=> $item['jumlah'],
                'create_at' => $tanggal,
                'updated_at' => $tanggal,

            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }







    // Menangani pencarian data secara AJAX
    public function searchpenerimaan(Request $request)
    {
           $barang = DB::table('ktgkirim')
            ->join('kantong', 'ktgkirim.nokntng', '=', 'kantong.nokntng')
            ->join('tempord', 'tempord.nogd', '=', 'ktgkirim.notrans')
            ->where('kantong.nokntng', $request->barcode)
            ->select('kantong.*', 'ktgkirim.nokntng as nokntng', 'ktgkirim.ket as ket','ktgkirim.notrans as nokirim', 
                     'ktgkirim.perk as jml', 'ktgkirim.nopermintaan as nominta','tempord.*')
            ->first();

        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Kantong tidak ditemukan'
            ]);
        }
    }
     public function scanknodaftar(Request $request)
    {
    
       $noaftp1 = $request->get('noaftp');
         $noaftp =  DB::table('donor')
        ->join('priksadonor','donor.noaftp', '=', 'priksadonor.noaftap')
        ->join('priksadokter', 'priksadokter.noaftap', '=', 'priksadonor.noaftap')
        ->join('aturansatelit', 'aturansatelit.typektg', '=', 'priksadokter.typektg')
        // ->join('ktgkirim', 'ktgkirim.jnsktg', '=', 'priksadonor.jnsktg')
            ->join('kantong', 'kantong.typekntng', '=', 'priksadokter.typektg')
            // ->leftjoin('kantong', 'kantong.jnskntng', '=', 'priksadonor.jnsktg')
        ->leftjoin('aturanklmpkumur','aturanklmpkumur.batasbawah', '=', 'priksadokter.umur')
        ->leftjoin('aturanklmpkberat','aturanklmpkberat.batasbawah', '=', 'priksadokter.brtbdn')
         ->select('donor.*', 'priksadonor.*','priksadokter.*','priksadonor.tglhema as tglhma','priksadonor.asaldrh as asldrh', 'aturansatelit.*',
                    'aturanklmpkumur.*','aturanklmpkberat.*','kantong.*','kantong.nokntng as nokntng')
            ->where('priksadonor.noaftap', 'like', "%$noaftp1%")
            ->first();

        // dd($noaftp);
    //    $noaftp =  DB::table('donor')
    //     ->join('priksadonor', DB::raw('CONVERT(donor.noaftp USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'priksadonor.noaftap')
    //     ->join('priksadokter', DB::raw('CONVERT(priksadokter.noaftap USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'donor.noaftp')
    //     ->join('aturansatelit', DB::raw('CONVERT(aturansatelit.typektg USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'priksadokter.typektg')
    //     ->leftjoin('aturanklmpkumur', DB::raw('CONVERT(aturanklmpkumur.batasbawah USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'priksadokter.umur')
    //     ->leftjoin('aturanklmpkberat', DB::raw('CONVERT(aturanklmpkberat.batasbawah USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'priksadokter.brtbdn')
    //         ->join('kantong',  DB::raw('CONVERT(kantong.jnskntng USING utf8mb4) COLLATE utf8mb4_general_ci'), '=', 'priksadonor.jnsktg')
    //      ->select('donor.*', 'priksadonor.*','priksadokter.*','priksadonor.tglhema as tglhma','priksadonor.asaldrh as asldrh', 'aturansatelit.*',
    //                 'aturanklmpkumur.*','aturanklmpkberat.*','kantong.*')
    //         ->where('priksadonor.noaftp', 'like', "%$noaftp1%")
    //         ->first();

        if ($noaftp) {
            return response()->json([
                'success' => true,
                'data' => $noaftp,

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }
    public function reload(Request $request)
    {
        //   $data = AftpTrnsDnr::select('id', 'nodonor', 
        //         'namadonor','noaftap','tglaftap','nokantong','goldar','rhesus',
        //         'nokantong','jnskantong','asaldrh','CCAMB')->get(); // atau paginate()
        //   return response()->json($data);

             $query = AftpTrnsDnr::query();

            if ($request->filled('nokntng')) {
                $query->where('nokntng', 'like', '%' . $request->nokntng . '%');
            }

            if ($request->filled('noaftap')) {
                $query->where('noaftap', 'like', '%' . $request->noaftap . '%');
            }
            if ($request->filled('goldar')) {
                $query->where('goldar', 'like', '%' . $request->goldar . '%');
            }
            // if ($request->filled('role')) {
            //     $query->where('role', $request->role);
            // }

            $users = $query->get();

            return response()->json($users);

    }
 
      public function savetransdnr(Request $request)
    {
        $aftp = $request->input('aftp');
        $durasi = $request->input('durasi');
        $catatan = $request->input('catatan');

        // dd($dtall);
        // $aftp = $request->all();
    
        $tanggal = Carbon::now('Asia/Jakarta');
     

        // dd($aftp);
        foreach ($aftp as $item) {
            AftpTrnsDnr::create([
                'kdcab' => $item['kdcab'],
                'nodonor' => $item['nodonor'],
                'noaftap' => $item['noaftap'],
                'tgldaftar' => $item['tgldonor'],
                'tglperiksa' => $item['tglperiksa'],
                'tglhema' => $item['tglhema'],
                'tglaftap' => $item['tglaftap'],
                'namadonor' => $item['namadonor'],
                'goldar' => $item['goldar'],
                'rhesus' => $item['rhesus'],
                'tgllahir' => $item['tgllahir'],
                'umur' => $item['umur'],
                'nokntng' => $item['nokntng'],
                'kelompokumur' => $item['kelompokumur'],
                'almsrt' => $item['alamat'],
                'wil' => $item['wil'],
                'jnsdnr' => $item['jnsdnr'],
                'nofpup' => $item['nofpup'],
                'namaos' => $item['namaos'],
                // 'CKDASLDRH' => $item['kdcab'],
                'nmcab' => $item['nmcab'],
                // 'KDPTGHB' => $item[''],
                // 'NMPTGHB' => $item[''],
                // 'KDPTGLAB' => $item[''],
                // 'NMPTGLAB' => $item[''],
                // 'KDPTGDR' => $item[''],
                // 'NMPTGDR' => $item[''],
                'kdptgsaftp' => $item['kdptgsaftp'],
                'ptgsaftp' => $item['ptgsaftp'],
                'tensi' => $item['tensi'],
                'nadi' => $item['nadi'],
                'brtbdn' => $item['brtbdn'],
                'kelompokbrat' => $item['kelompokbrat'],
                'suhu' => $item['suhu'],
                'ecg' => $item['ecg'],
                'tolak' => $item['tolak'],
                'alsntlk' => $item['alsntlk'],
                'ccamb' => $item['stoppd'],
                'jnsktg' => $item['jnsktg'],
                'ketperiksa' => $item['priksahb'],
                'metodehb' => $item['metodehb'],
                'hasilhb' => $item['hasilhb'],
                'trombosit' => $item['trombosit'],
                'ht' => $item['ht'],
                'leokosit' => $item['leokosit'],
                'eritrosit' => $item['eritrosit'],
                'ccstop' => $item['stoppd'],
                'reaksiambil' => $item['reaksiambil'],
                'reaksidnr' => $item['reaksidnr'],
                // 'ReakLAIN' => $item[''],
                'surat' => $item['surat'],
                'puasa' => $item['puasa'],
                'waktu' => $item['waktu'],
                'ktgpenuh' => $item['ktgpenuh'],
                'disinfeksi' => $item['lancar'],
                'penggoyangan' => $item['lancar'],
                'sampledrh' => $item['sampledrh'],
                'penyerutan' => $item['surat'],
                'sealer' => $item['waktu'],
                'catatan' => $catatan,
                'ktgdarah' => $item['ktgpenuh'],
                'donorke' => $item['donorke'],
                'status' => 'Selesai',
                'durasi' => $durasi,

                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
              
             //hitung stok 
                    $users = DB::table('terimaktg')
                           ->select(DB::raw('min(jmlterima) - min(realpermintaan) as total'))
                            ->value('total');

                    $id =  TerimaKtg::where('nokntng', $item['nokntng'])->update([
                        'status' => 'Sudah Diterima Aftap',
                        'stok' => $users,
                        'type_stok' => 'Keluar',
                        ] // Data yang akan diupdate/insert
                    );
            
           
        }
        return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);

    }



    public function cetakprmintaan ($id)
    {
        $data = TempOrd::whereRaw('EXTRACT(DAY FROM priksadokter.created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM priksadokter.created_at) = ?', date('m'))
        // whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
           ->orderBy('created_at', 'asc')
           ->get();
        $get = TempOrd::findOrFail($id);
        return view('pages.admin.transaksidonor.cetak',compact('data','get') );
    }

    public function pushtemporary(Request $request)
    {
         //    $kirim = $request->kirim;
       

       $order = [];
       $tanggal = Carbon::now('Asia/Jakarta');
       foreach ($request->dataktg as $data) {
        // for ($i = 0; $i < $data['jmlcetak']; $i++) {
          $push = TempOrd::create([
            'notrans' => $data['nominta'],
            'merk' => $data['merk'],
            'ukktg' => $data['ukktg'],
            'jnsktg' => $data['jnsktg'],
            'jumlah' => $data['jumlah'],
            'stok' => $data['jumlah'],
            'type_stok' => 'Masuk',
            'ket' => $data['ket'],
            'tglminta' => $data['tglminta'],
            'created_at' => $tanggal,
            'updated_at' => $tanggal,

          ]);
            // $admin = User::find(1);
            // $admin->notify(new NewRequestNotification($push));
            
            // $order[] = $push;
           // Kirim notifikasi ke admin (contoh user id = 1)
        
            // }
             
        }
      
        // return response()->json( $order);

        // return response()->json(['message' => 'Data berhasil disimpan']);
        return response()->json([
                'message' => 'Data berhasil disimpan!'
            ]);
            return response()->json([
                'message' => 'Data gagal disimpan!'
            ], 500);

    }


    public function penerimaan(Request $request)
    {
         // nomor PERMINTAAN auto
        $random = mt_rand(1000000, 9999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'D' . date('y') . date('m') . strtoupper(Str::random(7));
        $lastaftp= TempOrd::latest('id')->first();// Get the latest order
        $random = 'D' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 7, '0', STR_PAD_LEFT);
        $notrima = new TempOrd();
        $notrima = $random;

        return view('pages.admin.transaksidonor.penerimaan', compact(
            'notrima'
        ));
    }

    public function permintaan(Request $request)
    {
        // nomor PERMINTAAN auto
        $random = mt_rand(1000000, 9999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'A' . date('y') . date('m') . strtoupper(Str::random(7));
        $lastaftp= TempOrd::latest('id')->first();// Get the latest order
        $random = 'A' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 7, '0', STR_PAD_LEFT);
        $nominta = new TempOrd();
        $nominta = $random;

        $barang = Donor::all();
        $jnskntng = JnsKtngmerk::all();

        $minta = DB::table('tempord')
        ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        // whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
           ->orderBy('created_at', 'asc')
           ->get();

        return view('pages.admin.transaksidonor.permintaan', compact(
            'jnskntng','barang','nominta','minta'
        ));
        
    }




 
    public function index(Request $request)
    {

        $periksa = Periksadonor::all();

        $join = DB::table('priksadokter')
        ->select('priksadokter.*','donor.*', 'cabang.*')
        ->join('donor', 'priksadokter.nodonor', '=', 'donor.nodonor')
        ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
        ->whereRaw('EXTRACT(DAY FROM priksadokter.created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM priksadokter.created_at) = ?', date('m'))

        // ->whereRaw('day(priksadokter.created_at) = ' . date('d') . ' and month(priksadokter.created_at) = ' . date('m') . ' and year(priksadokter.created_at) = ' . date('Y'))
        ->get();
        // dd($join); 
        $datahb = DB::table('priksadonor')->paginate(2);
        $datahb = DB::table('priksadonor')
        ->select('priksadonor.*')
        ->whereRaw('EXTRACT(DAY FROM priksadonor.created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM priksadonor.created_at) = ?', date('m'))
        ->get();

        // ->whereRaw('day(priksadonor.created_at) = ' . date('d') . ' and month(priksadonor.created_at) = ' . date('m') . ' and year(priksadonor.created_at) = ' . date('Y'))
        

        $cab = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
        $donor = Donor::whereDate('created_at', Carbon::today())->get();
        $userId = User::all();    
    
            $ukuran = Ukurancc::all();
            $jnskntng = JnsKtng::all();
            $loket = Loket::all();
      
          $antrian = '';
          
          
          if ($request->id_loket) {
              # code...
              $antrian = Antrian::where('loket_id', $request->id_loket)
                  // ->where('day(created_at)', date('d'))
                     ->whereRaw('EXTRACT(DAY FROM priksadokter.created_at) = ?', date('d') )
                    ->whereRaw('EXTRACT(MONTH FROM priksadokter.created_at) = ?', date('m'))
                //   ->whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
                  ->orderBy('created_at', 'asc')
                  ->get();
          }

       
        return view('pages.admin.transaksidonor.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.periksadokter.create', [
            // 'Kelompok' => Kelompok::all(),
        ]);
    }

   





    public function store(Request $request)
    {
       
          $validasi = Validator::make($request->all(),[
            'kdcab' =>'required',
            'noaftp'=>'required',
            'tgldaftar'=>'required',
            'tglperiksa'=>'required',
            'tglhema'=>'required',
            'tglaftp'=>'required',
            'nodonor'=>'required',
            'namadonor'=>'required',
            'tgllahir'=>'required',
            'umur'=>'required',
            'kelompokumur'=>'required',
            'almsrt1'=>'required',
            'almsrt2'=>'required',
            'jnsdonor'=>'required',
            'nofpup'=>'required',
            'namaos'=>'required',
            'ckdasldrh'=>'required',
            'asaldrh'=>'required',
            'kdptghb'=>'required',
            'nmptghb'=>'required',
            'kdptglab'=>'required',
            'nmptglab'=>'required',
            'kdptgdr'=>'required',
            'nmptgdr'=>'required',
            'kdptgaftp'=>'required',
            'nmptgaftp'=>'required',
            'tensi'=>'required',
            'nadi'=>'required',
            'brtbdn'=>'required',
            'klmpkbrt'=>'required',
            'suhu'=>'required',
            'ecg'=>'required',
            'tolak'=>'required',
            'alsntlk'=>'required',
            'ccambil'=>'required',
            'jnsktg'=>'required',
            'ketpriksa'=>'required',
            'metodehb'=>'required',
            'hasilhb'=>'required',
            'trombosit'=>'required',
            'ht'=>'required',
            'leokosit'=>'required',
            'eritrosit'=>'required',
            'ccstop'=>'required',
            'reakambil'=>'required',
            'reakdonor'=>'required',
            'reaklain'=>'required',
            'surat'=>'required',
            'puasa'=>'required',
            'waktu'=>'required',
            'ktgpenuh'=>'required',
            'disinfeksi'=>'required',
            'penggoyangan'=>'required',
            'sampel'=>'required',
            'penyerut'=>'required',
            'sealer'=>'required',
            'catatan'=>'required',
            'ktgdarah'=>'required',
            'donorke'=>'required',
            'status'=>'required',
            'statusperiksa'=>'required',
            'stathema'=>'required',
            'statkirim'=>'required',
            'ckdptgs'=>'required',
            'kode'=>'required',
            'cekblntglthn'=>'required',
            'bulan'=>'required',
            'thn'=>'required',
            'uploadstamp'=>'required',
            
          ],[
          
            'kdcab' =>'kosong',
            'noaftp'=>'kosong',
            'tgldaftar'=>'kosong',
            'tglperiksa'=>'kosong',
            'tglhema'=>'kosong',
            'tglaftp'=>'kosong',
            'nodonor'=>'kosong',
            'namadonor'=>'kosong',
            'tgllahir'=>'kosong',
            'umur'=>'kosong',
            'kelompokumur'=>'kosong',
            'almsrt1'=>'kosong',
            'almsrt2'=>'kosong',
            'jnsdonor'=>'kosong',
            'nofpup'=>'kosong',
            'namaos'=>'kosong',
            'ckdasldrh'=>'kosong',
            'asaldrh'=>'kosong',
            'kdptghb'=>'kosong',
            'nmptghb'=>'kosong',
            'kdptglab'=>'kosong',
            'nmptglab'=>'kosong',
            'kdptgdr'=>'kosong',
            'nmptgdr'=>'kosong',
            'kdptgaftp'=>'kosong',
            'nmptgaftp'=>'kosong',
            'tensi'=>'kosong',
            'nadi'=>'kosong',
            'brtbdn'=>'kosong',
            'klmpkbrt'=>'kosong',
            'suhu'=>'kosong',
            'ecg'=>'kosong',
            'tolak'=>'kosong',
            'alsntlk'=>'kosong',
            'ccambil'=>'kosong',
            'jnsktg'=>'kosong',
            'ketpriksa'=>'kosong',
            'metodehb'=>'kosong',
            'hasilhb'=>'kosong',
            'trombosit'=>'kosong',
            'ht'=>'kosong',
            'leokosit'=>'kosong',
            'eritrosit'=>'kosong',
            'ccstop'=>'kosong',
            'reakambil'=>'kosong',
            'reakdonor'=>'kosong',
            'reaklain'=>'kosong',
            'surat'=>'kosong',
            'puasa'=>'kosong',
            'waktu'=>'kosong',
            'ktgpenuh'=>'kosong',
            'disinfeksi'=>'kosong',
            'penggoyangan'=>'kosong',
            'sampel'=>'kosong',
            'penyerut'=>'kosong',
            'sealer'=>'kosong',
            'catatan'=>'kosong',
            'ktgdarah'=>'kosong',
            'donorke'=>'kosong',
            'status'=>'kosong',
            'statusperiksa'=>'kosong',
            'stathema'=>'kosong',
            'statkirim'=>'kosong',
            'ckdptgs'=>'kosong',
            'kode'=>'kosong',
            'cekblntglthn'=>'kosong',
            'bulan'=>'kosong',
            'thn'=>'kosong',
            'uploadstamp'=>'kosong',
          ]);
    
       
           
            $data = [
            'kdcab'=> $request->kdcab, 
            'noaftp'=> $request->noaftp, 
            'tgldaftar'=>$request->tgldaftar, 
            'tglperiksa'=>$request->tglperiksa, 
            'tglhema'=>$request->tglhema, 
            'tglaftp'=>$request->tglaftp, 
            'nodonor'=>$request->nodonor, 
            'namadonor'=>$request->namadonor, 
            'tgllahir'=>$request->tgllahir, 
            'umur'=>$request->umur, 
            'kelompokumur'=>$request->kelompokumur, 
            'almsrt1'=>$request->almsrt1, 
            'almsrt2'=>$request->almsrt2, 
            'jnsdonor'=>$request->jnsdonor, 
            'nofpup'=>$request->nofpup, 
            'namaos'=>$request->namaos, 
            'ckdasldrh'=>$request->ckdasldrh, 
            'asaldrh'=>$request->asaldrh, 
            'kdptghb'=>$request->kdptghb, 
            'nmptghb'=>$request->nmptghb, 
            'kdptglab'=>$request->kdptglab, 
            'nmptglab'=>$request->nmptglab, 
            'kdptgdr'=>$request->kdptgdr, 
            'nmptgdr'=>$request->nmptgdr, 
            'kdptgaftp'=>$request->kdptgaftp, 
            'nmptgaftp'=>$request->nmptgaftp, 
            'tensi'=>$request->tensi, 
            'nadi'=>$request->nadi, 
            'brtbdn'=>$request->brtbdn, 
            'klmpkbrt'=>$request->klmpkbrt, 
            'suhu'=>$request->suhu, 
            'ecg'=>$request->ecg, 
            'tolak'=>$request->tolak, 
            'alsntlk'=>$request->alsntlk, 
            'ccambil'=>$request->ccambil, 
            'jnsktg'=>$request->jnsktg, 
            'ketpriksa'=>$request->ketpriksa, 
            'metodehb'=>$request->metodehb, 
            'hasilhb'=>$request->hasilhb, 
            'trombosit'=>$request->trombosit, 
            'ht'=>$request->ht, 
            'leokosit'=>$request->leokosit, 
            'eritrosit'=>$request->eritrosit, 
            'ccstop'=>$request->ccstop, 
            'reakambil'=>$request->reakambil, 
            'reakdonor'=>$request->reakdonor, 
            'reaklain'=>$request->reaklain, 
            'surat'=>$request->surat, 
            'puasa'=>$request->puasa, 
            'waktu'=>$request->waktu, 
            'ktgpenuh'=>$request->ktgpenuh, 
            'disinfeksi'=>$request->disinfeksi, 
            'penggoyangan'=>$request->penggoyangan, 
            'sampel'=>$request->sampel, 
            'penyerut'=>$request->penyerut, 
            'sealer'=>$request->sealer, 
            'catatan'=>$request->catatan, 
            'ktgdarah'=>$request->ktgdarah, 
            'donorke'=>$request->donorke, 
            'status'=>$request->status, 
            'statusperiksa'=>$request->statusperiksa, 
            'stathema'=>$request->stathema, 
            'statkirim'=>$request->statkirim, 
            'ckdptgs'=>$request->ckdptgs, 
            'kode'=>$request->kode, 
            'cekblntglthn'=>$request->cekblntglthn, 
            'bulan'=>$request->bulan, 
            'thn'=>$request->thn, 
            'uploadstamp'=>$request->uploadstamp, 
            ];

            PeriksaHb::create($data);
           
            // dd($data);
            $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

        return redirect()->back()->with('message', 'Berhasil Simpan Data');
    }

    public function next(Request $request)
    {
        $last = Donor::whereId($request->stperiksa)->first();
        // dd($last);

        $last->update([
            'stperiksa' => '1' 
        ]);


    
        return redirect()->back();

        // dd($str);
    }


    /**
     * Display the specified resource.
     */
    public function show(Donor $donor,$id)
    {
        //return response

        $getdata = Donor::find($id);

        return response()->json($getdata);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {    
       
        // dd($id);
        // $items = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
       
        return view('pages.admin.mdonor.edit',[
    
        'donor' => Donor::find($id),

        'kenegaraan' => Kewarganegaraan::with('cabang')->orderBy('id', 'DESC')->get(),
        'pekerjaan' => Pekerjaan::with('cabang')->orderBy('id', 'DESC')->get(),
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $post = Donor::find($id);
        
        $this->validate($request, array(
            'kdcab' => 'required',
            'nodonor' => 'required',
            'namadonor' => 'required',
            'alamat' => 'required',
            'kodepos' => 'required',
            'jk' => 'required',
            'kdneg' => 'required',
            'tgllahir' => 'required',
            'usia' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'nmwil' => 'required',
            'nmpkrj' => 'required',
            'agama' =>'required',
            'tlp' => 'required',
            'noktp' =>'required',
            'nosim' => 'required',
            'tgldaftar' =>'required',
            'donorke' =>'required',
            'mtdpeng' => 'required', 
        ));

        // $post->user_id = Auth::user()->id;
        $post->kdcab = $request['kdcab'];
        $post->nodonor = $request['nodonor'];
        $post->namadonor = $request['namadonor'];
        $post->alamat = $request['alamat'];
        $post->kodepos = $request['kodepos'];
        $post->jk = $request['jk'];
        $post->kdneg = $request['kdneg'];
        $post->tgllahir = $request['tgllahir'];
        $post->usia = $request['usia'];
        $post->kelurahan = $request['kelurahan'];
        $post->kecamatan = $request['kecamatan'];
        $post->nmwil = $request['nmwil'];
        $post->nmpkrj = $request['nmpkrj'];
        $post->agama = $request['agama'];
        $post->tlp = $request['tlp'];
        $post->noktp = $request['noktp'];
        $post->nosim = $request['nosim'];
        $post->tgldaftar = $request['tgldaftar'];
        $post->donorke = $request['donorke'];
        $post->mtdpeng = $request['mtdpeng'];
        

        $post->save();

        return back()->with('message','Pedonor updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $post = Donor::find($id);
        $post->delete();
        $request->session()->flash('message', 'Berhasil Menghapus Data');
        return redirect()->back();  
    }


 public function pengeluaranmu(Request $request)
    {

        $all =  Msldrh::all();
        $munit = Mobileunit::all();

        $random = mt_rand(100000, 999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'K' . date('y') . date('m') . strtoupper(Str::random(6));
        $lastaftp= PengeluaraanKtgMu::latest('id')->first();// Get the latest order
        $random = 'K' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 6, '0', STR_PAD_LEFT);
        $nokeluar = new PengeluaraanKtgMu();
        $nokeluar = $random;
        


       return view('pages.admin.transaksidonor.pengluaranmunit',compact(
            'nokeluar','all','munit'
        ));
    }



    public function cariasldrh(Request $request)
        {
            $query = $request->get('query');

            // Contoh pencarian pada kolom 'name'
            $results = Msldrh::where('asldrh', 'LIKE', "%{$query}%")->get();

            // Kamu bisa parsing data atau format ulang di sini sebelum dikirim ke frontend
            return response()->json($results);
        }

    public function carimu(Request $request)
    {
        $query = $request->get('query');

        // Contoh pencarian pada kolom 'name'
        $results = Mobileunit::where('kdmobil', 'LIKE', "%{$query}%")->get();

        // Kamu bisa parsing data atau format ulang di sini sebelum dikirim ke frontend
        return response()->json($results);
    }
public function hapukeluar($id)
{
    
    $post = DetailPengeluaraanKtgMu::findOrFail($id);
    $post->delete();
     $post = PengeluaraanKtgMu::findOrFail($id);
    $post->delete();

    return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
}

  public function cariktgkeluar(Request $request)
    {
        $barang = TerimaKtg::where('nokntng', $request->barcode)->first();

        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Kantong tidak ditemukan'
            ]);
        }
    }
    public function sv(Request $request)
    {
        // $items = $request->input('items');
        $header = $request->input('item');
    
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitungall = is_array($header) ? count($header) : 0;
        $urutkan = 1;
        $jumlahKeluar = $request->input('hasil'); // misal: 10
    
        // dd($hasil);
      
        // dd($jumlahKeluar);
    //   for ($i = 1; $i <= $ids['jml']; $i++) {
        foreach ($header as $item) {
            DetailPengeluaraanKtgMu::create([
                'nopengeluaran' => $item['nokeluar'],
                'merk' => $item['merkktg'],
                'ukktg' => $item['ukktg'],
                'jnsktg' => $item['jnsktg'],
                'noktg' => $item['nokntng'],
                'status' => 'Ke Mobile Unit',
                'jml_ktg' => $item['jml_ktg'],
                'type_stok' => $item['typestok'],
                'stokaftap' => $item['stokaftap'],
                'realstokaftap' => $jumlahKeluar,
                // 'id_coolbox' => $item['tgldonor'],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);    

      
           $urutkan++;
        }
            PengeluaraanKtgMu::create([
                 'nopengeluaran' => $item['nokeluar'],
                 'tglpengeluaran' => $tanggal,
                 'kdasldrh' => $item['asldrh'],
                 'kdmobil' => $item['kdmobil'],
                 'kodenotebook' => $item['kodenotebook'],
                 'petugas' => $item['petugas'],

            ]);
        //  $antrian = DB::table('tempord')
        //             ->where('type_stok', 'Keluar')
        //             ->ORwhere('ket', 'Permintaan Aftap')
        //             ->orderBy('id', 'asc')
        //             ->lockForUpdate() // Hindari race condition
        //             ->first();

   
        // if ($antrian) {
               DB::table('tempord')
                ->where('type_stok', 'Keluar')
                ->update(['stok' => $jumlahKeluar,]); 

              DB::table('terimaktg')
                ->where('type_stok', 'Keluar')
                ->update(['stok' => $jumlahKeluar,]); 
        // }
     $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

     
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }

      public function datakeluar(Request $request)
    {
        $data = DetailPengeluaraanKtgMu::all();
        // // Ambil 1 produk per kategori (ID terkecil)
        // $products = DB::table('aftpfpdrhd')
        //     ->select('NOFPD',DB::raw('COUNT(NOFPD) as totals'),)
        //     ->where('NOFPD', 'like', "%{$request->keyword}%")
        //     ->groupBy('NOFPD')
        //     ->get();
        $header = $request->input('keyword');

        // dd($header);
        $products = DetailPengeluaraanKtgMu::where('nopengeluaran', $request->keyword)
        ->orderBy('created_at', 'desc') // Or any other column
        ->first();

        $filtered = DetailPengeluaraanKtgMu::whereIn('nopengeluaran', $products->pluck('nopengeluaran'))->get();
    


        return response()->json($filtered);


        return response()->json($filtered, true);

    }
 public function cetakkeluarktg($id)
    {
 
        //   $data =  DB::table('aftpFpdrhd')
        //      ->join('aftpFpdrhH', 'aftpFpdrhd.nofpd', '=', 'aftpFpdrhH.nofpd')
        //     ->where('aftpFpdrhd.id', $id)
        //     ->select('aftpFpdrhd.*','aftpFpdrhH.*')
        //     ->get();

         $data =  DB::table('pengeluaranktgaftp')
             ->join('detailpengeluaranktgaftp', 'detailpengeluaranktgaftp.nopengeluaran', '=', 'pengeluaranktgaftp.nopengeluaran')
            ->where('pengeluaranktgaftp.id', $id)
            ->select('pengeluaranktgaftp.*', 'detailpengeluaranktgaftp.*')
            ->get();
             $get = DetailPengeluaraanKtgMu::findOrFail($id);
             $get2 = PengeluaraanKtgMu::findOrFail($id);


        return view('pages.admin.transaksidonor.cetakkeluarmu',compact('get','get2','data') );
    }



    public function pengembalian(Request $request)
    {

        $all =  Msldrh::all();
        $munit = Mobileunit::all();

        $random = mt_rand(100000, 999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'AK' . date('y') . date('m') . strtoupper(Str::random(6));
        $lastaftp= PengembalianKtgMu::latest('id')->first();// Get the latest order
        $random = 'AK' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 6, '0', STR_PAD_LEFT);
        $nokeluar = new PengembalianKtgMu();
        $nokeluar = $random;
        


       return view('pages.admin.transaksidonor.pengembalianktgmu',compact(
            'nokeluar','all','munit'
        ));
    }
 public function cariktgkembali(Request $request)
    {
        $barang = DetailPengeluaraanKtgMu::where('noktg', $request->barcode)->first();

        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Kantong tidak ditemukan'
            ]);
        }
    }

  public function savekembali(Request $request)
    {
        // $items = $request->input('items');
        $header = $request->input('item');
    
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitungall = is_array($header) ? count($header) : 0;
        $urutkan = 1;
        $jumlahKeluar = $request->input('hasil'); // misal: 10
        $tglkembali = Carbon::parse($request->tglkembali)->format('Y-m-d H:i:s');
        // dd($header);
      
        // dd($jumlahKeluar);
    //   for ($i = 1; $i <= $ids['jml']; $i++) {
        foreach ($header as $item) {
            PengembalianKtgMu::create([
                'nokembali' => $item['nokembali'],
                'merk' => $item['merk'],
                'ukktg' => $item['ukktg'],
                'jnsktg' => $item['jnsktg'],
                'noktg' => $item['noktg'],
                'status' => 'Kantong Kembali ke Aftap',
                'tglkembali' => $tglkembali,
                'type_stok' => 'Retur',
                'stokaftap' => $jumlahKeluar,
                'jml_kembali' => $item['jml_kembali'],
                // 'id_coolbox' => $item['tgldonor'],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);    

      
           $urutkan++;
        }
          
    
   
        // if ($antrian) {
            //    DB::table('tempord')
            //     ->where('type_stok', 'Keluar')
            //     ->update(['stok' => $jumlahKeluar,]); 

            //   DB::table('terimaktg')
            //     ->where('type_stok', 'Keluar')
            //     ->update(['stok' => $jumlahKeluar,]); 
        // }
     $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

     
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
   public function datakembali(Request $request)
    {
        $data = PengembalianKtgMu::all();
        // // Ambil 1 produk per kategori (ID terkecil)
        // $products = DB::table('aftpfpdrhd')
        //     ->select('NOFPD',DB::raw('COUNT(NOFPD) as totals'),)
        //     ->where('NOFPD', 'like', "%{$request->keyword}%")
        //     ->groupBy('NOFPD')
        //     ->get();
        $header = $request->input('keyword');

        // dd($header);
        $products = PengembalianKtgMu::where('nokembali', $request->keyword)
        ->orderBy('created_at', 'desc') // Or any other column
        ->first();

        $filtered = PengembalianKtgMu::whereIn('nokembali', $products->pluck('nokembali'))->get();
    

        return response()->json($filtered);

        return response()->json($filtered, true);

    }

     public function cetakkembali($id)
    {
 
        //   $data =  DB::table('aftpFpdrhd')
        //      ->join('aftpFpdrhH', 'aftpFpdrhd.nofpd', '=', 'aftpFpdrhH.nofpd')
        //     ->where('aftpFpdrhd.id', $id)
        //     ->select('aftpFpdrhd.*','aftpFpdrhH.*')
        //     ->get();

         $data =  DB::table('pengembalianktgmu')
             ->join('detailpengeluaranktgaftp', 'detailpengeluaranktgaftp.nopengeluaran', '=', 'pengeluaranktgaftp.nopengeluaran')
            ->where('pengeluaranktgaftp.id', $id)
            ->select('pengeluaranktgaftp.*', 'detailpengeluaranktgaftp.*')
            ->get();
             $get = DetailPengeluaraanKtgMu::findOrFail($id);
             $get2 = PengeluaraanKtgMu::findOrFail($id);


        return view('pages.admin.transaksidonor.cetakkeluarmu',compact('get','get2','data') );
    }


    public function penyisihan(Request $request)
    {

      
        $random = mt_rand(1000009, 9999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'AK' . date('y') . date('m') . strtoupper(Str::random(7));
        $lastaftp= KtgRusak::latest('id')->first();// Get the latest order
        $random = 'AK' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 7, '0', STR_PAD_LEFT);
        $nokeluar = new KtgRusak();
        $nokeluar = $random;
        
           $alasan =  DB::table('malasanrusak')
            ->select('malasanrusak.*')
            ->get();


       return view('pages.admin.transaksidonor.penyisihanktg',compact(
            'nokeluar','alasan'
        ));
    }
    public function cariktgrusak(Request $request)
    {
         $barang = DB::table('detailpengeluaranktgaftp')
             ->join('kantong', 'kantong.nokntng', '=', 'detailpengeluaranktgaftp.noktg')
             ->join('ktgkirim', 'ktgkirim.nokntng', '=', 'detailpengeluaranktgaftp.noktg')
         ->where('detailpengeluaranktgaftp.noktg', $request->barcode)
            ->select('detailpengeluaranktgaftp.*', 'kantong.*')
         ->first();


        if ($barang) {
            return response()->json([
                'success' => true,
                'data' => $barang
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Kantong tidak ditemukan'
            ]);
        }

      
    }
  public function saverusak(Request $request)
    {
        // $items = $request->input('items');
        $header = $request->input('item');
    
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitungall = is_array($header) ? count($header) : 0;
        $urutkan = 1;
        $rusak = $request->input('rusak');
        $noselang = $request->input('noselang');
        $user = Auth::user()->name; 
        $tgltrans = Carbon::parse($request->tgltrans)->format('Y-m-d H:i:s');
        $alldata = (int) $request->input('item');

        // dd($header);
      
        // dd($header);
    $array = [];

//    for ($i = 1; $i <= $header['']; $i++) {
        foreach ($header as $item) {

                KtgRusak::create([
                    'notrans' => $item['notrans'],
                    'nokntng' => $item['nokntng'],
                    'ukktg' => $item['ukktg'],
                    'jnsktg' => $item['jnsktg'],
                    'tgltrans' => $tgltrans,
                    'jml' => $item['jml'],
                    'ket' => 'Sudah Reject Aftap',
                    'nolot' => $item['nolot'],
                    'kdptgs' => $user,
                    'perk' => $item['perk'],
                    'merk' => $item['merk'],
                    'xx' => $item['xx'],
                    'alasan_rusak' => $rusak,
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);    
         
           $urutkan++;
            //  for ($i = 1; $i < $item['perk']; $i++) {
                
                $barcodes[] = $header; 
            // }
        }
    //   }



          
     $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

     
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }


  public function datasisih(Request $request)
    {
        $data = KtgRusak::all();
        // // Ambil 1 produk per kategori (ID terkecil)
        // $products = DB::table('aftpfpdrhd')
        //     ->select('NOFPD',DB::raw('COUNT(NOFPD) as totals'),)
        //     ->where('NOFPD', 'like', "%{$request->keyword}%")
        //     ->groupBy('NOFPD')
        //     ->get();
        $header = $request->input('keyword');

        // dd($header);
        $products = KtgRusak::where('notrans', $request->keyword)
        ->orderBy('created_at', 'desc') // Or any other column
        ->first();

        $filtered = KtgRusak::whereIn('notrans', $products->pluck('notrans'))->get();
    

        return response()->json($filtered);

        return response()->json($filtered, true);

    }
public function ubahdata(Request $request, $id)
{
    $user = KtgRusak::findOrFail($id);
    $user->update([
        'merk' => $request->merk,
        'ukktg' => $request->ukktg,
        'nokntng' => $request->nokntng,

    ]);

    return response()->json(['success' => true]);
}

public function hapusrusak($id)
{
    $post = KtgRusak::findOrFail($id);
    $post->delete();

    return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
}
public function laporan(Request $request)
{
    $start = $request->start_date;
    $end = $request->end_date;

    $data = DB::table('ktgrusakaftap') // ganti sesuai tabel kamu
        ->whereBetween('tgltrans', [$start, $end])
        ->get();

     return view('pages.admin.transaksidonor.cetakpenyisihan', compact('data', 'start', 'end'));
}
public function prosesCetak(Request $request)
{
    $start = $request->start_date;
    $end = $request->end_date;

    $url = route('datasisih.cetak', ['start_date' => $start, 'end_date' => $end]);

    return response()->json(['url' => $url]);
}


}
