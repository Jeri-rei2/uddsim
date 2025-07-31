<?php

namespace App\Http\Controllers;


use App\Models\Pengiriman;
use App\Models\Tujuanrs;
use App\Models\Mjnsdrh;

use App\Models\Permintaan;
use App\Models\JnsBrng;
use App\Models\JnsKtng;
use App\Models\Ukurancc;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\PengirimanImport;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\PengirimanExport;
use App\Imports\PermintaanImport;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        
         // nomor donor auto
         $randomNumber = mt_rand(1000000, 9999999);
         $orderNumber = Str::uuid();// Generates a unique UUID
         $orderNumber = 'N' . date('y') .date('m') . strtoupper(Str::random(7));
         $lastOrder = Permintaan::latest('id')->first();// Get the latest order
         $orderNumber = 'N' . date('y') . date('m') . str_pad(($lastOrder ? $lastOrder->id : 1), 7, '0', STR_PAD_LEFT);
       
         $nopermintaan = new Permintaan();
         $nopermintaan = $orderNumber;



        $kirimbanyak = Pengiriman::all();
        $tujuan = Tujuanrs::all();
        $jnsdrh = Mjnsdrh::all();

        return view('pages.admin.permintaan.index',
        compact(
            // 'barcode','kirim', '',
            'jnsdrh','nopermintaan',
            'tujuan',
        )
        );
    }



    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('excel',$nama_file);

        // import data
        $import = Excel::import(new PengirimanImport,request()->file('file'));

        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('kirim.index')->with(['message' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('kirim.index')->with(['error' => 'Data Gagal Diimport!']);
        }
        // try{

        //     Excel::import(new PengirimanImport, $request->file('file'));
        //     return response()->json(['data'=>'Users imported successfully.',201]);
        // }catch(\Exception $ex){
        //     Log::info($ex);
        //     return response()->json(['data'=>'Some error has occur.',400]);

        // }
       
    }
    
    public function export() 
    {
        return Excel::download(new PermintaanExport, 'pengiriman.xlsx');
    }

}
