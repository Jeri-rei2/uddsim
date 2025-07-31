<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\API\MdonorController;
use App\Http\Controllers\API\AuthPedonorController;
use App\Mail\Sendantrian;
use App\Http\Controllers\GudangController;
// use Mail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/ambilbos', [GudangController::class, 'ambildata']);

Route::get('/last-temp-code', [GudangController::class, 'getTemporary']);


Route::post('/nomor/simpan', [GudangController::class, 'store']);

Route::post('/register', [\App\Http\Controllers\Api\AuthPedonorController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthPedonorController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthPedonorController::class, 'logout']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
//     Route::get('places', 'GoogleMapController@index')->name('places.index');
// });
// Route::get('pedonor', [MdonorController::class, 'index']);


Route::post('/payments',[PaymentController::class,'create']);
Route::get('pedonor', [MdonorController::class, 'index']);
Route::post('kirimpedonor', [MdonorController::class, 'kirimpedonor']);
Route::get('kirimpedonor/read/{id}', [MdonorController::class, 'show']);
Route::put('kirimpedonor/update/{id}', [MdonorController::class, 'update']);
Route::delete('kirimpedonor/delete/{id}', [MdonorController::class, 'destroy']);

// Route::post('/users-import', [UserController::class, 'import']);
// Route::get('/users-export', [UserController::class, 'export']);



Route::get('send-mail', function(){
    $email = new Sendantrian();
    Mail::to('jerireinaldo@gmail.com')->send($email);

    return 'success';
});