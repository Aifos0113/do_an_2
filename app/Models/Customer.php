<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name' ,'room_code',  'phone_number', 'citizen_identification_number' ,'tenancy', 'is_active' ,'create_at', 'updated_at'];
}
