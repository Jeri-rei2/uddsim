<?php

namespace App\Http\Controllers;

use \App\Models\Antrian;
use App\Models\Layanan;
use \App\Models\Loket;
use App\Models\Donor;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Setnodonor;
use App\Models\Kelompok;
use App\Models\Pekerjaan;
use App\Models\Periksadonor;
use App\Models\Kewarganegaraan;
use App\Models\JnsKtng;
use App\Models\Ukurancc;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function lanjut(Request $request)
    {
      $last =  DB::table('antrians')
    ->where('id', $request->antrian)
    ->where('status', 'dipanggil')
    ->update([
        'status' => 'dipanggil',
         'ruang' => '1',
         'tujuan' => 'HB',
         'loket_id' => '2',
         'nomor' => 'HB01',
      ]);
        // $last = Antrian::whereId($request->antrian)->first();
        // dd($last);

        // $last->update([
        //     'status' => 'dipanggil' ,
        //     'ruang' => '1',
        //     'tujuan' => 'HB',
        //     'loket_id' => '2',
        //     'nomor' => 'HB01',
        //     'waktu_panggil' => Carbon::now('Asia/Jakarta'),
        // ]);
        return redirect()->back();

        // dd($str);
    }
      public function lanjuthb(Request $request)
    {
        // $last = Antrian::whereId($request->antrian)->first();
        // dd($last);
        $last =  DB::table('antrians')
            ->where('id', $request->antrian)
            ->where('status', 'selesai')
            ->update([
                'status' => 'selesai' ,
                'ruang' => '0',
                'tujuan' => 'AFTP',
                'loket_id' => '3',
                'nomor' => 'AFT01',
            ]);
        // dd($last);

        // $last->update([
        //     'status' => 'selesai' ,
        //     'ruang' => '0',
        //     'tujuan' => 'AFTP',
        //     'loket_id' => '3',
        //     'nomor' => 'AFT01',
        //     'waktu_panggil' => Carbon::now('Asia/Jakarta'),
        // ]);
        return redirect()->back();

        // dd($str);
    }
  public function panggilhb()
    {
    // Ambil 1 antrian yang belum dipanggil, pakai DB transaction
    DB::beginTransaction();
   
    try {
    //    $antrian =  DB::table('antrians')
    //     ->where('status', 'dipanggil')
    //     ->update([
    //         'status' => 'selesai',
    //         'loket_id' => '2',
            
    //         ]); 
        $antrian = DB::table('antrians')
                     ->where('status', 'dipanggil')
                     ->ORwhere('status', 'selesai')

                    ->orderBy('id', 'asc')
                    ->lockForUpdate() // Hindari race condition
                    ->first();
        // dd($antrian);

        if ($antrian) {
            // $antrian->update([
            //     'status' => 'selesai',
            //     'loket_id' => '2',
            //     'waktu_panggil' => Carbon::now('Asia/Jakarta'),
            // ]);
               $ubah =  DB::table('antrians')
                ->where('status', 'dipanggil')
                ->update([
                    'status' => 'selesai',
                    'loket_id' => '2',
                    
                    ]); 
            

            DB::commit();

            return response()->json([
                'status' => 'sukses',
                'data' => $antrian
            ]);

        } else {
            DB::rollBack();

            return response()->json([
                'status' => 'kosong',
                'message' => 'Tidak ada antrian menunggu.'
            ]);
        }
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }

    return redirect()->back();
    }




    public function panggil()
    {
    // Ambil 1 antrian yang belum dipanggil, pakai DB transaction
    DB::beginTransaction();
   
    try {
       
        $antrian = DB::table('antrians')
                    ->where('status', 'menunggu')
                    ->ORwhere('status', 'dipanggil')
                    ->orderBy('id', 'asc')
                    ->lockForUpdate() // Hindari race condition
                    ->first();

   
        if ($antrian) {
             $antrian =  DB::table('antrians')
                ->where('status', 'menunggu')
                ->update(['status' => 'dipanggil']); 
            // $antrian->status ='dipanggil';
            // $antrian->save();
            // $antrian->update([
            //     'status' => 'dipanggil',
            //     'loket_id' => '1',
            //     // 'waktu_panggil' => Carbon::now('Asia/Jakarta'),
            // ]);
        // return redirect()->back();

            DB::commit();

            return response()->json([
                'status' => 'sukses',
                'data' => $antrian
            ]);
        } else {
            DB::rollBack();

            return response()->json([
                'status' => 'kosong',
                'message' => 'Tidak ada antrian menunggu.'
            ]);
        }
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }

    return redirect()->back();
    }

    public function index(Request $request)
    {
        $periksa = Periksadonor::all();
        $ambilaja = DB::table('donor')
            ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
            ->select('cabang.*', 'donor.*')
            ->get();
        $cab = Cabang::all();
        $donor = DB::table('donor')
        ->whereRaw('DATE(created_at) = ?', [Carbon::today()->toDateString()])
        ->get();
        $ukuran = Ukurancc::all();
        $jnskntng = JnsKtng::all();
        $loket = Loket::all();
        $userId = User::all();    

        $data = DB::table('antrians')
        ->where('status', 'menunggu')
        ->get();
        $antrian = '';

        if ($request->id_loket) {
            # code...
            $antrian = DB::table('antrians')
                // ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
                // ->where('day(created_at)', date('d'))
                // ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
                ->where('loket_id', $request->id_loket)
                ->orderBy('created_at', 'asc')
                ->get();
        }
        return view('pages.admin.periksadokter.antrian', compact(
            'antrian', 'data','userId',
            'loket',
            'donor',
            'cab','ambilaja',
            'jnskntng',
            'ukuran','periksa',

            
        ));
    }
  
    public function indexhb(Request $request)
    {
        $periksa = Periksadonor::all();
        $join2 = DB::table('donor')
                    ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
                    ->join('priksadokter', 'donor.nodonor', '=', 'priksadokter.nodonor')
                    ->select('cabang.*','donor.*','priksadokter.*')
                
                    ->where('priksadokter.status', 'HB')
                    ->get();
            //cek jika data kosong 
            if(!$join2){
                abort(404, 'data tidak ada');
            }else{ 
                    
            }
        // dd($join); 
        $datahb = DB::table('priksadonor')->paginate(2);
        $datahb = DB::table('priksadonor')
        ->select('priksadonor.*')
        ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        ->get();

        $items = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
        $donor = DB::table('donor')
        ->whereRaw('DATE(created_at) = ?', [Carbon::today()->toDateString()])
        ->get();
        $ukuran = Ukurancc::all();
        $jnskntng = JnsKtng::all();
        $loket = Loket::all();
        $userId = User::all();    

        $data = DB::table('antrians')
        ->whereRaw('DATE(created_at) = ?', [Carbon::today()->toDateString()])
        ->get();
        $antrian = '';

        if ($request->id_loket) {
            # code...
            $antrian = DB::table('antrians')
        //   ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        //   ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
          ->where('loket_id', $request->id_loket)
         ->orderBy('created_at', 'asc')
         ->get();
            
            
            
                //   Antrian::where('loket_id', $request->id_loket)
                // // ->where('day(created_at)', date('d'))
                // ->whereRaw('day(created_at) = ' . date('d') . 
                // ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
                // ->orderBy('created_at', 'asc')
                // ->get();
        }
        // dd($antrian);
        return view('pages.admin.periksahb.index', compact(
            'antrian', 'data','userId',
            'loket',
            'donor',
            'items',
            'jnskntng','join2',
            'ukuran','periksa','datahb'

            
        ));
    }
   

    public function cetakHB(Request $request)
    {
       $antrianNow = DB::table('antrians')
       ->where('loket_id', $request->getid)
        //    whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        //   ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        
         ->orderBy('created_at', 'asc')
         ->get();
        
        // dd($antrianNow);


        if (count($antrianNow) > 0) {
            //jika antrian di tanggal sekarang datanya lebih dari 0
            //maka lanjutkan antrian sesuai nomber antrian
            //jika tidak ada maka mulai dari 1

            $no_antrian = count($antrianNow);
            // dd($no_antrian);
            $kode = 'HB';
            if (!$no_antrian == 0) {
                $no_antrian = $no_antrian + 1;
            }
            if ($no_antrian < 10) {
                $kode = 'HB0';
            } else {
                $kode = 'HB';
            }
        } else {
            $no_antrian = 0;
            $kode = 'HB';
            if ($no_antrian == 0) {
                $no_antrian = $no_antrian + 1;
            }
            if ($no_antrian < 10) {
                $kode = 'HB0';
            } else {
                $kode = 'HB';
            }
        }
            // nomor donor auto
            $randomNumber = mt_rand(100000, 999999);
            $orderNumber = Str::uuid();// Generates a unique UUID
            $orderNumber = 'T-' . date('y') . strtoupper(Str::random(6));
            $lastOrder = Donor::latest('id')->first();// Get the latest order
            $orderNumber = 'T-' . date('y') . str_pad(($lastOrder ? $lastOrder->id : 1), 6, '0', STR_PAD_LEFT);

            $nodonor = new Donor();
            $nodonor = $orderNumber;
            $idantrian = DB::table('antrians')->orderBy('loket_id')->first();
        $data = [
            'loket_id' => $request->idantrian,
            'no_antrian' => $kode . $no_antrian,
            'id_donor' => $lastOrder->id,
            'namadonor' => $lastOrder->namadonor,
            'ruang' => "1",
        ];
        
        $tiket = DB::table('antrians')
        ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        ->where('loket_id', 2)
        ->where('status', 'dipanggil')
        ->orderBy('created_at', 'asc')
        ->first();
        // dd($data);

        // Antrian::create($data);
        return view('pages.antrian.cetak_antrian_hb', compact(
            'tiket',
        ));
    }
    public function cetakdokter(Request $request)
    {

        $antrianNow = DB::table('antrians')
            ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
            ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
            ->where('loket_id', $request->getid)
            ->orderBy('created_at', 'asc')
            ->first();
        // dd($antrianNow);


        if (count($antrianNow) > 0) {
            //jika antrian di tanggal sekarang datanya lebih dari 0
            //maka lanjutkan antrian sesuai nomber antrian
            //jika tidak ada maka mulai dari 1

            $no_antrian = count($antrianNow);
            // dd($no_antrian);
            $kode = 'D';
            if (!$no_antrian == 0) {
                $no_antrian = $no_antrian + 1;
            }
            if ($no_antrian < 10) {
                $kode = 'D0';
            } else {
                $kode = 'D';
            }
        } else {
            $no_antrian = 0;
            $kode = 'D';
            if ($no_antrian == 0) {
                $no_antrian = $no_antrian + 1;
            }
            if ($no_antrian < 10) {
                $kode = 'D0';
            } else {
                $kode = 'D';
            }
        }
            // nomor donor auto
            $randomNumber = mt_rand(100000, 999999);
            $orderNumber = Str::uuid();// Generates a unique UUID
            $orderNumber = 'T-' . date('y') . strtoupper(Str::random(6));
            $lastOrder = Donor::latest('id')->first();// Get the latest order
            $orderNumber = 'T-' . date('y') . str_pad(($lastOrder ? $lastOrder->id : 1), 6, '0', STR_PAD_LEFT);

            $nodonor = new Donor();
            $nodonor = $orderNumber;
            $getid = Donor::orderBy('id')->first();
        $data = [
            'loket_id' => $request->getid,
            'no_antrian' => $kode . $no_antrian,
            'id_donor' => $lastOrder->id,
            'namadonor' => $lastOrder->namadonor,
            'ruang' => "3",
        ];
        $tiket = Antrian::latest()->where('loket_id', 1)->where('status', 0)->get();

        // dd($data);

        Antrian::create($data);
        return view('pages.antrian.cetak_antrian_dokter', compact(
            'tiket'
        ));
    }
    public function getLoketId($loketId)
    {
        return view('dashboard.antrian.get_antrian', [
            'antrian' => Antrian::where('loket_id', $loketId)->orderBy('created_at', 'asc')->get(),
        ]);
    }
}
