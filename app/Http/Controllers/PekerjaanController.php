<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Kelompok;
use App\Models\Cabang;
use Illuminate\Support\Str;


class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.admin.pekerjaan.index', [
            'items' => Pekerjaan::with('cabang')->orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.admin.pekerjaan.create', [
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
            'kdpkrj'  => $request->kdpkrj,
            'nmpkrj'  => $request->nmpkrj,
            'kdptgs' => $request->kdptgs,
          
            
        ];
        Pekerjaan::create($data);

        return redirect()->route('pekerjaan.index')->with('message', 'Berhasil Menambahkan Data');
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
    public function edit(Pekerjaan $pekerjaan)
    {
        //
        return view('pages.admin.pekerjaan.edit', [
            'pekerjaan' => $pekerjaan,
            'cabang' => Cabang::with('pekerjaan')->orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        //
        $data = [
            'kdcab' => $request->kdcab,
            'kdpkrj'  => $request->kdpkrj,
            'nmpkrj'  => $request->nmpkrj,
            'kdptgs' => $request->kdptgs,
        ];
        $pekerjaan->update($data);
        return redirect()->route('pekerjaan.index')->with('message', 'Berhasil Mengubah Data Pekerjaan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
        $pekerjaan->delete();
        return redirect()->route('pekerjaan.index')->with('message', 'Berhasil Menghapus Data');
    }
}
