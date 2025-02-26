<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterInfo extends Model
{
    use HasFactory;

    protected $fillable = ['master_name', 'mob_no'];
}
