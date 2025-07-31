<?php


use App\Models\Antrian;
use App\Models\Loket;
use App\Models\Donor;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MDonorController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\TransaksiDonorController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\PemeriksaanHBController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\FrondEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SerologiController;
use App\Http\Controllers\MesinAlinitysysController;
use App\Http\Controllers\LitBanGController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentsImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Haruncpi\LaravelIdGenerator\IdGenerator;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [FrondEndController::class, 'index'])->name('fe.index');

// Route::get('/cart', [FrondEndController::class, 'cart'])->name('fe.cart');

// Route::post('/cart', [FrondEndController::class, 'addCart'])->name('fe.add-cart');

// Route::get('/pesanan', [FrondEndController::class, 'pesanan'])->name('fe.pesanan');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/profil', [FrondEndController::class, 'profile'])->name('fe.profil');

// Route::get('/pesanan/invoice/{pesanan}', [FrondEndController::class, 'invoice'])->name('fe.pesanan.invoice');


Route::match(['put', 'patch'], 'profil/{user}', [FrondEndController::class, 'updateProfil'])->name('fe.profil.update');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('profile', ProfileController::class);

Route::post('/profile/reset-password', [ProfileController::class, 'reset'])->name('profile.reset');

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::get('/', [HomeController::class, 'index'])->name('fe.index');

Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('mdonor', [MDonorController::class, 'index'])->name('user.mdonor.index');

