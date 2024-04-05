<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'desc', 'SKU', 'price', 'image', 'category_id', 'inventory_id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class, 'inventory_id');
    }

    public function getImageAttribute($value)
    {
        return asset('images/' . $value);
    }
}
