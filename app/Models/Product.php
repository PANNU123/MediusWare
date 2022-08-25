<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description','price','qty'
    ];

    public function images()
    {
        return $this->hasOne(ProductImage::class,'product_id');
    }
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class,'product_id');
    }

}
