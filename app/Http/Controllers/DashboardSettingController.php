<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-settings', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $user = Auth::user();

        return view('pages.dashboard-account', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $redirect)
    {
        // ambil semua data dari request 
        $data = $request->all();
        // mengupdate user yang sedang login
        $item = Auth::user();
        $item->update($data);

        return redirect()->route($redirect);
    }
}
