<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function setData($userId, $request)
    {
        $this->setUserId($userId);
        $this->setName($request->name);
        $this->setGender($request->gender);
        $this->setPhone($request->phone);
        $this->setAddress($request->address);
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}
