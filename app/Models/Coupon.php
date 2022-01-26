<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $table = 'coupons';

    protected $keyType = 'string';

    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'coupon_id','name', 'start_date', 'end_date', 'created_by', 'updated_by'
    ];

    protected $guarded = ['product_ids'];

    protected $hidden = [
        'id',
    ];

    protected $casts = [
        'coupon_id' => 'string',
        'start_date'   => 'date:Y-m-d',
        'end_date'   => 'date:Y-m-d'
    ];

    protected $dates = ['delete_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_product', 'coupon_id', 'product_id');
    }
}
