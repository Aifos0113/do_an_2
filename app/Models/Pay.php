<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $fillable =['thang' ,'so_dien' ,'tien_phong','note', 'room_code' , 'so_dien' , 'tien_nuoc' ,'tien_mang' , 'tien_khac'  , 'tong_tien' , 'da_thanh_toan' ,'tanancy', 'is_active' ];
}
