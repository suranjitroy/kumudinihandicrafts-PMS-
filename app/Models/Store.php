<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductReceive;
use App\Models\StoreCategorie;
use App\Models\ProductDistribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    function storeCategory(){
       return $this->hasMany(StoreCategorie::class);
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
