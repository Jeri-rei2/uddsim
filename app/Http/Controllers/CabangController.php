<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Cabang;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('pages.admin.cabang.index', [
            'items' => Cabang::with('kelompok')->orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.cabang.create', [
            'Kelompok' => Kelompok::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // dd($slug);
        $data = [
            'kdcab' => $request->kdcab,
            'nmcab'  => $request->nmcab,
            'alamat' => $request->alamat,
            'kota'  => $request->kota,
            'kdpos'  => $request->kdpos,
            'tlp'  => $request->tlp,
            'status'  => $request->status,
            
        ];
        Cabang::create($data);

        return redirect()->route('cabang.index')->with('message', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        return view('pages.admin.cabang.detail', [
            'cabang' => $cabang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        return view('pages.admin.cabang.edit', [
            'cabang' => $cabang,
            'categories' => Cabang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
   
        $data = [
            'kdcab' => $request->kdcab,
            'nmcab'  => $request->nmcab,
            'alamat' => $request->alamat,
            'kota'  => $request->kota,
            'kdpos'  => $request->kdpos,
            'tlp'  => $request->tlp,
            'status'  => $request->status,
        ];
        $cabang->update($data);
        return redirect()->route('cabang.index')->with('message', 'Berhasil Mengubah Data Cabang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        $cabang->delete();
        return redirect()->route('cabang.index')->with('message', 'Berhasil Menghapus Data');
    }
}
