<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequsition extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_date',
        'purchase_req_no',
        'section_id',
        'grand_total',
        'user_id'
    ];
    protected $attributes = [
        'is_approve' => 1,
    ];

    function section(){
        return $this->belongsTo(Section::class);
    }

    public function getReqDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
