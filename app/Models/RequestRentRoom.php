<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestRentRoom extends Model
{
    use HasFactory;

    protected $fillable = ['room_code' , 'start_date' , 'end_date' , 'customer' , 'price' , 'personal_id' , 'phone_number', 'amount_people' ,'is_active' , 'status', 'note' ,'created_at' , 'updated_at'];
}
