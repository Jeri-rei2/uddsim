<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Kelompok;
use App\Models\Cabang;
use App\Models\Wilayah;

use Illuminate\Support\Str;


class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.admin.wilayah.index', [
            'items' => Wilayah::with('cabang')->orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.admin.wilayah.create', [
                       'cabang' => Cabang::with('pekerjaan')->orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = [
            'kdcab' => $request->kdcab,
            'kdwil'  => $request->kdwil,
            'nmwil'  => $request->nmwil,
            'kdptgs' => $request->kdptgs,
          
            
        ];
        Wilayah::create($data);

        return redirect()->route('wilayah.index')->with('message', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        //
        return view('pages.admin.wilayah.edit', [
            'wilayah' => $wilayah,
            'cabang' => Cabang::with('pekerjaan')->orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wilayah $Wilayah)
    {
        //
        $data = [
            'kdcab' => $request->kdcab,
            'kdwil'  => $request->kdwil,
            'nmwil'  => $request->nmwil,
            'kdptgs' => $request->kdptgs,
        ];
        $Wilayah->update($data);
        return redirect()->route('wilayah.index')->with('message', 'Berhasil Mengubah Data Wilayah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilayah $wilayah)
    {
        //
        $wilayah->delete();
        return redirect()->route('wilayah.index')->with('message', 'Berhasil Menghapus Data');
    }
}
