<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    protected $table = 'coupon_product';
    protected $keyType = 'string';
    protected $fillable = [
        'product_id','coupon_id'
    ];
    protected $casts = [
        'coupon_id' => 'string',
        'product_id' => 'string',
    ];
}
