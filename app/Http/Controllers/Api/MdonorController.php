<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MPedonor;
use GuzzleHttp\Client;
use App\Models\BridgingPedonor;

//import Resource "PostResource"
use App\Http\Resources\MdonorResource;
class MdonorController extends Controller
{
    //
  public function index(Request $request){

    
    $mpedonor = MPedonor::all();
    
    // dd($mpedonor);
    if($mpedonor){
        return response()->json([
            'response_code' => 200,
            'success' => true,
            'message' => 'Berhasil',
           'data: ' => $mpedonor,
        ]);
    }else{
        return response()->json([
            'response_code' => 404,
            'message' => 'data Tidak Ditemukan!'
        ]);
    }
    return response()->json([
        'message' => 'check data anda.',
    ], 401);
 
  }
   

  public function kirimpedonor(Request $request)
  {
     
    $kirim = BridgingPedonor::all();

    $getdata = MPedonor::all();
    $client = new MPedonor();
    
    $input = $request->validate([
        'prm_pkode' =>  ['required'],
        'prm_pudd' =>  ['required'],
        'prm_pktp' =>  ['required'],
        'prm_pnama' =>  ['required'],
        'prm_pkelamin' =>  ['required'],
        'prm_ptmplahir' =>  ['required'],
        'prm_ptgllahir' =>  ['required'],
        'prm_pgolabo' =>  ['required'],
        'prm_pgolrh' =>  ['required'],
        'prm_pketgolda' =>  ['required'],
        'prm_pstatusnikah' =>  ['required'],
        'prm_palamat' =>  ['required'],
        'prm_pkdpos' =>  ['required'],
        'prm_pkeluarahan' =>  ['required'],
        'prm_pkecamatan' =>  ['required'],
        'prm_pkabupaten' =>  ['required'],
        'prm_pprovinsi' =>  ['required'],
        'prm_ptelp' =>  ['required'],
        'prm_pmobile' =>  ['required'],
        'prm_ppekerjaan' =>  ['required'],
        'prm_ptgldonorterakhir' =>  ['required'],
        'prm_pjenisdonorterahir' =>  ['required'],
        'prm_ptglkembalidonor' =>  ['required'],
        'prm_pjmldonor' =>  ['required'],
        'prm_pp10' =>  ['required'],
        'prm_pp25' =>  ['required'],
        'prm_pp50' =>  ['required'],
        'prm_pp75' =>  ['required'],
        'prm_pp100' =>  ['required'],
        'prm_ppsatya' =>  ['required'],
        'prm_pckl_b' =>  ['required'],
        'prm_pckl_c' =>  ['required'],
        'prm_pckl_i' =>  ['required'],
        'prm_pckl_s' =>  ['required'],
        'prm_pckl_m' =>  ['required'],
        'prm_pckl_abs' =>  ['required'],
        'prm_pckl_imltd' =>  ['required'],
    ]);
    // dd($input);
    $pedonor = BridgingPedonor::create($input);

    if ($pedonor->save()){

        return response()->json([
            'response_code' => 200,
            'success' => true,
            'message' => 'Berhasil kirim',
            'data' => $pedonor
        ]);

    }else{
        return response()->json([
            'response_code' => 404,
            'message' => 'data Tidak Ditemukan!'
        ]);
    }
    return response()->json([
        'message' => 'check data anda.',
    ], 401);

  }

public function show(string $id)
{

    $pedonor = BridgingPedonor::find($id);

    if ($pedonor){

        return response()->json([
            'response_code' => 200,
            'success' => true,
            'message' => 'Berhasil',
            'data' => $pedonor
        ]);

    }else {

        return response([
            'response_code' => 500,
            'Message: ' => 'Tidak Ada data pedonor.',

        ], 500);
    }

   
 }
 public function update(Request $request, string $id)
 {

    $product = BridgingPedonor::find($id);

    if($product){

       $input = $request->validate([
          'title' => ['required'],
          'description' => ['required'],
          'price' => ['required'],
        ]);

        $product->title = $input['title'];
        $product->description = $input['description'];
        $product->price = $input['price'];

        if($product->save()){

            return response()->json([

                'Message: ' => 'updated with success.',
                'Product: ' => $product

            ], 200);


        }else {

            return response([

                'Message: ' => 'Tidak Ada data pedonor yang update .',

            ], 500);

        }
    }else {

        return response([

            'Message: ' => 'Tidak Ada data pedonor.',

        ], 500);
    }

}
public function destroy(string $id){

    $product = BridgingPedonor::find($id);

    if($product){

        $product->delete();

        return response()->json([

            'Message: ' => 'deleted with success.',

        ], 200);

    }else {

        return response([
            
            'Message: ' => 'Tidak Ada data pedonor.',

        ], 500);
    }

}


}