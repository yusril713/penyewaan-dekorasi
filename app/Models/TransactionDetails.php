<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function setData($data)
    {
        $this->setTransactionId($data['transaction_id']);
        $this->setProductId($data['product_id']);
        $this->setBookingDate($data['booking_date']);
        $this->setReturnDate($data['return_date']);
        $this->setDuration($data['duration']);
        $this->setPrice($data['price']);
        $this->setQuantity($data['quantity']);
    }

    public function setTransactionId($transactionId)
    {
        $this->transaction_id = $transactionId;
    }

    public function setProductId($productId)
    {
        $this->product_id = $productId;
    }

    public function setBookingDate($bookingDate)
    {
        $this->booking_date = $bookingDate;
    }

    public function setReturnDate($returnDate)
    {
        $this->return_date = $returnDate;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}
