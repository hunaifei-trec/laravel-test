<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\Interfaces\CouponRepositoryInterface;

class CouponRepository implements CouponRepositoryInterface
{

    public function findAll($name = null, $limit = 5)
    {
        if (empty($name)) {
            return Coupon::with('products')->orderBy('updated_at', 'desc')->paginate($limit);
        } else {
            return Coupon::with('products')->where('name',$name)->orWhere('name','like','%'.$name.'%')->orderBy('updated_at', 'desc')->paginate($limit);
        }
    }

    public function detail($id)
    {
        return Coupon::with('products')->where('coupon_id',$id)->first();
    }

    public function create($data)
    {
        return Coupon::create($data);
    }

    public function update($data, $id)
    {
        return Coupon::where('coupon_id', $id)->update($data);
    }

    public function delete($id)
    {
        return Coupon::where('coupon_id',$id)->delete();
    }
}
