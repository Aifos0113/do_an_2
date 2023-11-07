<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Http\Request as MyRequest;
use App\Models\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class Furniture extends Controller
{
//    public function get_all_furniture()
//    {
//
//        return view('furniture');
//    }
    public function get_all_furniture() {
        $furniture = Attribute::where('entity_id', 1)->get();
        foreach ($furniture as $key => $item) {
            $furniture[$key]->name = ucwords($item->name);
        }
        $rooms = Room::orderBy('room_code')->get();
        $phongtrong = DB::table('rooms')
            ->join('room_types' , 'rooms.room_type', '=', 'room_types.room_type' )
            ->select('room_types.max_occupancy', 'rooms.room_code', 'rooms.id')->get();
        $maxOccupancyByRoomCode = [];
        $roomtypes = DB::table('room_types')
            ->get();
        foreach ($phongtrong as $item) {
            $maxOccupancyByRoomCode[$item->room_code] = $item->max_occupancy;
        }
        return view('admin.furniture.furniture', ['rooms' => $furniture ,'rooms' => $rooms ,'roomtypes' =>$roomtypes ,'max_occupancy' => $maxOccupancyByRoomCode ]);
    }


    // Nội thất theo phòng
    public function furniture_by_room($id){
        $room = Room::find($id);
        $noi_that = DB::table('values')
            ->where('room_code' , $room->room_code)
            ->where('is_active' , 1)
            ->get();
        $attribute_name = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->select('attributes.name', 'values.attribute_id', 'attributes.id')
            ->get();
        $attribute = [];
        foreach ($attribute_name as $item) {
            $attribute[$item->attribute_id] = $item->name;
        }
        return view('admin.furniture.furniture_by_room',['noi_that' => $noi_that , 'attribute' => $attribute]);
    }

    // Xoá 1 món nội thất
    public function delete_furniture(MyRequest $request, $id)
    {
        $noi_that = Value::find($id);
        $noi_that->is_active = 2;
        $noi_that->save();
        return redirect()->route('furniture');
    }

}
