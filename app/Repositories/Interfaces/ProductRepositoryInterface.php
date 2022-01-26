<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function findAll($name = null, $limit = null);

    public function detail($productId);

    public function create($data);

    public function update($data, $productId);

    public function delete($productId);
}
