<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const UNCONFIRMED = "UNCONFIRMED";
    public const CONFIRMED = "CONFIRMED";
    public const CANCELED = "CANCELED";
    public const FINISHED = "FINISHED";
    public const UNPAID = "UNPAID";
    public const PAID = "PAID";

    public function getCount()
    {
        return self::count();
    }

    public function getInvoice()
    {
        return 'IN/' . Carbon::now()->format('YmdHis') . '/' . $this->getCount();
    }

    public function setData($data)
    {
        $this->setInvoice();
        $this->setCustomerId($data['customer_id']);
        $this->setStatus($data['status']);
        $this->setPaymentStatus($data['payment_status']);
    }

    public function setInvoice()
    {
        $this->invoice = $this->getInvoice();
    }

    public function setCustomerId($customerId)
    {
        $this->customer_id = $customerId;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPaymentStatus($paymentSatus)
    {
        $this->payment_status = $paymentSatus;
    }
}
