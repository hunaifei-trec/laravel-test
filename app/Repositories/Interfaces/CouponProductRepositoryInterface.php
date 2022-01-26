<?php

namespace App\Repositories\Interfaces;

interface CouponProductRepositoryInterface
{
    public function create($data);

    public function delete($couponId);
}
