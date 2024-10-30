<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReceive extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'store_category_id',
        'product_id',
        'description',
        'supplier_id',
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
     function supplier(){
        return $this->belongsTo(Supplier::class);
     }
 

}
