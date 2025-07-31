<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use App\Models\JnsBrng;
use App\Models\JnsKtng;
use App\Models\Ukurancc;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('pages.admin.barang.index', [
            'items' => Barang::with('kelompok')->orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.barang.create', [
            'Kelompok' => Kelompok::all(),
            'jnsbarang' => JnsBrng::all(),
            'jnsKtng'  => JnsKtng::all(),
            'ukurancc'  => Ukurancc::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        
        $data = [
            'kdbrg' => $request->kdbrg,
            'nmbrg'  => $request->nmbrg,
            'brdragen' => $request->brdragen,
            'satuanbsr'  => $request->satuanbsr,
            'satuankcl'  => $request->satuankcl,
            'hrsat'  => $request->hrsat,
            'stok'  => $request->stok,
            'stokmin'  => $request->stokmin,
            'stokawal'  => $request->stok,
            'jnsbrg'  => $request->jnsbrg,
            'stoktambah'  => $request->stoktambah,
            'jnskantong'  => $request->jnskantong,
            'ukuran'  => $request->ukuran,
            'kodekelompok'  => $request->kodekelompok,
            

        ];
        Barang::create($data);
        // dd($data);
        return redirect()->route('barang.index')->with('message', 'Berhasil Menambahkan Barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('pages.admin.barang.detail', [
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('pages.admin.barang.edit', [
            'barang' => $barang,
            'categories' => Barang::all(),
            'Kelompok' => Kelompok::all(),
            'jnsbarang' => JnsBrng::all(),
            'jnsKtng'  => JnsKtng::all(),
            'ukurancc'  => Ukurancc::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        

        $data = [
            'kdbrg' => $request->kdbrg,
            'nmbrg'  => $request->nmbrg,
            'brdragen' => $request->brdragen,
            'satuanbsr'  => $request->satuanbsr,
            'satuankcl'  => $request->satuankcl,
            'hrsat'  => $request->hrsat,
            'stok'  => $request->stok,
            'stokmin'  => $request->stokmin,
            'stokawal'  => $request->stok,
            'jnsbrg'  => $request->jnsbrg,
            'stoktambah'  => $request->stoktambah,
            'jnskantong'  => $request->jnskantong,
            'ukuran'  => $request->ukuran,
            'kodekelompok'  => $request->kodekelompok,
        ];
        $barang->update($data);
        return redirect()->route('barang.index')->with('message', 'Berhasil Mengubah Data Barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('message', 'Berhasil Menghapus Data');
    }
}
