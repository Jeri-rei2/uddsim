<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Models\Antrian;

use App\Models\Donor;
use App\Models\Cabang;
use App\Models\Setnodonor;
use App\Models\Kelompok;
use App\Models\Pekerjaan;
use App\Models\Kewarganegaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\RedirectResponse;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;

// use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
  

class MDonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function deletepoto(Request $request)
    {
        $imagePath = public_path($request->input('imagePath'));

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return redirect()->route('camera.view')->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }
 
 public function ambilgambar(Request $request)
    {
        $imageData = $request->input('image');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageName = 'capture' . time() . '.png';
         $imagePath = public_path('captures/' . $imageName);

        // file_put_contents($imagePath, base64_decode($imageData));
        Storage::disk('public')->put("captures/{$imageName}", base64_decode($imageData));

        return response()->json(['status' => 'success', 'filename' => $imageName]);
    }

    public function index(Request $request)
    {

         $filter = Donor::paginate(10);
         $loket = Loket::all();
      
          

           $ambilaja = DB::table('donor')
            ->join('cabang', 'cabang.kdcab', '=', 'donor.kdcab')
            ->select('cabang.*', 'donor.*', 'cabang.kdcab as kdcab')
            ->get();
           $donor = DB::table('donor')
                    ->whereRaw('EXTRACT(DAY FROM created_at) = ?',  date('d') )
                    ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m') )
                    ->get();
            $items = Cabang::with('kelompok')->orderBy('id', 'DESC')->get();
            $kenegaraan = Kewarganegaraan::with('cabang')->orderBy('id', 'DESC')->get();
            $pekerjaan = Pekerjaan::with('cabang')->orderBy('id', 'DESC')->get();

             // nomor donor auto
            $randomNumber = mt_rand(100000, 999999);
            $orderNumber = Str::uuid();// Generates a unique UUID
            $orderNumber = 'T-' . date('y') . strtoupper(Str::random(6));
            $lastOrder = Donor::latest('id')->first(); // Get the latest order
            $orderNumber = 'T-' . date('y') . str_pad(($lastOrder ? $lastOrder->id + 1 : 1), 6, '0', STR_PAD_LEFT);
            $nodonor = new Donor();
            $nodonor = $orderNumber;


               // nomor aftp auto
               $random = mt_rand(100000, 999999);
               $order = Str::uuid();// Generates a unique UUID
               $order = 'A' . date('y') . date('m') . date('d') . strtoupper(Str::random(5));
               $lastaftp= Donor::latest('id')->first();// Get the latest order
               $random = 'A' . date('y') . date('m') . date('d')  . str_pad(($lastaftp ? $lastaftp->id + 1 : 1), 5, '0', STR_PAD_LEFT);
               $noaftp = new Donor();
               $noaftp = $random;
       


        return view('pages.admin.mdonor.index', [
        'items' => $items,'nodonor' => $nodonor,'noaftp' => $noaftp,
        'kenegaraan' => $kenegaraan,'pekerjaan'=> $pekerjaan,'donor'=> $donor,'filter' => $filter,'loket' => $loket,
    'ambilaja' => $ambilaja,
        ])->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function create()
    {
        return view('pages.admin.mdonor.create', [
            // 'Kelompok' => Kelompok::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
      
      
        
        $datas = $request->validate([ 
            'kdcab' => 'required',
            'nodonor' => 'required',
            'noaftp' => 'required',
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
            'agama' => 'required',
            'tlp' => 'required',
            'noktp' => 'required|max:16',
            'nosim' => 'required',
            'tgldaftar' => 'required',
            'donorke' => 'required',
            'mtdpeng' => 'required',
            'loket' => 'required',
            'photo' => 'required|string'
         ]);
      
        //    dd($validatedData );
    //    $filename = null;

        // Simpan foto jika ada
        if (strpos($datas['photo'], ',') !== false) {
            list($type, $imageData) = explode(';', $request->photo);
            list(, $imageData) = explode(',', $imageData);
            $imageData = base64_decode($imageData);

            $filename = time() . '.png';
            Storage::disk('public')->put('captures/' . $filename, $imageData);
        }
          $antrianNow = Antrian::whereRaw('EXTRACT(DAY FROM created_at) = ?', date('d') )
          ->whereRaw('EXTRACT(MONTH FROM created_at) = ?', date('m'))
          ->where('loket_id', $request->loket)
         ->orderBy('created_at', 'asc')
         ->get();


     if (count($antrianNow) > 0) {
         //jika antrian di tanggal sekarang datanya lebih dari 0
         //maka lanjutkan antrian sesuai nomber antrian
         //jika tidak ada maka mulai dari 1

         $no_antrian = count($antrianNow);
         // dd($no_antrian);
         $kode = '0';
         if (!$no_antrian == 0) {
             $no_antrian = $no_antrian + 1;
         }
         if ($no_antrian < 10) {
             $kode = 'D0';
         } else {
             $kode = '0';
         }
     } else {
         $no_antrian = 0;
         $kode = '0';
         if ($no_antrian == 0) {
             $no_antrian = $no_antrian + 1;
         }
         if ($no_antrian < 10) {
             $kode = '00';
         } else {
             $kode = '0';
         }
     }

             // nomor donor auto
            $randomNumber = mt_rand(100000, 999999);
            $orderNumber = Str::uuid();// Generates a unique UUID
            $orderNumber = 'T-' . date('y') . strtoupper(Str::random(6));
            $lastOrder = Donor::latest('id')->first(); // Get the latest order
            $orderNumber = 'T-' . date('y') . str_pad(($lastOrder ? $lastOrder->id + 1 : 1), 6, '0', STR_PAD_LEFT);
            $nodonor = new Donor();
            $nodonor = $orderNumber;
          $randomNumber = mt_rand(100000, 999999);
          $orderNumber = Str::uuid();// Generates a unique UUID
          $orderNumber = 'T-' . date('y') . strtoupper(Str::random(6));
          $lastOrder = Donor::latest('id')->first();// Get the latest order
          $orderNumber = 'T-' . date('y') . str_pad(($lastOrder ? $lastOrder->id : 1), 6, '0', STR_PAD_LEFT);
        
          $nodonor = new Donor();
          $nodonor = $orderNumber;
          $getid = Donor::orderBy('id')->first();
        


       $tampil =  Donor::create([
            'kdcab' => $datas['kdcab'],
            'nodonor' =>  $datas['nodonor'],
            'noaftp' => $datas['noaftp'],
            'namadonor' => $datas['namadonor'],
            'alamat' => $datas['alamat'],
            'kodepos' => $datas['kodepos'],
            'jk' => $datas['jk'],
            'kdneg' => $datas['kdneg'],
            'tgllahir' => $datas['tgllahir'],
            'usia' => $datas['usia'],
            'kelurahan' => $datas['kelurahan'],
            'kecamatan' => $datas['kecamatan'],
            'nmwil' => $datas['nmwil'],
            'nmpkrj' => $datas['nmpkrj'],
            'agama' => $datas['agama'],
            'tlp' => $datas['tlp'],
            'noktp' => $datas['noktp'],
            'nosim' => $datas['nosim'],
            'tgldaftar' => $datas['tgldaftar'],
            'donorke' => $datas['donorke'],
            'mtdpeng' => $datas['mtdpeng'],
            'loket' => $datas['loket'],
            'photo' => $filename,
       ]);
    //    dd($tampil);
          // nomor donor auto
        $data = [
                'loket_id' => $request->loket,
                'nomor' => $kode . $no_antrian,
                'id_donor' => $tampil['nodonor'],
                'namadonor' => $tampil['namadonor'],
                'ruang' => '2',
                'tujuan' => 'dokter'

            ];
 
          $setdonor = [
            'nomor' => $tampil['nodonor'],
            'kdcab' => '002',
          ];
         Setnodonor::create($setdonor);
          

    
      
  
     // dd($data);

     Antrian::create($data);
    

     return redirect()->back()->with('success', 'Berhasil didaftarkan!');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor,$id)
    {
        //return response

        $getdata = Donor::find($id);
       
    if (!$getdata) {
        return response()->json(['photo' => null], 404);
    }

    // Misalnya field 'photo' menyimpan nama file, seperti 'foto123.jpg'
    $photoPath = $getdata->photo ? asset('storage/captures/' . $getdata->photo) : null;
        return response()->json(
             ['photo' => $photoPath,
              'getdata' => $getdata,
             ]);
       
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
    function cetakbarcode($id)
    {
            return view('pages.admin.mdonor.cetakbarcode',[
                'barcode' =>Donor::find($id),
            ]);
    }

    function cetakkartu($id)
    {
        return view('pages.admin.mdonor.cetak', [
            'cetak' => Donor::find($id),
            // dd('cetak'),
        ]);
    }

    function cetakform($id)
    {
        
    
        $getdata = Donor::find($id);
     

        return view('pages.admin.mdonor.cetakpendaftaran',[
            'donor' =>Donor::find($id),
            'antri' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('id_donor', $id)
            ->orderBy('created_at', 'asc')
            ->get(),
            'qrcode' => QrCode::size(54)->generate($getdata->noaftp),
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
        // $notification = array(
        //     'message' => 'Berhasil Ubah Pedonor',
        //     'alert-type' => 'success'
        // );
    
               return redirect()->back()->with('success', 'Berhasil Di Ubah!');

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
