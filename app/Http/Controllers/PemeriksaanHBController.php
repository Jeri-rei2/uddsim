<?php

namespace App\Http\Controllers;


use App\Models\Ukurancc;
use App\Models\JnsKtng;
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
use App\Models\PeriksaHb;
use DB;
use App\Models\Quesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PemeriksaanRequest;
  use Illuminate\Support\Facades\Validator;

class PemeriksaanHBController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
 
    public function index(Request $request)
    {

        //  $filter = Donor::paginate(10);
        $periksa = Periksadonor::all();
 
        // $join = DB::table('donor')
        // ->join('priksadokter', 'priksadokter.nodonor', '=', 'donor.nodonor')
        // ->select('priksadokter.*','donor.*','donor.photo as photo')
        
        // ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
        // ->whereRaw('day(priksadokter.created_at) = ' . date('d') . ' and month(priksadokter.created_at) = ' . date('m') . ' and year(priksadokter.created_at) = ' . date('Y'))
        // ->where('status', 'HB')
        // ->get();
     
            // $join2 = DB::table('donor')
            // ->select('cabang.*','donor.*','priksadokter.*')
            // ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
            // ->join('priksadokter', 'donor.nodonor', '=', 'priksadokter.nodonor')
            // ->where('priksadokter.status', 'HB')
            // ->first();
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
        // PeriksaHb::whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        //   ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
        //   ->where('loket_id', $request->loket)
        //  ->orderBy('created_at', 'asc')
        //  ->get();

        $datahb = DB::table('priksadonor')
        ->select('priksadonor.*')
        // ->whereRaw('day(priksadonor.created_at) = ' . date('d') . ' and month(priksadonor.created_at) = ' . date('m') . ' and year(priksadonor.created_at) = ' . date('Y'))
        ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
        ->whereRaw('EXTRACT(DAY FROM created_at) = ?', date('m') )
        ->get();
        

        $cab = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
        $donor = Donor::whereDate('created_at', Carbon::today())->get();
        $userId = User::all();    
        //     $kenegaraan = Kewarganegaraan::with('cabang')->orderBy('id', 'DESC')->get();
            $ukuran = Ukurancc::all();
            $jnskntng = JnsKtng::all();
            $loket = Loket::all();
          // $antrian = Antrian::all();
          $antrian = '';
          
          
          if ($request->id_loket) {
              # code...
              $antrian = Antrian::where('loket_id', $request->id_loket)
                  // ->where('day(created_at)', date('d'))
                  ->whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
                  ->orderBy('created_at', 'asc')
                  ->get();
          }

       
        return view('pages.admin.periksahb.index',compact(
           'ukuran','jnskntng',
           'donor','cab', 'loket', 'userId',
           'antrian','periksa','join2','datahb',
           
               ) );

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
            'noaftap'=>'required',
            'tgldaftar'=>'required',
            'tglperiksa'=>'required',
            'tglhema'=>'required',
            'tglaftap'=>'required',
            'nodonor'=>'required',
            'namadonor'=>'required',
            'goldar'=>'required',
            'rhesus'=>'required',
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
            // 'statperiksa'=>'required',
            // 'stathema'=>'required',
            // 'statkirim'=>'required',
            // 'ckdptgs'=>'required',
            // 'kode'=>'required',
            // 'cekblntglthn'=>'required',
            // 'bulan'=>'required',
            // 'thn'=>'required',
            // 'uploadstamp'=>'required',
            
          ],[
          
            'kdcab' =>'kosong',
            'noaftap'=>'kosong',
            'tgldaftar'=>'kosong',
            'tglperiksa'=>'kosong',
            'tglhema'=>'kosong',
            'tglaftap'=>'kosong',
            'nodonor'=>'kosong',
            'namadonor'=>'kosong',
            'goldar'=>'kosong',
            'rhesus'=>'kosong',
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
            // 'statperiksa'=>'kosong',
            // 'stathema'=>'kosong',
            // 'statkirim'=>'kosong',
            // 'ckdptgs'=>'kosong',
            // 'kode'=>'kosong',
            // 'cekblntglthn'=>'kosong',
            // 'bulan'=>'kosong',
            // 'thn'=>'kosong',
            // 'uploadstamp'=>'kosong',
          ]);
    
       
           
            $data = [
            'kdcab'=> $request->kdcab, 
            'noaftap'=> $request->noaftap, 
            'tgldaftar'=>$request->tgldaftar, 
            'tglperiksa'=>$request->tglperiksa, 
            'tglhema'=>$request->tglhema, 
            'tglaftap'=>$request->tglaftap, 
            'nodonor'=>$request->nodonor, 
            'namadonor'=>$request->namadonor, 
            'goldar'=>$request->goldar, 
            'rhesus'=>$request->rhesus, 
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
            'status'=> 'Periksa AFTAP', 
            // 'statperiksa'=>$request->statperiksa, 
            // 'stathema'=>$request->stathema, 
            // 'statkirim'=>$request->statkirim, 
            // 'ckdptgs'=>$request->ckdptgs, 
            // 'kode'=>$request->kode, 
            // 'cekblntglthn'=>$request->cekblntglthn, 
            // 'bulan'=>$request->bulan, 
            // 'thn'=>$request->thn, 
            // 'uploadstamp'=>$request->uploadstamp, 
            
            ];

            $table = PeriksaHb::create($data);
            // $table = Aturanumur::create($data);


            $doktr = Periksadonor::whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
          ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
                //  ->whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
                ->where('nodonor', $request->nodonor)
                ->orderBy('created_at', 'asc')
                ->get();
            foreach($doktr as $us)
             $us->update([
                'status' => 'AFTAP',  
             ]);
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
}
