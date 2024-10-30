<?php

namespace App\Models;

use App\Models\Store;
use App\Models\StoreCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_id','store_category_id','product_name'];

    function store(){
        return $this->belongsTo(Store::class);
    }
    function storeCategory(){
        return $this->belongsTo(StoreCategorie::class);
     }
}
