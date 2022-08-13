<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::with('getImage')->findOrFail($id);
        $bookingDate = Carbon::parse($request->bookingDate);
        $returnDate = Carbon::parse($request->returnDate);
        $diff = $bookingDate->diffInDays($returnDate);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->qty;
            $cart[$id]['image'] = $product->getImage->image;
            $cart[$id]['duration'] = $diff;
            $cart[$id]['booking_date'] = $request->bookingDate;
            $cart[$id]['return_date'] = $request->returnDate;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->qty,
                "price" => $product->price,
                "booking_date" => $request->returnDate,
                "return_date" => $request->returnDate,
                "duration" => $diff,
                "image" => $product->getImage->image
             ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        // dd(Session::get('cart'));
    }
}
