<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Memanggil model Product dan Category
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with('galleries')->take(8)->get();
        // sintaks diatas ini bisa juga seperti dibawah ini pake kurung array jika data akan ditambah lagi pake koma(,) nantinya
        // $products = Product::with(['galleries'])->take(8)->get();

        //atau jika ingin menampilkan product paling akhir bisa pake latest() atau shortByDate(), jika ingin mengambil data pertama pake first()
        // $products = Product::with('galleries')->take(8)->latest()->get();

        return view('pages.home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
