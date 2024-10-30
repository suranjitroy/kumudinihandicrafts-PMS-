<?php

namespace App\Models;

use App\Models\ProductReceive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable=['unit_name'];

    public function productReceive(){
        return $this->hasMany(ProductReceive::class);
    }
}
