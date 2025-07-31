<?php

namespace App\Http\Controllers;


use App\Models\Pengiriman;
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
use PDF;


class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode('0001245786925', $generator::TYPE_CODE_128);
  

        $kirim = Pengiriman::take(1)->get();
        $kirimbanyak = Pengiriman::all();
        $minta = Permintaan::all();

        return view('pages.admin.pengiriman.index',compact(
            'barcode','kirim', 'kirimbanyak','minta',
        ));
    }

    public function cari (Request $request)
    {
        $cari = $request->cari;

        $kirimdata = Pengiriman::where(function ($query) use ($cari){

            $query->where('nokeluar', 'nostok', "%$cari%")
            ->orWhere('nopermintaan', 'like', "$cari");
        })->get();
        return view('pages.admin.pengiriman.generateQR',compact(
          'cari'));
    }


    public function generate (Request $request, $id)
    {
        // $kirim = Pengiriman::take(1)->get($id);
        $data = Pengiriman::findOrFail($id);
        $tglkirim = $data->created_at->format('d-m-Y H:i:s');

        $qrcode = QrCode::size(155)->generate($data->nokeluar);
        $minta = Permintaan::where('idpengiriman', $id)->get();

        return view('pages.admin.pengiriman.generateQR',compact(
            'qrcode',
            'data','minta','tglkirim'));
    }



    public function cetak(Request $request)
    {
        
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode('0001245786925', $generator::TYPE_CODE_128);
  
        $kirim = Pengiriman::take(1)->get();
        $kirimbanyak = Pengiriman::all();
        $minta = Permintaan::all();

        return view('pages.admin.pengiriman.cetakkirim',compact(
            'barcode','kirim', 'kirimbanyak','minta',
        ));
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
    public function cetak_pdf()
    {
    	$minta = Permintaan::with('pengiriman')->orderBy('id',)->get();

 
    	$pdf = PDF::loadview('pages.admin.pengiriman.barcode_pdf',['minta'=>$minta]);
    	return $pdf->download('barcode-permintaan-pdf');
    }
    
    public function export() 
    {
        return Excel::download(new PengirimanExport, 'pengiriman.xlsx');
    }

}
