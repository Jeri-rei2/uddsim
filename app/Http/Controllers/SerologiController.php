<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBarangRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Cabang;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SerologiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
      return view('pages.admin.serologi.seroumum');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
   
     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
      
    }
}
