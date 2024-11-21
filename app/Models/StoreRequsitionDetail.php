<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreRequsitionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_requsition_id',
        'store_req_no',
        'product_id',
        'quantity',
        'unit_id',
        'user_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    function unit(){
        return $this->belongsTo(Unit::class);
    }
}
