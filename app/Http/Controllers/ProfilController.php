<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Rules\MatchOldPassowrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('customer.profile.index', [
            'user' => Auth::user(),
            'customer' => Customer::where('user_id', '=', Auth::user()->id)->first()
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->setData($customer->user_id, $request);
        $customer->save();

        return redirect()->route('profile.index');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => ['required', new MatchOldPassowrd],
            'newPassword' => ['required'],
            'passwordConfirmation' => ['same:newPassword']
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        // dd('Password change successfully.');
        return redirect()->back();
    }
}
