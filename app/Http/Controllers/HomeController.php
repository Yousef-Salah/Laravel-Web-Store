<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  
    // Actions
    public function index()
    {
        return view('store.home', [
            'latestProducts' => Product::latest()->limit(8)->get(),
        ]);
    }  
}
