<?php

namespace App\Models\Product;

use App\ValueObjects\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'price',
        'quantity',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Product $product) {
            $product->uuid = UUID::create()->get();
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }
}
