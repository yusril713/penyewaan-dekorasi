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
        return 'IN/' . Carbon::now()->format('YmdHis') . '/' . ($this->getCount() + 1);
    }

    public function  getTransactionDetails()
    {
        return $this->hasMany(TransactionDetails::class, 'transaction_id', 'id');
    }

    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
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

    public function setReceiptOfTransfer($image)
    {
        $this->receipt_of_transfer = $this->uploadImage($image) == "" ? $this->receipt_of_transfer : $this->uploadImage($image);
    }

    public function uploadImage($image) {
        $file = "";
        if ($image->hasFile('image')) {
            if ($image->get('PUT')) {
                if (file_exists(storage_path('app/public/' . $this->receipt_of_transfer))) {
                    unlink(storage_path('app/public/' . $this->receipt_of_transfer));
                }
            }
            $file = $image->file('image')->store('receipt_of_transfers', 'public');
        }
        return $file;
    }

    public function removeImage($imageUrl)
    {
        if (!is_null($imageUrl)) {
            if (file_exists(storage_path('app/public/' . $imageUrl))) {
                unlink(storage_path('app/public/' . $imageUrl));
            }
        }
    }

    public static function getCountTransactionUnconfirmed()
    {
        return self::with('getCustomer')
            ->where('status', '=', Transaction::UNCONFIRMED)
            ->orWhere('payment_status', '=', Transaction::UNPAID)
            ->orderBy('created_at', 'desc')
            ->count();
    }
}
