<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['room_code' , ' request_date' , 'content_request' , ' repair_person' , 'completion_date' , 'status'];
}
