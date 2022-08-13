<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('getImage')->limit('6')->get();
        return view('welcome', [
            'products' => $products
        ]);
    }

    public function redirect()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin' or Auth::user()->role == 'owner') {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('home');
    }
}
