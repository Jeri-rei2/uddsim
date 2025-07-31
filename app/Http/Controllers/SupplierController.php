<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplierRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Supplier;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('pages.admin.supplier.index', [
            'items' => Supplier::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.supplier.create', [
            'categories' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($data);
        $data = [
            'kodesupplier' => $request->kodesupplier,
            'nama_supplier'  => $request->nama_supplier,
            'alamat' => $request->alamat,
            'telepon'  => $request->telepon,
         
        ];
        Supplier::create($data);

        return redirect()->route('supplier.index')->with('message', 'Berhasil Menambahkan Data');
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
            'categories' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangRequest $request, Barang $barang)
    {
        $filename = $barang->foto;

        //cek apakah ada file yang diupload 
        if ($request->file('foto') != null) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            // if (!in_array($file, ['png', 'jpg', 'jpeg', 'pdf'])) continue;
            $removeExt = explode('.', $file->getClientOriginalName());
            $implode = array_shift($removeExt);
            $filename = $implode . '-' . time() . '.' . $extension;
            $filename = str_replace(' ', '-', $filename);
            $file->move('product_image', $filename);
        }

        $data = [
            'nama' => $request->nama_barang,
            'tipe'  => $request->tipe,
            'panjang'  => $request->panjang,
            'lebar'  => $request->lebar,
            'harga'  => $request->harga,
            'in_stock'  => $request->in_stock,
            'keterangan'  => $request->keterangan,
            'kategori_id'  => $request->kategori_id,
            'foto'  => $filename,
        ];
        $barang->update($data);
        return redirect()->route('barang.index')->with('message', 'Berhasil Mengubah Data');
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
