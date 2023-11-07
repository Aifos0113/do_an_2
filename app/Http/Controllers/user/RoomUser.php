<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\RequestRentRoom;
use http\Client\Curl\User;
use Illuminate\Http\Request as MyRequest;
use App\Models\Request;
use App\Models\Room;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomUser extends Controller
{
    private $roomtypes; // Sửa tên biến thành $roomtypes

    // Danh sách phòng trống   /user_home/list_empty_room
    public function list_empty_room() {
        $rooms = Room::where('status', 0)->orderBy('room_code')->get();
        $phongtrong = DB::table('rooms')
            ->join('room_types' , 'rooms.room_type', '=', 'room_types.room_type' )
            ->select('room_types.max_occupancy', 'rooms.room_code', 'rooms.id')->get();
        $maxOccupancyByRoomCode = [];
        $roomtypes = DB::table('room_types')
            ->get();
        foreach ($phongtrong as $item) {
            $maxOccupancyByRoomCode[$item->room_code] = $item->max_occupancy;
        }
        return view('user.rent.empty_room', ['rooms' => $rooms ,'roomtypes' =>$roomtypes ,'max_occupancy' => $maxOccupancyByRoomCode]);
    }


    // Chi tiết phòng   /user_home/room_detail/{id}
    public function room_detail($id)
    {
        $room = Room::find($id);
        $noi_that = DB::table('values')
            ->where('room_code' , $room->room_code)
            ->where('is_active' , 1)
            ->get();
        $max_occupancy = DB::table('room_types')
            ->join('rooms', 'rooms.room_type' , '=' , 'room_types.room_type')
            ->where('rooms.room_code' , $room->room_code)
            ->where('is_active' , 1)
            ->select('room_types.max_occupancy')
            ->first();


//      Tiền phòng
        $values = DB::table('values')
            ->where('room_code', $room->room_type)
            ->where('is_active', 1)
            ->select('value')
            ->first();

        $user = Auth::user();

        $attribute_name = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->select('attributes.name', 'values.attribute_id', 'attributes.id')
            ->get();
        $attribute = [];
        foreach ($attribute_name as $item) {
            $attribute[$item->attribute_id] = $item->name;
        }

        return view('user.rent.room_detail_user' , ['noi_that' =>$noi_that , 'attribute' => $attribute , 'room'=> $room ,'user' =>$user , 'max_occupancy' => $max_occupancy , 'values' =>$values]);
    }

    // Xử lý yêu cầu thuê phòng    '/user_home/request_rent_room'
    public function request_rent_room(MyRequest $request, FlasherInterface $flasher){
        $room_code = $request->input('room_code');
        $start_day = $request->input('start_day');
        $end_date = $request->input('end_date');
        $note = $request ->input('note');
        $max_occupancy = $request->input('max_occupancy');
        $price = $request ->input('tien_phong');
        $user = Auth::user();

        $record = DB::table('request_rent_rooms')->insert([
            'room_code' => $room_code,
            'start_date' => $start_day,
            'end_date' =>$end_date,
            'customer' => $user->name,
            'price' => $price,
            'personal_id' => $user->cccd,
            'phone_number'=>$user->sdt,
            'note' => $note,
            'amount_of_people'=> $max_occupancy,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if($record){
            $flasher->addFlash('success' , 'Đã thêm yêu cầu thành công, chờ phê duyệt');
            return redirect()->route('empty_room_user');
        }
        else{
            $flasher->addFlash('error', 'Có lỗi khi thêm yêu cầu');
            return redirect()->route('empty_room_user');

        }
    }


    // Danh sách yêu cầu thuê phòng của bạn    '/user_home/list_request_rent_room'
    public function list_request_rent_room(){

        $user = Auth::user();
        $list_request_rent_room = DB::table('request_rent_rooms')
            ->where('personal_id' , $user->cccd)
            ->get();
        return view('user.rent.list_rent_user', ['list_request_rent_room'=>$list_request_rent_room , 'user' =>$user]);
    }

    // Yêu cầu xoá yêu cầu thuê phòng
    public function delete_request_rent(Request $request , $id){
        $request = RequestRentRoom::find($id);

        $request->is_active = 0;

        $request->save();
        return redirect()->route('list_request_rent_room_user');
    }

    // Chi tiết yêu cầu thuê phòng
    public function request_rent_detail($id){
        $user = Auth::user();
        $request_rent_room = DB::table('request_rent_rooms')
            ->where('id' , $id)
            ->where('is_active' , 1)
            ->first();

        return view('user.rent.request_rent_detail_user', ['request_rent_room' => $request_rent_room , 'user' => $user]);
    }
}
