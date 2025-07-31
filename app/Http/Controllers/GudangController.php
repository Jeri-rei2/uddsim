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
use App\Models\User;
use App\Models\TempGd;
use App\Models\Kantong;
use Illuminate\Support\Facades\DB;
use App\Models\Quesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\ItemKantong;
use Illuminate\Http\RedirectResponse;
use DataTables;
use App\Models\KtgOrd;
use App\Models\TempOrd;

use Picqer\Barcode\BarcodeGeneratorHTML; // atau gunakan DNS1D
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PemeriksaanRequest;
  use Illuminate\Support\Facades\Validator;
// use Milon\Barcode\Facades\DNS1D;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class GudangController extends Controller
{
   public function savedonk(Request $request)
    {
        $items = $request->input('items');
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitung = is_array($items) ? count($items) : 0;
        $order = [];
        
   
                foreach ($items as $item) {
                $last =   KtgOrd::create([
                        'notrans' => $item['notrans'],
                        'nopermintaan' => $item['nominta'],
                        'nokntng' => $item['nokntng'],
                        'tgltrans' => $tanggal,
                        'total'=> $item['jml'],
                        'ket'=> 'Dikirim ke Aftap',
                        'kdptgs'=> $item['kdptgs'],
                        'perk'=>  $hitung,
                        'status'=> '1',
                        'created_at' => $tanggal,
                        'updated_at' => $tanggal,
                    ]);

                    //hitung stok 
                    $users = DB::table('tempord')
                           ->select(DB::raw('min(dipenuhi) - min(jumlah) as total'))
                            ->value('total');

                    $id =  TempOrd::where('nogd', $item['notrans'])->update([
                        'dipenuhi' => $hitung, // Kunci pencarian
                        'tujuan_dept' => 'Sudah diterima Aftap',
                        'stok' => $users,
                        'type_stok' => 'Keluar'
                        ] // Data yang akan diupdate/insert
                    );
            


          
            }
           
       

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
     public function carikantong(Request $request)
    {
        $barang = Kantong::where('nokntng', $request->barcode)->first();

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
     public function updateStatus(Request $request)
    {
        $iclik = $request->input('iclik'); // array of product IDs
        $ids = $request->input('ids'); // array of product IDs
        $value = $request->input('value'); // 1 or 0
        $hitung = is_array($iclik) ? count($iclik) : 0;

        // dd($ids);
        $order = [];
        $tanggal = Carbon::now('Asia/Jakarta');
       
        if (is_array($iclik) && count($iclik) ) {
            foreach ($ids as $data) {
              $bos =   TempOrd::whereIn('id', $iclik)->update([
                    'nogd' => $data['notrans'],
                    // 'dipenuhi' => $hitung,
                    'tujuan_dept' => 'Dikirim Ke Aftap',
                    'type_stok' => 'Masuk',
                    'updated_at' => $tanggal,
                ]);
                $order[] = $bos;
                $get = TempOrd::where('notrans', $data['nominta'])->first();

                    if ($get) {
                        return response()->json([
                            'success' => true,
                            'data' => $get,
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'no minta tidak ditemukan'
                        ]);
                    }
                 
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
     public function searchminta(Request $request)
    {
        $keyword = $request->get('keyword');
        $users = TempOrd::where('notrans', 'like', "%$keyword%")->get();
        // dd($users);
        return response()->json($users); // kirim data sebagai JSON
    }
    public function pengeluaran()
    {
         $random = mt_rand(1000000, 9999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'G' . date('y') . date('m') . strtoupper(Str::random(7));
        $lastaftp= KtgOrd::latest('id')->first();// Get the latest order
        $random = 'G' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 7, '0', STR_PAD_LEFT);
        $notrans = new KtgOrd();
        $notrans = $random;
       
        $kirim = DB::table('ktgkirim')
            ->join('kantong', 'ktgkirim.nokntng', '=', 'kantong.nokntng')
            ->select('kantong.*', 'ktgkirim.nokntng as nokntng', 'ktgkirim.ket as ket','ktgkirim.notrans as nokirim', 'ktgkirim.perk as perk')
            ->get();
        $data = KtgOrd::whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
          ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        // whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
           ->orderBy('created_at', 'asc')
           ->get();
    return view('pages.admin.gudang.klrbrng',compact('notrans', 'kirim'));

    }

       public function cetakpengiriman ($id)
    {

        $data = DB::table('ktgkirim')
            ->join('kantong', 'ktgkirim.nokntng', '=', 'kantong.nokntng')
            ->select('kantong.*', 'ktgkirim.nokntng as nokntng', 'ktgkirim.ket as ket','ktgkirim.notrans as nokirim', 
                        'ktgkirim.perk as perk')
            ->get();
        $getminta = DB::table('ktgkirim')
            ->join('tempord', 'ktgkirim.nopermintaan', '=', 'tempord.notrans')
            ->where('ktgkirim.id', $id)
            ->select('tempord.*')
            ->get();
            
        $get = KtgOrd::findOrFail($id);
        return view('pages.admin.gudang.cetakkeluar',compact('data','get','getminta') );
    }
    public function store(Request $request)
    {
        // $jumlah = (int) $request->input('jmlcetak');
        $ids = $request->ids; // bisa angka atau karakter
        $now = Carbon::now();
        $prefix = $now->format('ym'); // YYMM

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['error' => 'Data ID kosong'], 400);
        }
        $barcodes = [];
            $tanggal = Carbon::now('Asia/Jakarta');
         // Ambil nomor terakhir dari database
         $last = DB::table('qrgudang')
         ->where('nokntng', 'like', "$prefix%")
         ->orderBy('nokntng', 'desc')
         ->value('nokntng');
        
         if ($last) {
            $lastSeq = (int)substr($last, 4);
        } else {
            $lastSeq = 0;
        }
        $lastSeq = $last ? (int)substr($last, 4) : 0;
       

        $saved = 0;
        $i = 1;
        // for ($i = 1; $i <= $ids['jml']; $i++) {
            $newSeq = str_pad($lastSeq + $i, 4, '0', STR_PAD_LEFT);
            $newNomor = $prefix . $newSeq;
         foreach($ids as $push ){
            DB::table('qrgudang')->insert([
                // 'id' => $push['id'],
                // 'code' => $push['code'],
                'mrkkntng'=> $push['mrkkntng'],
                'jnskntng'=> $push['jnskntng'],
                'typekntng'=> $push['typekntng'],
                'tglbrcode'=> $push['tglbrcode'],
                'ukuran'=> $push['ukuran'],
                // 'jmlcetak'=> $push['jmlcetak'],
                'duplikat'=> $push['duplikat'],
                'nolot'=> $push['nolot'],
                'nat'=> $push['nat'],
                'nokntng'=> $push['nokntng'],
                'jmlcetak'=> $push['jmlcetak'],
                'tglbrcode' =>  $tanggal,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        //   }
          $barcodes[] = $newNomor;
            $saved++;
        }

        return response()->json(['success' => true, 'saved_count' => $saved]);
    
    }


  public function generate(Request $request)
{
    $kirim = $request->kirim;
    $jmlcetak = (int) $request->input('jmlcetak');
    $saved = 0;
       $tanggal = Carbon::now('Asia/Jakarta');
    $barcodes = [];
       foreach ($kirim as $itemData) {
         DB::table('tempgd')->insert([
        
                'nokntng' => $itemData['nokntng'],
                'nmkntng' => $itemData['typekntng'],
                 'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
          $saved++;
            for ($i = 0; $i < $jmlcetak; $i++) {
                
                $barcodes[] = $kirim; 
            }
        }
       
    return view('pages.admin.gudang.cetakbr', compact('barcodes'));
}
    public function ambildata()
    {
         
      $data = TempGd::all();
        return response()->json($data);
    }

 
    public function index(Request $request)
    {
        $periksa = Periksadonor::all();
        $jnskntng = JnsKtngmerk::all();
        $dtall = ItemKantong::all();


        $last = TempGd::latest('nokntng')->get();
        
        return view('pages.admin.gudang.index',compact(
            'jnskntng','dtall','last'
        ));

    }

public function storeTemporary(Request $request)
    {
    //    $kirim = $request->kirim;
    $barcode = [];
       $saved = [];
       $tanggal = Carbon::now('Asia/Jakarta');
       foreach ($request->kirim as $data) {
        for ($i = 0; $i < $data['jmlcetak']; $i++) {
          $qrtemp = TempGd::create([
            'nokntng' => $data['nokntng'],
            'nmkntng' => $data['typekntng'],
            'data' => $data['jmlcetak'] ?? 1,
            'created_at' => $tanggal,
            'updated_at' => $tanggal,
            'barcode' => DNS1D::getBarcodeHTML($data['nokntng'], 'C128'),

          ]);

          $saved[] = $qrtemp;
  

          

            }
             
        }
      
        return response()->json( $saved);
 
        return response()->json(['message' => 'Data berhasil disimpan']);
    }
    // Generate barcode image secara dinamis
    public function generateBarcode($kode)
    {
        $barcode = DNS1D::getBarcodePNG($kode, 'C128');
        return response(base64_decode($barcode))->header('Content-Type', 'image/png');
    }

    public function getTemporary()
    {
        $prefix = now()->format('ym'); // yymm (contoh: 2405)

        $last = TempGd::where('nokntng', 'like', $prefix . '%')
                    ->orderByDesc('nokntng')
                    ->first();
    // Mengambil ID terakhir dari tabel (dengan urutan DESC)
        $lastId = TempGd::latest('nokntng')->value('nokntng'); // Menggunakan 'latest' untuk urutan ID terbaru

        // Jika tidak ada data, kirimkan 0 atau null
        if (!$lastId) {
            $lastId = null; 
        }
    return response()->json([
        'last_code' => $last ? $last->nokntng : null,
         'last_id' => $lastId
    ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function indexstok()
    {
          // nomor aftp auto
               $random = mt_rand(1000000, 9999999);
               $order = Str::uuid();// Generates a unique UUID
               $order = 'G' . date('y') . date('m') . strtoupper(Str::random(7));
               $lastGD= Kantong::latest('id')->first();// Get the latest order
               $random = 'G' . date('y') . date('m')  . str_pad(($lastGD ? $lastGD->id + 1 : 1), 7, '0', STR_PAD_LEFT);
               $noGD = new Kantong();
               $noGD = $random;

                  
        return view('pages.admin.gudang.stok', [
            // 'Kelompok' => Kelompok::all(),
            'noGD' => $noGD,
        ]);
    }
 // Menangani pencarian data secara AJAX
    public function search(Request $request)
    {
        $barang = ItemKantong::where('nokntng', $request->barcode)->first();

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

    public function save(Request $request)
    {
        // $items = $request->input('items');
        $tanggal = Carbon::now('Asia/Jakarta');

        foreach ($request->items as $item) {
            Kantong::create([
                'noterima' => $item['noterima'],
                'nokntng' => $item['nokntng'],
                'mrkkntng'=> $item['mrkkntng'],
                'jnskntng'=> $item['jnskntng'],
                'typekntng'=> $item['typekntng'],
                'ukuran'=> $item['ukuran'],
                'nolot'=> $item['nolot'],
                'sttskantong'=> '1',
                'tglterima' => $tanggal,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $post = Donor::find($id);
        $post->delete();
        $request->session()->flash('message', 'Berhasil Menghapus Data');
        return redirect()->back();  
    }
}
