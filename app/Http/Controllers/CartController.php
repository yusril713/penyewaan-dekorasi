<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $cart[$id]['duration'] = $diff > 0 ? $diff : 1;
            $cart[$id]['booking_date'] = $request->bookingDate;
            $cart[$id]['return_date'] = $request->returnDate;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->qty,
                "price" => $product->price,
                "booking_date" => $request->bookingDate,
                "return_date" => $request->returnDate,
                "duration" => $diff > 0 ? $diff : 1,
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

    public function flushSession()
    {
        session()->forget('cart');
    }

    public function processToCheckout()
    {
        $customer = Customer::where('user_id', '=', Auth::user()->id)->first();
        if (session()->get('cart')) {
            $transaction = new Transaction();
            $transaction->setData([
                'customer_id' => $customer->id,
                'status' => Transaction::UNCONFIRMED,
                'payment_status' => Transaction::UNPAID
            ]);
            $transaction->save();

            foreach(session()->get('cart') as $id => $detail) {
                $details = new TransactionDetails();
                $details->setData([
                    'transaction_id' => $transaction->id,
                    'product_id' => $id,
                    'booking_date' => $detail['booking_date'],
                    'return_date' => $detail['return_date'],
                    'duration' => $detail['duration'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price']
                ]);
                $details->save();
            }
            $this->flushSession();

            return redirect()->route('checkout.index', [$transaction->id]);
        }

        return redirect()->back();
    }
}
