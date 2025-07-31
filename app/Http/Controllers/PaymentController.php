<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class PaymentController extends Controller
{
    //
    public function create(Request $request)
    {
        //
        // $params = array(
        //     'transaction_details'->array(
        //         'order_id'     => Str::uuid(),
        //         'gross_amount' => $request->harga,
        //     ),
        //     'item_detail' => array(
        //         array(
        //             'harga'    => $request->harga,
        //             'quantity' => 1,
        //             'name' => $request->item_name,
        //         )
        //     ),
        //     'customer_details' => array(
        //         'first_name' => $request->customer_first_name,
        //         'email'      => $request->customer_email,
        //     );
        //     'enable_payment' => array('credit_card','bca_va', 'bni_va','bri_va')
        // );
        // $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        // $response = Http::withHeaders([
        //     'Content-Type'  => 'application/json',
        //     'Authorization' => "Basic $auth",
        // ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions',$params);
 
        // $response = Json_decode($response->body());

        // //save to db
        // $payment = new Payment
        // $payment->order_id = $params['transaction_details']['order_id'];
        // $payment->status = 'pending';
        // $payment->harga = $request->harga;
        // $payment->customer_first_name = $request->customer_first_name;
        // $payment->customer_email = $request->customer_email;
        // $payment->item_name = $request->item_name;
        // $payment->checkout_link = $request->redirect_url;
        // $payment->save();

        // return response()->json($response);
    }

}
