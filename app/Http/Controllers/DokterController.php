<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Requests\CreatePesananRequest;
use App\Models\Barang;
use App\Models\DetailOrder;
use App\Models\Pesanan;
use App\Models\DetailStatus;
use App\Models\Obat;
use App\Models\Resep;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function history(Pesanan $pesanan)
    {

        return view('pages.pimpinan.history', [
            'pesanan' => $pesanan,
             'cetak' => DB::table('resep')
             ->whereIn('id', [$pesanan->id])
             ->get(), 


        ]);

    }
    public function cetakresep(Pesanan $pesanan)
    {
    
            return view('pages.pimpinan.cetakresep', [
                'pesanan' => $pesanan,
                 'cetak' => DB::table('resep')
                 ->get(), 
                 
                 'alamat' => DB::table('resep')
                 ->limit(1)->get(),

            ]);
     
    }


    public function orderpasien(Pesanan $pesanan)
    {
       
        //    dd($pesanan);
            return view('pages.pimpinan.pesanan', [
             'orders' =>  Pesanan::with('user', 'barang', 'detailOrders',
                'payment','detail_status')->where('status', 'Sudah Dibayar')->orderBy('id', 'DESC')->get(),
        
              
            ]);
       
    }
    
    public function resep(Request $request)
    {

        return view('pages.pimpinan.resep',[ 
            'tampil' => Resep::orderBy('id', 'asc')->limit(1)->get(),

            'users' => Pesanan::with('user')->get(),
        'obat' => Obat::get(["kode_brng", "id","nama_brng"]),

            'resep' => Resep::select(
                'id','obat',
                'dokter','tglresep','kode_brng','pasien',
                'jumlah','aturanpakai','keterangan'
                )->paginate(10),
            
            
        ]);
    }


    public function uplodresep(Request $request)
    {

        // $folderPath = public_path('upload-ttd/');
        // $image_parts = explode(";base64,", $request->signed);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . uniqid() . '.'.$image_type;

        // file_put_contents($file, $image_base64);

        $request->request->add([
            'kode_brng' => $request->kode_brng,
            'obat' => $request->nama_brng,
            'jumlah' => $request->jumlah,
            'aturanpakai' => $request->aturanpakai,
            'tglresep' => $request->tglresep,
            // 'obat' => $request->obat,
            'dokter' => $request->dokter,
            'keterangan' => $request->keterangan,
            'pasien' => $request->pasien,
            'status_bayar' => 'Belum Dibayar',


            // 'ttd' => $file,
            ]);
        $order = Resep::create($request->all());
        // $obat =  Obat::with('resep')->get();


        
        return back()->with('success', 'Resep Berhasil Tersimpan ');
       
    }

    // public function dataresep()
    // {
        //
        // return view('pages.admin.pesanan.index', [
        //     'orders' => Pesanan::with('user', 'barang', 'detailOrders', 'payment')->where('status', '!=', 'Selesai')->orderBy('id', 'DESC')->get(),
        // ]);

    // }

    /**
     * Show the form for creating a new resource.
     */
    public function editresep($id)
    {
        //
        $resep = Resep::find($id);
        // return view('pages.pimpinan.resep', compact('resep'));
    }
    public function updateresep(Request $request, $id)
    {
        $resep = Resep::find($id);

        // $resep->doker = $request->input('name');
        $resep->obat = $request->input('obat');
        $resep->jumlah = $request->input('jumlah');
        $resep->aturanpakai = $request->input('aturanpakai');
        $resep->keterangan = $request->input('keterangan');

        $resep->update();
        return back()->with('success', 'Resep Berhasil Di Ubah ');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //     $request->validate([
    //         'pesanan_id' => 'required',
    //         'status_periksa' => 'required',
    //         'area' => 'required',

    //     ]);
        
    //    $s = DetailStatus::create($request->all());
    //     dd($s);
        // $request->validate([
        //     'pesanan_id' => 'required',
        //     'name' => 'required',
        //     'status' => 'required',
        //     'user_id' => 'required',
        //     'total_harga' => 'required',
        //     'snap_token' => 'required',
        //     'keluhan' => 'required',

        // ]);
      
        // return redirect()->route('pages.pimpinan.periksa')->with('message', 'Order Telah Dikonfirmasi');

    }

    public function invoice(Pesanan $pesanan)
    {
        if (Auth::check()) {
            return view('pages.pimpinan.pesanan.invoice.index', [
                'pesanan' => $pesanan,
                 'barang' => Barang::orderBy('id', 'asc')->limit(1)->get(),
                 'pay' => DB::table('payments')
                 ->whereIn('pesanan_id', [$pesanan->id])
                 ->get(), 
                  'area' => DB::table('pesanan')
                    ->whereIn('order_id', [$pesanan->order_id])
                    ->get(), 
                

            ]);
            // dd($users); 
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return view('pages.pimpinan.periksa', [
            'periksa' =>  Pesanan::with('user', 'barang', 'detailOrders',
                'payment')->where('status', 'Sudah Dibayar')->orderBy('id', 'DESC')->limit(1)->get(),
                
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
   
        $student = Pesanan::find($id);

        // $student->name = $request->input('name');
        $student->status = $request->input('status');
        $student->user_id = $request->input('user_id');
        $student->snap_token = $request->input('snap_token');
        $student->keluhan = $request->input('keluhan');

        $student->update();
        
      
    //   dd($student);

    return redirect()->route('orderpasien')->with('success', 'Order Telah Dikonfirmasi');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Resep::find($id)->delete();

        return back()->with('success', 'Data Berhasil Di hapus ');

    }
}
