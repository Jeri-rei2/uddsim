<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;

class GoogleMapController extends Controller
{
    public function places()
    {
        $places = Map::orderBy('nama_lokasi', 'ASC');
        return datatables()->of($places)
            ->addColumn('action', 'places.buttons')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}