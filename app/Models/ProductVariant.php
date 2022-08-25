<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable =[
        'variant',
        'variant_id',
        'product_id',
    ];
    protected $casts = [
        'variant' => 'array',
    ];
    public function variant()
    {
        return $this->hasOne(Variant::class,'id','variant_id');
    }
}
