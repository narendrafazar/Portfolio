<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request) 
    {
        // Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));
    
        // Proses Checkout
        //memanggil angka random dengan 6 angka 0 dan 6 angka 9
        $code = 'STORE-' . mt_rand(000000,999999);
        //memanggil table Cart dengan product dan user where users_id = Auth::user()->id (user yang sedang login) dan diambil dengan get() yang mengambil data dan menyimpannya
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();
    
        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                // merubah nilai total_price kedalam integer
                'total_price' => (int) $request->total_price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Delete barang-barang yang sudah di checkout pada cart
        Cart::where('users_id', Auth::user()->id)->delete();

        // return dd($transaction);

        // Konfigurasi Midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                // merubah nilai gross_amount kedalam integer
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
            }
            catch (Exception $e) {
                echo $e->getMessage();
            }
        
    }

    public function callback(Request $request)
    {

    }
}
