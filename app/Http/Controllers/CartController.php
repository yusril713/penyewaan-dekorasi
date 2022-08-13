<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart.index');
    }

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
                "booking_date" => $request->bookingDate,
                "return_date" => $request->returnDate,
                "duration" => $diff,
                "image" => $product->getImage->image
             ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        // dd(Session::get('cart'));
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function flushSession(Request $request)
    {
        $request->session()->flush();

        return redirect('/');
    }
}
