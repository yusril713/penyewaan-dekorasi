<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const DECOR = "DEKORASI";
    const FURNISH = "PERLENGKAPAN";


    public function getImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function setData($request)
    {
        $this->setCategory($request->category);
        $this->setName($request->name);
        $this->setColor($request->color);
        $this->setStock($request->stock);
        $this->setPrice($request->price);
        $this->setDescription($request->description);
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
