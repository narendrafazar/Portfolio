<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{  
    public function index() 
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])->whereHas('product', function($product) {
            // Mengecek produk mana saja yang sudah laku dan dibeli oleh siapa? (Sebagai penjual yang sedang login)
            $product->where('users_id', Auth::user()->id);
        })->get();
        
        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])->whereHas('transaction', function($transaction) {
            // Mengecek transaksi mana saja yang sudah dilakukan dan bertransaksi dengan siapa? (Sebagai pembeli yang sedang login)
            $transaction->where('users_id', Auth::user()->id);
        })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])->findOrFail($id);

        return view('pages.dashboard-transaction-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);
    }
}
