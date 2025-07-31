<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Cabang;
use App\Models\PeriksaUlangGD;
use App\Models\AftpDrhH;
use App\Models\AftpDrhD;
use App\Models\Petugas;
use App\Models\LBSgGoldar;
use App\Models\LBSgGoldarH;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LitBanGController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

       $lbs  = LBSgGoldar::all();
       $random = mt_rand(1000009, 9999999);
        $order = Str::uuid();// Generates a unique UUID
        $order = 'Q' . date('y') . date('m') . strtoupper(Str::random(7));
        $lastaftp= PeriksaUlangGD::latest('id')->first();// Get the latest order
        $random = 'Q' . date('y') . date('m') . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 7, '0', STR_PAD_LEFT);
        $noperiksa = new PeriksaUlangGD();
        $noperiksa = $random;



      return view('pages.admin.litbang.index',compact('noperiksa','lbs'));
    }

     public function getData()
    {
        $users =  DB::table('LBstGolDarahD')
             ->join('donor', 'donor.nodonor', '=', 'LBstGolDarahD.NoDonor')
             ->join('LBstGolDarahH', 'LBstGolDarahH.Noperiksa', '=', 'LBstGolDarahD.Noperiksa')
            ->select('donor.nodonor','LBstGolDarahD.Noperiksa','LBstGolDarahH.Tglperiksa','LBstGolDarahH.ckdptgs','LBstGolDarahH.status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('donor.nodonor','LBstGolDarahD.Noperiksa','LBstGolDarahH.Tglperiksa','LBstGolDarahH.ckdptgs','LBstGolDarahH.status',)
            ->having('LBstGolDarahD.Noperiksa', '>', 1)
            ->get();
        $data =  DB::table('LBstGolDarahD')
             ->join('donor', 'donor.nodonor', '=', 'LBstGolDarahD.NoDonor')
             ->join('LBstGolDarahH', 'LBstGolDarahH.Noperiksa', '=', 'LBstGolDarahD.Noperiksa')
            ->select('donor.*','LBstGolDarahD.*','LBstGolDarahH.*')
           
            ->get();
        return response()->json([
            'users' => $users,
            'data' => $data,
            ]);
    }
   public function cariktg(Request $request)
    {
         $barang = DB::table('aftpFpdrhd')
             ->join('kantong', 'kantong.nokntng', '=', 'aftpFpdrhd.nokntng')
             ->join('donor', 'donor.nodonor', '=', 'aftpFpdrhd.nodonor')
             ->join('aftpFpdrhH', 'aftpFpdrhH.nofpd', '=', 'aftpFpdrhd.nofpd')
         ->where('aftpFpdrhd.nokntng', $request->barcode)
            ->select('aftpFpdrhd.*', 'kantong.*','donor.*','aftpFpdrhd.goldar as goldr')
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
       public function resultdata(Request $request)
    {
        $kode = $request->input('kdptgs');

        $petugas = Petugas::where('KodePetugas', $kode)->first();

        if ($petugas) {
            return response()->json(['NamaPetugas' => $petugas->NamaPetugas]);
        } else {
            return response()->json(['NamaPetugas' => null], 404);
        }
        return response()->json($users);
    }

      public function saveawal(Request $request)
    {
        // $items = $request->input('items');
        $header = $request->input('item');
    
        $tanggal = Carbon::now('Asia/Jakarta');
        $hitungall = is_array($header) ? count($header) : 0;
        $saved = 0;
        $noperiksa = $request->input('noperiksa');
        $kdptgs = $request->input('kdptgs');
        $nmptgs = $request->input('nmptgs');
        $barcodes = [];
        $alldata = (int) is_array($header) ? count($header) : 0; 

        // dd($header);
      
        // dd($kdptgs);


//    for ($i = 1; $i <= $header['']; $i++) {
        // foreach ($header as $item) {

           


            //   $saved++;

            //  for ($i = 1; $i < $item['perk']; $i++) {
                
                // $barcodes[] = $header; 
            // }
        // }
            foreach ($header as $item) {
                 LBSgGoldar::create([

                    'Noperiksa'=> $item['noperiksa'],
                    'NoKantong'=> $item['nokntng'],
                    'NoDonor'=> $item['nodonor'],
                    'GolDarah'=> $item['goldar'],
                    'Rhesus'=> $item['rhesus'],
                    'GolDarah_LB'=> '',
                    'Rhesus_LB'=> '',
                    'status'=> '',
                    'lastupdate'=> $tanggal,
                    'GolDarah_LIS'=> '',
                    'Rhesus_LIS'=> '',
                    'Tgl_LIS'=> $tanggal,
                    'Idx_LIS'=> '',
                    'Mesin_LIS'=> '',
                    'KDCab'=> $item['kdcab'],
                    'AslDrh'=> $item['asldrh'],
                    'flg'=> '',
                    'nourut'=> '',
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);    

                
              for ($i = 1; $i < $alldata; $i++) {
                
                $barcodes[] = $header; 
              }
                     $saved++;


            }

                     LBSgGoldarH::create([

                        'Noperiksa'=> $item['noperiksa'],
                        'Tglperiksa' => $tanggal,
                        'ckdptgs' =>  $kdptgs,
                        // 'perk' => $item['notrans'],
                        'status' => 'Proses',
                        'lastupdate' => $tanggal,
                        'kdcab' => $item['kdcab'],
                        'created_at' => $tanggal,
                        'updated_at' => $tanggal,
                ]);

    //   }



          
     $notification = array(
                'message' => 'Berhasil Simpan Data',
                'alert-type' => 'success'
            );
        
                return redirect()->back()->with($notification);
        

     
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }


    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
   
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
      
    }
}
