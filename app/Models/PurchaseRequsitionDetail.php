<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequsitionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_requsition_id',
        'purchase_req_no',
        'product_id',
        'quantity',
        'unit_id',
        'unit_price',
        'total',
        'user_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    function unit(){
        return $this->belongsTo(Unit::class);
    }
}
