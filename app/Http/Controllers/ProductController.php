<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('customer.product.index', [
            'products' => Product::with('getImage')->paginate(6)
        ]);
    }

    public function detail($id)
    {
        return view('customer.product.detail', [
            'product' => Product::with('getImages')->find($id)
        ]);
    }
}
