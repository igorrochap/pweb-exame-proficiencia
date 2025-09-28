<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'quantity',
    ];
}
