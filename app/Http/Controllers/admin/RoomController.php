<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoomController extends Controller
{



    public function get_furniture_by_room_code(Request $request){
        $roomcode = $request->input('room_code');
        $room_code = 'P'.$roomcode;
        //        $details = DB::table('values')
//            ->select('value', 'note', 'quantity')
//            ->get();
        $details = Value::join('rooms', 'rooms.room_code', '=', 'values.room_code')
            ->join('attributes', 'attributes.id', '=', 'values.attribute_id')
            ->where('values.room_code', $room_code)
            ->select(DB::raw('UPPER(attributes.name) AS name'), 'values.value', 'values.quantity', 'values.note')
            ->get();
        return view('admin.furniture.search_furniture', ['details' => $details]);
//        $attributes = DB::table('attributes')
//            ->select('name')
//            ->get();
//        $values = DB::table('values')
//            ->select('value')
//            ->get();
//
//        return view('details', compact('attributes', 'values'));
    }
    public function get_furniture()
    {
        $data = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->select('attributes.name as key', 'values.value as value')
            ->get();

        return view('admin.furniture.details', ['data' => $data]);
    }
}
