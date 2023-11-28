<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    { 
        $customer = User::count();
        $revenue = User::count();
        $transaction = Transaction::sum('total_price');

        // kalo mao bikin buat ngitung transaction yang sukses aja, bisa pake cara dibawah ini
        // $transaction = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price'); 

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction
        ]);
    }
}
