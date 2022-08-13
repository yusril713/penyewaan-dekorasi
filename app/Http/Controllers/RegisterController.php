<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();

            $customer = new Customer();
            $customer->setData($user->id, $request);
            $customer->save();

            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }

        return redirect()->route('login');
    }
}
