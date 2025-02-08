<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumptionSetting extends Model
{
    use HasFactory;

    protected $fillable=[
        'material_name',
        'size',
        'bahar',
        'yard',
        'inch'
    ];
    protected $attributes=[
        'status' => 1
    ];
}
