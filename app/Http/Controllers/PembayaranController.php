<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePembayaranRequest;
use App\Models\Pembayaran;
use App\Models\Payment;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.payment.index', [
            'payments' => Pembayaran::with('pesanan','user')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePembayaranRequest $request)
    {
        // dd($request->all());
        $filename = "";
        if ($request->file('bukti_tf') != null) {
            $file = $request->file('bukti_tf');
            $extension = $file->getClientOriginalExtension();
            // if (!in_array($file, ['png', 'jpg', 'jpeg', 'pdf'])) continue;
            $filename = time() . '.' . $extension;
            $filename = str_replace(' ', '-', $filename);
            $file->move('bukti_tf', $filename);
        }
        $cash = [
            'pesanan_id' => $request->pesanan_id,
            'user_id' => $request->user_id,
            'tipe' => $request->type,
            'nominal' => $request->total_bayar
        ];
        $transfer = [
            'pesanan_id' => $request->pesanan_id,
            'user_id' => $request->user_id,
            'tipe' => $request->type,
            'bank_type' => $request->type_bank,
            'nomor_rekening' => $request->no_rek,
            'nama_rekening' => $request->nama_rek,
            'nominal' => $request->jumlah,
            'bukti_pembayaran' => $filename,

        ];

        if ($request->type == 'Cash') {
            Pembayaran::create($cash);
        } else {
            Pembayaran::create($transfer);
        }

        Pesanan::where('id', $request->pesanan_id)->update(['status' => 'Pesanan diproses']);
        return redirect()->route('pesanan.index')->with('message', 'Pembayaran Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('message', 'Pembayaran Dihapus');

    }
}
