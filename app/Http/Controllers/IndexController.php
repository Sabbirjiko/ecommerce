<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
    	$products = Product::with('category')->inRandomOrder()->get();
    	//dd($products);exit();
        return view('frontend.index',compact('products'));
    }
}
