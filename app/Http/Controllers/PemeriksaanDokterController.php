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
use Illuminate\Support\Facades\DB;
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

use PDF;
use Mail;
use App\Mail\Sendantrian;

class PemeriksaanDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

  

    public function idxquest()
    {
            return response()->json(Quesioner::all());
    }



     public function sendmail(Request $request,  User $user)

    {
        $data["email"] = "jerireinaldo@gmail.com";

        $data["title"] = "From ItSolutionStuff.com";

        $data["body"] = "This is Demo";

  

        $pdf = PDF::loadView('pages.emails.cetak_antrian_hb', $data);

  

        Mail::send('pages.emails.cetak_antrian_hb', $data, function($message)use($data, $pdf) {

            $message->to($data["email"], $data["email"])

                    ->subject($data["title"])

                    ->attachData($pdf->output(), "text.pdf");

        });

  

        dd('Mail sent successfully');

    }
 
    public function index(Request $request)
    {

        //  $filter = Donor::paginate(10);
        $periksa = Periksadonor::all();
        $quest = Quesioner::all();
        //    $ukurancc = Ukurancc::all(); 
        $items = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
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
           $antrian =     Antrian::whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
          ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
          ->where('loket_id', $request->id_loket)
         ->orderBy('created_at', 'asc')
         ->get();
            //  Antrian::where('loket_id', $request->id_loket)
            //       // ->where('day(created_at)', date('d'))
            //       ->whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            //       ->orderBy('created_at', 'asc')
            //       ->get();
          }

       
        return view('pages.admin.periksadokter.index',compact(
           'ukuran','jnskntng',
           'donor','items', 'loket', 'userId',
           'antrian','periksa','quest'
           
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

    public function quesioner(Request $request)
    {
           $tanggal = Carbon::now('Asia/Jakarta');
        $validasi = Validator::make($request->all(),[
            'kdcab' => 'required',
            'id_donor'=> 'required',
            'nodonor'=> 'required',
            'noaftp'=> 'required',
            'tglperiksa'=> 'required',
            'sehat'=> 'required',
            'sakit'=> 'required',
            'diabet'=> 'required',
            'ginjal'=> 'required',
            'radang'=> 'required',
            'jantung'=> 'required',
            'hemofilia'=> 'required',
            'asma'=> 'required',
            'tbc'=> 'required',
            'kenjang'=> 'required',
            'hiv'=> 'required',
            'hepatitis'=> 'required',
            'sifilis'=> 'required',
            'malaria'=> 'required',
            'luarngri'=> 'required',
            'hasilpriksa'=> 'required',
            'orglain'=> 'required',
            'bln'=> 'required',
            'hamil'=> 'required',
            'mens'=> 'required',
          ],[
            'kdcab' => 'kosong',
            'id_donor'=> 'kosong',
            'nodonor'=> 'kosong',
            'noaftp'=> 'kosong',
            'tglperiksa'=> 'kosong',
            'sehat'=> 'kosong',
            'sakit'=> 'kosong',
            'diabet'=> 'kosong',
            'ginjal'=> 'kosong',
            'radang'=> 'kosong',
            'jantung'=> 'kosong',
            'hemofilia'=> 'kosong',
            'asma'=> 'kosong',
            'tbc'=> 'kosong',
            'kenjang'=> 'kosong',
            'hiv'=> 'kosong',
            'hepatitis'=> 'kosong',
            'sifilis'=> 'kosong',
            'malaria'=> 'kosong',
            'luarngri'=> 'kosong',
            'hasilpriksa'=> 'kosong',
            'orglain'=> 'kosong',
            'bln'=> 'kosong',
            'hamil'=> 'kosong',
            'mens'=> 'kosong',
          ]);
          $ques = [ 
            'kdcab' => $request->kdcab,
            'id_donor'=> $request->id_donor,
            'nodonor'=> $request->nodonor,
            'noaftp'=> $request->noaftp,
            'tglperiksa'=> $tanggal,
            'sehat'=> $request->sehat,
            'sakit'=> $request->sakit,
            'diabet'=> $request->diabet,
            'ginjal'=> $request->ginjal,
            'radang'=> $request->radang,
            'jantung'=> $request->jantung,
            'hemofilia'=> $request->hemofilia,
            'asma'=> $request->asma,
            'tbc'=> $request->tbc,
            'kenjang'=> $request->kenjang,
            'hiv'=> $request->hiv,
            'hepatitis'=> $request->hepatitis,
            'sifilis'=> $request->sifilis,
            'malaria'=> $request->malaria,
            'luarngri'=> $request->luarngri,
            'hasilpriksa'=> $request->hasilpriksa,
            'orglain'=> $request->orglain,
            'hamil'=> $request->hamil,
            'mens'=> $request->mens,
            'bln'=> $request->bln,
           ];

        //   dd($ques);
          Quesioner::create($ques);
       
    
        return redirect()->back()->with('success', 'Berhasil Menambahkan Quesioner!');

        // dd($str);
    }





    public function store(Request $request) : RedirectResponse
    {
       
            $data = $request->validate([ 
            'kdcab'=>'required', 
            'nodonor'=>'required',
            'noaftap' => 'required',
            'namadonor'=>'required', 
            'tgllahir'=>'required',
            'tgldaftar'=>'required', 
            'jnsktg'=>'required',
            'umur'=>'required', 
            // 'jk'=>'required',
            // 'golrh'=>'required',
            'nmcab'=>'required',
            // 'sttskntong'=>'required',
            'donorke'=>'required',
            // 'skrin'=>'required',
            'noktp'=>'required',
            // 'tglperiksa'=>'required',
            'tensi'=>'required',
            'nadi'=>'required','suhu'=>'required',
            'brtbdn'=>'required','tgbdn'=>'required',
            'jnsktg'=>'required','typektg'=>'required',
            'ccambil'=>'required','ecg'=>'required',
            'tolak'=>'required',
            'alsntlk'=>'required',
            'ketperiksa'=>'required', 'nmptgdr'=>'required',
            'almt' => 'required','kdptgdr' => 'required',
            // 'getiddonor' => 'required'
          
          ]);
    
        //  if ($validator->fails()) {
        //     $errors = $validator->errors()->toArray(); // pastikan array

           $ldate = Carbon::now('Asia/Jakarta');
            // $userIds = $request->input('data');  

// dd($userIds);



            // var_dump($data);
       Periksadonor::create([
             'kdcab' => $data['kdcab'],
             'nodonor' => $data['nodonor'],
               'namadonor'  => $data['namadonor'],
               'tgllahir'  =>  $data['tgllahir'],
               'tgldaftar'  =>  $data['tgldaftar'],
               'jnsktg' => $data['jnsktg'],
               'tglperiksa' =>  $ldate,
               'tglaftap' => $ldate,
               'umur' => $data['umur'],
               'noaftap'  => $data['noaftap'],

            //    'jk' =>  $data['jk'],
            //    'golrh'  =>  $data['golrh'],
               'nmcab'  => $data['nmcab'],
               'donorke' =>  $data['donorke'],
            //    'skrin'  => $data['skrin'],
               'noktp'  => $data['noktp'],
               'tensi' => $data['tensi'],
               'nadi'  => $data['nadi'],
               'suhu'  => $data['suhu'],
               'brtbdn'  => $data['brtbdn'],
               'tgbdn'  => $data['tgbdn'],
               'jnsktg'  => $data['jnsktg'],
               'typektg'  =>  $data['typektg'],
               'ccambil'  => $data['ccambil'],
               'ecg'  => $data['ecg'],
               'tolak'  => $data['tolak'],
               'alsntlk'  => $data['alsntlk'],
               'ketperiksa'  => $data['ketperiksa'],
               'nmptgdr'  => $data['nmptgdr'],
               'kdptgdr'  => $data['kdptgdr'],
               'almt'  =>  $data['almt'],
            //    'getiddonor'  => $data['getiddonor'],
               'status'  => 'HB',
     
         ]);

        // }

            // ];
        //   $data1 = $validator->validated();
            // $data = new Periksadonor();
            // dd($data);

            // return response()->json(['success' => true]);
           
            // dd($lastid);
            // $notification = array(
            //     'message' => 'Berhasil Simpan',
            //     'alert-type' => 'success'
            // );
        
             return redirect()->back()->with('success', 'Berhasil diSimpan!');
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
    public function show($id)
    {
       
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {    
       
       $post = Quesioner::findOrFail($id);
        return view('pages.admin.periksadokter.edit', compact('post'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

       $request->validate([
            'kdcab' => 'required',
            'id_donor' => 'required',
            'nodonor' => 'required',
            'noaftp' => 'required',
            // 'tglperiksa' => 'required',
            'sehat' => 'required',
            'sakit' => 'required',
            'diabet' => 'required',
            'ginjal' => 'required',
            'radang' => 'required',
            'jantung' => 'required',
            'hemofilia' => 'required',
            'asma' => 'required',
            'tbc' => 'required',
            'kenjang' => 'required',
            'hiv' => 'required',
            'hepatitis' => 'required',
            'sifilis' => 'required',
            'malaria' => 'required',
            'luarngri' => 'required',
            'hasilpriksa' => 'required',
            'orglain' => 'required',
            'bln' => 'required',
            'hamil' => 'required',
            'mens' => 'required',

        ]);

        $id->update($request->all());
        // dd($id);


        return redirect()->back()->with('success', 'updated successfully.');
         

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $post = Quesioner::find($id);
        $post->delete();
        $request->session()->flash('message', 'Berhasil Menghapus Data');
        return redirect()->back();  
    }
}
