<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = ['room_code' , 'attribute_id' , 'is_active' , 'value','quantity' , 'created_at' , 'updated_at'];
}
