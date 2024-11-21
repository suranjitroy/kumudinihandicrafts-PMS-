<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Carbon\Carbon;

class StoreRequsition extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_date',
        'store_req_no',
        'section_id',
        'user_id'
    ];
    protected $attributes = [
        'is_approve' => 1,
    ];

    function section(){
        return $this->belongsTo(Section::class);
    }


    // public function getReqDateFormattedAttribute($req_date_formatted)
    // {
    //     return $req_date_formatted->format("d/m/Y");
    // }

    public function getReqDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
