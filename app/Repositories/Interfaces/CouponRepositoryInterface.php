<?php

namespace App\Repositories\Interfaces;

interface CouponRepositoryInterface
{
    public function findAll($name = null, $limit = null);

    public function detail($couponId);

    public function create($data);

    public function update($data, $couponId);

    public function delete($couponId);
}
