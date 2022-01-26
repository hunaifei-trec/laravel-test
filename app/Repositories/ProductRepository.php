<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function findAll($name = null, $limit = 5)
    {
        if (empty($name)) {
            return Product::orderBy('updated_at', 'desc')->paginate($limit);
        } else {
            return Product::where('name',$name)->orWhere('name','like','%'.$name.'%')->orderBy('updated_at', 'desc')->paginate($limit);
        }
    }

    public function detail($productId)
    {
        return Product::where('product_id',$productId)->first();
    }

    public function create($data)
    {
        return Product::create($data);
    }

    public function update($data, $productId)
    {
        return Product::where('product_id', $productId)->update($data);
    }

    public function delete($productId)
    {
        return Product::where('product_id',$productId)->delete();
    }
}
