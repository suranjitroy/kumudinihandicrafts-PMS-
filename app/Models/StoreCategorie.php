<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductDistribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreCategorie extends Model
{
    use HasFactory;

    protected $fillable=['store_id','category_name'];


    function store(){
        return $this->belongsTo(Store::class);
    }
    function product(){
        return $this->hasMany(Product::class);
     }
     function productReceive(){
        return $this->hasMany(ProductReceive::class);
     }
     function productDistribution(){
        return $this->hasMany(ProductDistribution::class);
     }
}
