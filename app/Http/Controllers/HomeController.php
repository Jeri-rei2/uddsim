<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Barang;
use App\Models\DetailOrder;
use App\Models\Kelompok;
use App\Models\Pesanan;
use App\Models\Dokter;
use App\Models\Keluhan;
use DB;
use App\Models\Resep;
use App\Models\BayarResep;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(): View
    {



      $items = Barang::orderBy('created_at', 'DESC');
        if (request('katalog')) {
            if (request('katalog') == 'Kasur') {
                $items->where('kategori_id', 1);
            } else {
                $items->where('kategori_id', 2);
            }
        }
        if (request('keyword')) {
            $items->where('nama', 'like', '%' . request('keyword') . '%');
        }
        if (Auth::check()) {
            $data = [
                'barang' => Barang::count(),
                'bayar' => Pembayaran::count(),
                'terjual' => DetailOrder::count(),
                'transaksi' => Pesanan::count(),
                'pengguna' => User::where('type', 0)->count(),
            ];
            $users = User::where('department_id', 2)->get();
            return view('pages.user.dashboard',compact('data', 'users'));
        } else {
            return view('pages.user.dashboard', [
                'items' => $items->get(),
                'katalog' => Kategori::all(),
                'user_id' => null

            ]);
        }
    }
    public function resepmasuk()
    {
        return view('pages.user.resepmasuk', [
            'masuk' => Resep::orderBy('id', 'asc')->get(),
            'data' => Pesanan::with('user', 'barang', 'detailOrders')
                    ->join('resep','resep.pesanan_id', '=','pesanan.id')
                    ->where('resep.user_id', Auth::user()->id)
                    ->orderBy('pesanan.id', 'DESC')
                    ->get(),

        ]);
    }
    
    public function berhasilbayarobat(Pembayaran $pembayaran, Request $request)
    {
        $resepkan = Resep::orderBy('id', 'DESC')->first();
        $resepkan = $resepkan;
       
            if (Auth::check()) {
                return view('pages.payobatsucces', [
                    'order' => Resep::with('obat')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('id', 'DESC')
                        ->get(),

                    
                ]);
                        
            } else {
                return redirect()->route('login');
            }

        
    }
    public function invoiceobat()
    {
            
        if (Auth::check()) {
            return view('pages.user.obat.invoice', [
              
                'barang' => Resep::orderBy('id', 'asc')->limit(1)->get(),
                'pay' => DB::table('payments')
                ->whereIn('user_id', [Auth::user()->id])
                ->get(), 
                 'obat' => DB::table('resep')
                   ->whereIn('user_id', [Auth::user()->id])
                   ->get(), 
             ]);
             dd($id); 
        } else {
            return redirect()->route('login');
        }
            
     
    }
    public function bayarobat(Request $request)
    {

        $resep = Resep::where('resep.user_id', Auth::user()->id)
        ->orderBy('resep.user_id', 'DESC')
        ->get();
        $userbayar = Resep::orderBy('user_id', 'asc')->limit(1)->get();
        $dokter = Resep::orderBy('user_id', 'asc')->limit(1)->get();
        // $pesanan_id = Resep::orderBy('pesanan_id', 'asc')->limit(1)->get('pesanan_id');

        
        $harga = Resep::with('obat',)
        ->join('masterobat','masterobat.kode_brng', '=','resep.kode_brng')
        ->where('resep.user_id', Auth::user()->id)
        ->orderBy('resep.user_id', 'DESC')
        ->sum('ralan');
        
        
        $user_id = Auth::user()->id;
    
        $resepkan = Resep::orderBy('id', 'DESC')->first();
        $resepkan = $resepkan;

           $hargaobat = Resep::with('obat',)
           ->join('masterobat','masterobat.kode_brng', '=','resep.kode_brng')
           ->where('resep.user_id', Auth::user()->id)
           ->orderBy('resep.user_id', 'DESC')
           ->sum('masterobat.ralan');
           $total = $hargaobat;

          

             // // Set your Merchant Server Key
             \Midtrans\Config::$serverKey = config('midtrans.server_key');
             // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
             \Midtrans\Config::$isProduction = false;
             // Set sanitization on (default)
             \Midtrans\Config::$isSanitized = true;
             // Set 3DS transaction for credit card to true
             \Midtrans\Config::$is3ds = true;

            
             $obat = Obat::where('id', 'DESC')->first();
            
             $params = array(
                 'transaction_details' => array(
                     'order_id' => rand(),
                     'gross_amount' => $total,
                 ),
                 'customer_details' => array(
                     'user_id' => Auth::user()->id,
                     'pasien' => Auth::user()->name,
                     'email' => Auth::user()->email,
                     'total_harga' => $total,
                     'status_bayar' => 'Lunas',
 
                 ),
             ); 
            
     
        $request->request->add([
            'status' => 'Lunas',           
            'total_harga' => $total,
            ]);
        $bayar = BayarResep::create($request->all());
 
             $snapToken = \Midtrans\Snap::getSnapToken($params);
             $bayar->snap_token = $snapToken;
             $bayar->save();
            //  dd($request);
            Resep::where('user_id', Auth::user()->id)->update([
                'total_harga' =>  $total,
                'status_bayar' => 'Lunas',
                'snap_token'  => $snapToken,
            ]);



             return view ('pages.user.obat.bayar',compact('resep','userbayar','bayar','dokter','harga','snapToken','total','resepkan'));
      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        $barang = Barang::all();
        $stock = 0;
        for ($i = 0; $i < count($barang); $i++) {
            $stock += $barang[$i]->in_stock;
        }

        $pesanan = Pesanan::where('status', 'Selesai')->get();
        $pemasukan = 0;
        for ($i = 0; $i < count($pesanan); $i++) {
            $pemasukan += $pesanan[$i]->total_harga;
        }
        // dd($stock);
        $data = [
            'barang' => Barang::count(),
            'kelompok' => Kelompok::count(),
            'terjual' => DetailOrder::count(),
            'stock' => $stock,
            'transaksi' => Pesanan::count(),
            'pengguna' => User::where('type', 0)->count(),
            'pemasukan' => $pemasukan
        ];
        return view('pages.admin.index', compact('data'));
    }
    public function kirimorder()
    {
        if (Auth::check()) {
            return view('pages.user.cart', [
                'user_id' => Auth::user()->id
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    public function addorder(Request $request)
    {

        $barang_id = $request->barang_id;
        $barang_id = str_replace(",", " ", $barang_id[0]);
        $arrBarang_id = explode(" ", $barang_id);

        $quantity = $request->quantity;
        $quantity = str_replace(",", " ", $quantity[0]);
        $arrQuantity = explode(" ", $quantity);

        $harga = $request->harga;
        $harga = str_replace(",", " ", $harga[0]);
        $arrHarga = explode(" ", $harga);
        $barang = Barang::where('id', $arrBarang_id)->first();
        

        $request->request->add([
            'order_id' => $request->order_id,
            'status' => 'Sudah Dibayar',
            'keluhan' => $request->keluhan,
            'name' => $barang->nama,

            'user_id' => Auth::user()->id ]);
        $order = Pesanan::create($request->all());

        $pesanan = Pesanan::orderBy('id', 'DESC')->first();
        $grand = $pesanan;
        
        $arr_harga = [];
        $arr_keluhan = [];

        if (count($arrBarang_id) > 0) {
            // for ($i = 0; $i < $arrBarang_id; $i++) {
            foreach ($arrBarang_id as $key => $item) {
                $arr_harga[] = $arrHarga[$key] * $arrQuantity[$key];
                $barang = Barang::where('id', $arrBarang_id[$key])->first();
                $hrgbrg = $barang;

                // dd($barang);
                $data = array(
                    'pesanan_id' => $pesanan->id,
                    'order_id' => $request->order_id,
                    'barang_id' => $arrBarang_id[$key],
                    'harga' => $arrHarga[$key] * $arrQuantity[$key],
                    'jumlah' => $arrQuantity[$key],

                );
              
                $total_harga = array_sum($arr_harga);
            Pesanan::where('order_id', $request->order_id)->update(['total_harga' => $total_harga]);
            // // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $hrgbrg->harga,
                ),
                'customer_details' => array(
                    'name' => Auth::user()->name,
                    'keluhan' => $request->keluhan,
                    'order_id' => $request->order_id,
                    'email' => Auth::user()->email,

                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $order->snap_token = $snapToken;
            $order->save();
            // dd($params);
          
            
          
                // dd($request);
                DetailOrder::create($data);

                Barang::where('id', $arrBarang_id[$key])->update([
                    'in_stock' => ($barang->in_stock - $arrQuantity[$key]),
                    'sell_stock' => $barang->sell_stock + $arrQuantity[$key],
                ]);
                
               
            }
            
            $dokter = Dokter::orderBy('kd_dokter', 'asc')->limit(1)->get();

           
            return view('pages.user.detailorder',compact('snapToken','order','hrgbrg','grand','dokter'));
                // return view('pages.user.pesanan', [
                //     'snapToken' => $snapToken->get(),
                //     'pesanan' => Pesanan::all(),
                //     'user_id' => Auth::user()->id
                // ]);
        }


        // return redirect()->route('pesanan')->with('message', 'Berhasil Membuat Pesanan, Segera Untuk Melakukan Pembayaran');
       
    }
    

    public function pesanan(Pesanan $pesanan)
    {
        if (Auth::check()) {
            return view('pages.user.pesanan', [
                'orders' => Pesanan::with('user', 'barang', 'detailOrders')
                    ->join('payments','payments.pesanan_id', '=','pesanan.id')
                    ->where('pesanan.user_id', Auth::user()->id)
                    ->orderBy('pesanan.id', 'DESC')
                    ->get(),
                    
                    
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    public function invoice(Pesanan $pesanan)
    {
        if (Auth::check()) {
            return view('pages.user.pesanan.invoice.index', [
                'pesanan' => $pesanan,
                 'barang' => Barang::orderBy('id', 'asc')->limit(1)->get(),
                 'pay' => DB::table('payments')
                 ->whereIn('pesanan_id', [$pesanan->id])
                 ->get(), 
                  'area' => DB::table('pesanan')
                    ->whereIn('order_id', [$pesanan->order_id])
                    ->get(), 
                

            ]);
            dd($users); 
        } else {
            return redirect()->route('login');
        }
       
    }
    public function history()
    {

        return view('pages.user.history.index', [  
            'orders' => Pesanan::with('user', 'barang', 'detailOrders')->where('status', 'Sudah Diperiksa')->orderBy('id', 'DESC')->get(),
            'data' => Pembayaran::with('user', )->where('history', 'Selesai')->orderBy('id', 'DESC')->get(),
            'resep' => Resep::with('user', )->where('status_bayar', 'Lunas')->orderBy('id', 'DESC')->get(),


            
        ]);
    }



    public function success(Pembayaran $pembayaran, Request $request)
    {
        $pesanan = Pesanan::orderBy('id', 'DESC')->first();
        $grand = $pesanan;
        $data = array(
            'pesanan_id' => $grand->id,
            'status' => 'Sudah Dibayar',
            'history' => 'Selesai',
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'tlp' => Auth::user()->phone_number,

        );

    
    
        $data1 = Pembayaran::create($data);
        // $data2 = Pesanan::where('order_id', $request->order_id)->update([
        //     'status' => 'Sudah Dibayar',
        // ]);

        // dd($data2);
       
            if (Auth::check()) {
                return view('pages.paysuccess', [
                    'order' => Pesanan::with('user', 'barang', 'detailOrders')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('id', 'DESC')
                        ->get(),

                    
                ]);
                        
            } else {
                return redirect()->route('login');
            }

            // if ($request->type == 'Cash') {
            //     Pembayaran::create($cash);
            // } else {
            //     Pembayaran::create($transfer);
            // }
            

            // return redirect()->route('pages.paysuccess')->with('message', 'Pembayaran Berhasil');

        
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pimpinanHome(): View
    {
        $barang = Barang::all();
        $stock = 0;
        for ($i = 0; $i < count($barang); $i++) {
            $stock += $barang[$i]->in_stock;
        }

        $pesanan = Pesanan::where('status', 'Selesai')->get();
        $pemasukan = 0;
        for ($i = 0; $i < count($pesanan); $i++) {
            $pemasukan += $pesanan[$i]->total_harga;
        }
        // dd($stock);
        $data = [
            'barang' => Barang::count(),
            'kategori' => Kategori::count(),
            'terjual' => Resep::count(),
            'stock' => $stock,
            'transaksi' => Pesanan::count(),
            'pengguna' => User::where('type', 0)->count(),
            'pemasukan' => $pemasukan
        ];
        return view('pages.pimpinan.index', compact('data'));
    }
    public function createumum()
    {
    
        $items = Barang::orderBy('created_at', 'DESC');
        if (request('katalog')) {
            if (request('katalog') == 'Kasur') {
                $items->where('kategori_id', 1);
            } else {
                $items->where('kategori_id', 2);
            }
        }
        if (request('keyword')) {
            $items->where('nama', 'like', '%' . request('keyword') . '%');
        }
        if (Auth::check()) {
            return view('pages.user.homecare.dokter.periksa.create', [
                'items' => $items->get(),
                'katalog' => Kategori::all(),
                'user_id' => Auth::user()->id
            ]);
        } else {
            return view('pages.user.homecare.dokter.periksa.create', [
                'items' => $items->get(),
                'katalog' => Kategori::all(),
                'user_id' => null

            ]);
        }
       
    }
    public function layanan()
    {
        //
        return view('pages.user.homecare.dokter.index');
    }
    public function daftardokter()
    {
        //
        return view('pages.user.homecare.dokter.daftardokter');
    }
    public function periksa(){
        return view('pages.user.homecare.dokter.periksa.index');
    }
    public function jadwal(){
        return view('pages.user.homecare.jadwal.index');
    }
    public function anak(){
        return view('pages.user.homecare.jadwal.poli.anak.index');

    }
    public function int(){
        return view('pages.user.homecare.jadwal.poli.int.index');
    }
   
}
