<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreRequsition extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_date',
        'store_req_no',
        'section_id',
        'is_approve'
    ];
}