// Route::post('/upload-camera', [MDonorController::class, 'ambilgambar']);
Route::post('/photo/upload', [MDonorController::class, 'ambilgambar'])->name('photo.upload');
// Route::post('/screenshot/upload', [MDonorController::class, 'ambilgambar'])->name('screenshot.upload');

     Route::get('periksahb', [PemeriksaanHBController::class, 'index'])->name('user.periksahb.index');
    Route::get('perisadokter', [PemeriksaanDokterController::class, 'index'])->name('user.perisadokter.index');
    Route::get('perisadokter', [PemeriksaanDokterController::class, 'pagin'])->name('pagin');
    Route::get('permintaan', [PermintaanController::class, 'index'])->name('user.permintaan.index');
    Route::post('/scan/kantong', [TransaksiDonorController::class, 'scankantong'])->name('user.scankantong');
    Route::post('/minta/tempord', [TransaksiDonorController::class, 'pushtemporary'])->name('push.temp');
    Route::get('permintaan_kantong', [TransaksiDonorController::class, 'permintaan'])->name('user.permintaan.kantong');
    Route::get('transaksidonor', [TransaksiDonorController::class, 'index'])->name('user.transaksidonor.index');

    Route::get('/cetak/pengiriman/{id}', [GudangController::class, 'cetakpengiriman'])->name('pengiriman.cetak');

   Route::get('/barcode/generate/{kode}', [GudangController::class, 'generateBarcode']);
    Route::get('/barcodes', [GudangController::class, 'index']);
    Route::get('/Gudang/br', [GudangController::class, 'index'])->name('user.br');
    Route::get('/pengeluaran/gudang', [GudangController::class, 'pengeluaran'])->name('user.gudang');
    Route::get('/stok/gudang', [GudangController::class, 'indexstok'])->name('user.stok.gudang');
    Route::post('/scan/search', [GudangController::class, 'search'])->name('scan.data');
    Route::post('/scan/save', [GudangController::class, 'save'])->name('scan.save');
    Route::post('/barcode/generate', [GudangController::class, 'generate'])->name('barcode.generate');
    Route::post('/barcode/storetmp', [GudangController::class, 'storeTemporary'])->name('barcode.temp');
  
    Route::post('/generate/temp', [GudangController::class, 'store'])->name('generate.store');

    Route::get('/br/gudang',[GudangController::class, 'brgudang'])->name('brgudang');

    // Route::post('', [PemeriksaanDokterController::class, 'next'])->name('perisadokter.next');
    Route::resource('Gudang', GudangController::class);


});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {

    Route::get('home', [HomeController::class, 'adminHome'])->name('admin.home');



    Route::get('mdonor', [MDonorController::class, 'index'])->name('mdonor.index');
    Route::post('/upload-photo', [MDonorController::class, 'ambilfoto'])->name('upload-photo');


    Route::get('serologi', [SerologiController::class, 'index'])->name('sero.index');
    Route::get('mesin', [MesinAlinitysysController::class, 'index'])->name('mesin.index');


    Route::get('litbang', [LitBanGController::class, 'index'])->name('goldarulang.index');
    Route::post('/scan/litbang', [LitBanGController::class, 'cariktg'])->name('cariktgdrh');
    Route::post('/search/litbang', [LitBanGController::class, 'resultdata'])->name('search.ptgs');
    Route::post('/ktg-rusak/litbang', [LitBanGController::class, 'saveawal'])->name('saveawal');
    Route::get('/cari/datainput', [LitBanGController::class, 'getData'])->name('datainput');


    Route::get('kirim', [PengirimanController::class, 'index'])->name('kirim.index');
    Route::get('kirim/ctkkirim', [PengirimanController::class, 'cetak'])->name('ctkkirim');
    Route::post('kirim/import', [PengirimanController::class, 'import'])->name('kirim.import');
    Route::post('kirim/export', [PengirimanController::class, 'export'])->name('kirim.export');
    Route::get('qrcode/{id}', [PengirimanController::class, 'generate'])->name('generate');
    Route::get('/cari', [PengirimanController::class, 'cari']);
    Route::get('/kirim/cetak_pdf', [PengirimanController::class, 'cetak_pdf'])->name('cetakpdf');
    


    Route::get('/laporan/aftap-stok', [LaporanController::class, 'laporanaftap'])->name('laporan.aftap');
    Route::get('/laporan/cari', [LaporanController::class, 'search'])->name('search.data');
    Route::get('/cetak/all', [LaporanController::class, 'cetakall'])->name('cetak-all');


    Route::get('/penyisihan/ktg', [TransaksiDonorController::class, 'penyisihan'])->name('penyisihan');
    Route::post('/scan/ktg-rusak', [TransaksiDonorController::class, 'cariktgrusak'])->name('cariktgrusak');
    Route::post('/ktg-rusak/saverusak', [TransaksiDonorController::class, 'saverusak'])->name('saverusak');
    Route::get('view/datasisih', [TransaksiDonorController::class, 'datasisih'])->name('datasisih');
    Route::put('/ubah/{id}', [TransaksiDonorController::class, 'ubahdata'])->name('data.update');
    Route::delete('/hapus/{id}', [TransaksiDonorController::class, 'hapusrusak'])->name('hapusrusak');
    Route::get('/filter-datasisih', [TransaksiDonorController::class, 'laporan'])->name('datasisih.cetak');
    Route::post('/proses-cetak', [TransaksiDonorController::class, 'prosesCetak'])->name('data.prosesCetak');


    Route::get('/pengembalian/ktgmu', [TransaksiDonorController::class, 'pengembalian'])->name('balikmu');
    Route::post('/scan/ktg-kembali', [TransaksiDonorController::class, 'cariktgkembali'])->name('scan.balik');
    Route::post('/ktg-kembali/savekembali', [TransaksiDonorController::class, 'savekembali'])->name('savekembali');
    Route::get('view/datakembali', [TransaksiDonorController::class, 'datakembali'])->name('datakembali');
    Route::get('/cetak-kembali/{id}', [TransaksiDonorController::class, 'cetakkembali'])->name('cetakkembali');


    Route::get('/pengeluaran/mu', [TransaksiDonorController::class, 'pengeluaranmu'])->name('mu');
    Route::get('/cari-asaldrh', [TransaksiDonorController::class, 'cariasldrh'])->name('search');
    Route::get('/cari-mu', [TransaksiDonorController::class, 'carimu'])->name('searchmu');
    Route::post('/scan/ktg-keluar', [TransaksiDonorController::class, 'cariktgkeluar'])->name('scan.keluar');
    Route::post('/ktg-keluar/sv', [TransaksiDonorController::class, 'sv'])->name('sv');
    Route::get('view/datakeluar', [TransaksiDonorController::class, 'datakeluar'])->name('lihatdtkeluar');
    Route::get('/cetak-keluarktg/{id}', [TransaksiDonorController::class, 'cetakkeluarktg'])->name('cetakkeluarktg');
    Route::delete('/hapuskeluar/{id}', [TransaksiDonorController::class, 'hapukeluar'])->name('hapukeluar');



    Route::get('/laporan/cetak', [TransaksiDonorController::class, 'cetaklaporan'])->name('laporan.cetak');
    Route::post('/terima/save', [TransaksiDonorController::class, 'saveterima'])->name('terima.save');
    Route::post('/penerimaan/search', [TransaksiDonorController::class, 'searchpenerimaan'])->name('scan.terima');
    Route::get('/aftap/penerimaan', [TransaksiDonorController::class, 'penerimaan'])->name('penerimaan');
    Route::get('/cetak/permintaan/{id}', [TransaksiDonorController::class, 'cetakprmintaan'])->name('permintaan.cetak');
    Route::post('/minta/tempord', [TransaksiDonorController::class, 'pushtemporary'])->name('push.temp');
    Route::get('permintaan_kantong', [TransaksiDonorController::class, 'permintaan'])->name('permintaan.kantong');
    Route::get('transaksidonor', [TransaksiDonorController::class, 'index'])->name('transaksidonor.index');
    Route::get('pengiriman/ffp', [TransaksiDonorController::class, 'indexffp'])->name('ffp.index');
    Route::get('view/ffp', [TransaksiDonorController::class, 'viewdata'])->name('view.index');
    Route::post('/ffp/save', [TransaksiDonorController::class, 'savefpd'])->name('kirimbos');
    Route::post('/scan/ffp', [TransaksiDonorController::class, 'cariktgffp'])->name('scan.ffp');
    Route::post('/ffp/saveheader', [TransaksiDonorController::class, 'saveheader'])->name('saveh');


    Route::get('/cetak-fpd/{id}', [TransaksiDonorController::class, 'cetakFpd'])->name('cetakFpd');

    Route::get('/data/dataaftp', [TransaksiDonorController::class, 'reload'])->name('data.reload');
    Route::post('/search/nodaftar', [TransaksiDonorController::class, 'scanknodaftar'])->name('cari.nodaftar');
    Route::post('/transdnr/save', [TransaksiDonorController::class, 'savetransdnr'])->name('svtransdnr');





    Route::get('Gudang', [GudangController::class, 'index'])->name('Gudang.index');
    Route::get('/cetak/pengiriman/{id}', [GudangController::class, 'cetakpengiriman'])->name('pengiriman.cetak');


    Route::get('periksahb', [PemeriksaanHBController::class, 'index'])->name('periksahb.index');
    Route::get('perisadokter', [PemeriksaanDokterController::class, 'index'])->name('perisadokter.index');
    Route::get('perisadokter', [PemeriksaanDokterController::class, 'pagin'])->name('pagin');
    Route::post('/simpan-data', [PemeriksaanDokterController::class, 'store'])->name('simpan.data');

    Route::get('permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/dashboard/antrian', [AntrianController::class, 'index'])->name('dashboard.antrian');


    Route::get('/dashboard/antrianhb', [AntrianController::class, 'indexhb'])->name('listantrianhb');
    Route::get('/antrian/panggil/hb', [AntrianController::class, 'panggilhb'])->name('antri.panggil.hb');  


    Route::get('/antrian/panggil', [AntrianController::class, 'panggil'])->name('antri.panggil');  
    Route::post('antrian/next/hb', [AntrianController::class, 'lanjuthb'])->name('nexthb');

    Route::get('/dashboard/antrian/{loket}', [AntrianController::class, 'getLoketId']);
    Route::get('/dashboard/antrian/{id}/{tipe}', [AntrianController::class, 'getRowId']);  
 
    Route::post('antrian/next', [AntrianController::class, 'lanjut'])->name('antrian.next');

    Route::get('/list/antrian', function () {
        return view('pages.antrian.plasma', [
            'loket1' => DB::table('antrians')
                // ->join('lokets', 'lokets.nama_loket', '=', 'antrians.antrians')
                // ->select('antrians.*','lokets.*')
                ->where('status', 'menunggu')
                ->where('ruang', '2')
                ->orderBy('created_at', 'asc')
                ->first(),
            'loket2' => DB::table('antrians')
                // ->where('status', 'dipanggil')
                ->where('ruang', 1)
                ->orderBy('created_at', 'asc')
                ->first()
        ]);
    })->name('list.antrian');
    Route::post('/donors', [MDonorController::class, 'store'])->name('form.store');
Route::post('/camera/capture', [MDonorController::class, 'ambilgambar'])->name('camera.get');
Route::post('/photo/delete', [MDonorController::class, 'deletepoto'])->name('photo.delete');
    Route::get('/form-daftar/{id}',[MDonorController::class, 'cetakform'] )->name('formdaftar');
    Route::get('/barcode/donor/{id}',[MDonorController::class, 'cetakbarcode'])->name('barcodedonor');
    Route::get('/detail/cetak/{id}',[MDonorController::class, 'cetakkartu'])->name('cetakdonor');
    
    Route::get('/loket-antrian/dokter', function () {
        return view('pages.antrian.cetak_antrian_dokter', [
            'loket' => DB::table('antrians')
            ->where('loket_id', 1)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get(),
        ]);
    })->name('loket.antriandokter');
    Route::get('send-email-pdf', [PemeriksaanDokterController::class, 'sendmail'])->name('send-email-pdf');
    Route::get('/loket-antrian', function () {
        return view('pages.antrian.dashboard', [
            'loket1' => DB::table('antrians')
            ->where('loket_id', 2)
            ->where('status', 'dipanggil')
            ->orderBy('created_at', 'asc')
            ->first(),
        'loket2' => DB::table('antrians')
            ->where('status', 'dipanggil')
            ->where('loket_id', 2)
            ->orderBy('created_at', 'asc')
            ->first()
        ]);
    })->name('loket.antrian');
    Route::get('/antrian-mandiri', function () {
        return view('pages.antrian.dashboard_antrian', [
            'loket1' => Antrian::whereRaw('day(created_at) = ' . date('d') . ' and month(created_at) = ' . date('m') . ' and year(created_at) = ' . date('Y'))
            ->where('loket_id', 2)
            ->where('id_donor', 1)
            ->orderBy('created_at', 'asc')
            ->get(),
     
        ]);
    })->name('antrian.mandiri');
    Route::get('/antrian/periksa_hemoglobin', [AntrianController::class, 'cetakHB'])->name('antrian.hb');
    Route::post('/antrian/periksa_dokter', [AntrianController::class, 'cetakdokter'])->name('antrian.dokter');

    Route::post('/pedonor/quesioner', [PemeriksaanDokterController::class, 'quesioner'])->name('quesioner');
    Route::get('/dataquest', [PemeriksaanDokterController::class, 'idxquest'])->name('quest.get');
    Route::get('/periksadokter/{id}', [PemeriksaanDokterController::class, 'edit'])->name('show.edit');
    Route::put('/periksadokter/{id}', [PemeriksaanDokterController::class, 'update'])->name('show.update');
   Route::delete('/quest/{id}', [PemeriksaanDokterController::class, 'destroy'])->name('quest.destroy');



// Route untuk generate barcode image
    Route::get('/barcode/generate/{kode}', [GudangController::class, 'generateBarcode']);
    Route::get('/barcodes', [GudangController::class, 'index']);
    Route::get('/pengeluaran/gudang', [GudangController::class, 'pengeluaran'])->name('pengeluaran.gudang');
    Route::get('/stok/gudang', [GudangController::class, 'indexstok'])->name('stok.gudang');
    Route::post('/scan/search', [GudangController::class, 'search'])->name('scan.data');

    Route::post('/scan/save', [GudangController::class, 'save'])->name('scan.save');
    Route::post('/barcode/generate', [GudangController::class, 'generate'])->name('barcode.generate');
    Route::post('/barcode/storetmp', [GudangController::class, 'storeTemporary'])->name('barcode.temp');
  
    Route::post('/generate/temp', [GudangController::class, 'store'])->name('generate.store');

    Route::get('/br/gudang',[GudangController::class, 'brgudang'])->name('brgudang');
    Route::get('/search-data', [GudangController::class, 'searchminta'])->name('data.search');
    Route::post('/produk/update-status', [GudangController::class, 'updateStatus'])->name('gd.updateStatus');
    Route::post('/scan/pengiriman', [GudangController::class, 'carikantong'])->name('scan.kirim');
    Route::post('/pengiriman/save', [GudangController::class, 'savedonk'])->name('savedonk');
    
    // Route::post('', [PemeriksaanDokterController::class, 'next'])->name('perisadokter.next');
    Route::resource('Gudang', GudangController::class);

    Route::resource('transaksidonor', TransaksiDonorController::class);
    Route::resource('periksahb', PemeriksaanHBController::class);
    Route::resource('perisadokter', PemeriksaanDokterController::class);

    Route::resource('kirim', PengirimanController::class);

    Route::resource('permintaan', PermintaanController::class);


    Route::resource('mdonor', MDonorController::class);
    Route::resource('supplier', SupplierController::class);

    Route::resource('cabang', CabangController::class);
    Route::resource('darah', AsalDarahController::class);
    
    Route::resource('pekerjaan', PekerjaanController::class);
    Route::resource('wilayah', WilayahController::class);


    Route::resource('ketegori', KategoriController::class);

    Route::resource('kelompok', KelompokController::class);

    /* LAPORAN */
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:pimpinan'])->prefix('pimpinan')->group(function () {

    Route::get('/home', [HomeController::class, 'pimpinanHome'])->name('pimpinan.home');

 

});
