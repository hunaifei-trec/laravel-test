<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $keyType = 'string';

    protected $fillable = [
        'product_id','name', 'sku', 'image_url', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'id',
    ];

    protected $dates = ['delete_at'];

    protected $casts = [
        'product_id' => 'string'
    ];
}
