<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('getUser')->orderBy('name', 'asc')->get();
        return view('admin.customer.index', [
            'customers' => $customers
        ]);
    }

    public function resetPassword($userId)
    {
        $user = User::find($userId);
        $str = $this->generateRandomString(8);
        $user->password = Hash::make($str);
        $this->message(true, 'Password berhasil direset menjadi ' . $str, '');
        return redirect()->back();
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
