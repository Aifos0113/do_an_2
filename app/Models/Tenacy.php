<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenacy extends Model
{
    use HasFactory;

    protected $fillable = ['tenacy_id' ,'personal_id', 'amount_of_people' , 'phone_number' , 'start_day' , 'end_date' , 'price' , 'room_code' , 'rule' ,'is_active', 'updated_at' , 'created_at'];
}
