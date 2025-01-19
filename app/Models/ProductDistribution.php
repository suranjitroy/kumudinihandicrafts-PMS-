<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Store;
use App\Models\Product;
use App\Models\StoreCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDistribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'entry_date',
        'store_id',
        'store_category_id',
        'product_id',
        'description',
        'quantity',
        'unit_id',
        'unit_price',
        'total',
        'purpose',
    ];

    function store(){
        return $this->belongsTo(Store::class);
    }
    function storeCategory(){
        return $this->belongsTo(StoreCategorie::class);
     }
     function product(){
        return $this->belongsTo(Product::class);
     }
     function unit(){
        return $this->belongsTo(Unit::class);
     }
}
