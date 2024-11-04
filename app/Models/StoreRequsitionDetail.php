<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreRequsitionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_requsition_id',
        'product_id',
        'quantity',
        'unit_id'
    ];
}
