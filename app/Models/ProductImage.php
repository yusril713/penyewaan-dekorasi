<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public function setData($productId, $image)
    {
        $this->setProductId($productId);
        $this->setImage($image);
    }

    public function setProductId($productId)
    {
        $this->product_id = $productId;
    }

    public function setImage($image)
    {
        $this->image = $this->uploadImage($image) == "" ? $this->image : $this->uploadImage($image);
    }

    public function uploadImage($image) {
        $file = "";
        if ($image->hasFile('image')) {
            if ($image->get('PUT')) {
                if (file_exists(storage_path('app/public/' . $this->image))) {
                    unlink(storage_path('app/public/' . $this->image));
                }
            }
            $file = $image->file('image')->store('products', 'public');
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
}
