<?php

namespace App\Repositories;

use App\Models\CouponProduct;
use App\Repositories\Interfaces\CouponProductRepositoryInterface;

class CouponProductRepository implements CouponProductRepositoryInterface
{
    public function create($data)
    {
        return CouponProduct::create($data);
    }

    public function delete($couponId)
    {
        return CouponProduct::where('coupon_id',$couponId)->delete();
    }
}
