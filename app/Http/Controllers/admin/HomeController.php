<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Room_type;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $roomtypes; // Sửa tên biến thành $roomtypes
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->roomtypes = DB::table('room_types')->get(); // Sửa $this->$roomtype thành $this->roomtypes
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function get_dashboard()
    {
        $so_phong  = DB::table('rooms')->count();
        $so_phong_trong = DB::table('rooms')->where('status', 0)->count();
        $so_nguoi = DB::table('customers')->where('is_active', 1)->count();
        $doanh_thu = DB::table('pays')
            ->where('is_active', 2)
            ->sum('da_thanh_toan');


        return view('admin.home.dashboard', compact('so_phong', 'so_nguoi', 'so_phong_trong', 'doanh_thu'));
    }


    // Hiển thị phòng trống
    public function getRoomsWithStatusZero() {
        $rooms = Room::where('status', 0)->orderBy('room_code')->get();
        $phongtrong = DB::table('rooms')
            ->join('room_types' , 'rooms.room_type', '=', 'room_types.room_type' )
            ->select('room_types.max_occupancy', 'rooms.room_code')->get();
        $maxOccupancyByRoomCode = [];

        foreach ($phongtrong as $item) {
            $maxOccupancyByRoomCode[$item->room_code] = $item->max_occupancy;
        }
        return view('admin.home.home', ['rooms' => $rooms , 'roomtypes' => $this -> roomtypes ,'max_occupancy' => $maxOccupancyByRoomCode]);
    }

    public function search_room(Request $request , FlasherInterface $flasher){

    }
    // Thêm phòng mới
    public function create_room(Request $request, FlasherInterface $flasher)
    {
        $room_code = $request ->input('room_code');
        $room_type = $request ->input('room_type');

        $roomCode = 'P' . $room_code;
        $result = DB::table('rooms')->insert([
            'room_code' => $roomCode,
            'room_type' => $room_type,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if ($result)
        {
            $flasher->addFlash('success' , "Thêm thành công");
            return redirect() -> route('home_admin');

        }
        else {
            $flasher->addFlash('error', "Thêm thất bài");
            return redirect()->route('home_admin');
        }
    }
    // Cập nhật phòng
    public function update_room(Request $request , FlasherInterface $flasher)
    {
//        dd($request->all());
////         Lấy thông tin phòng cần cập nhật dựa vào roomCode
        $room_cu_nhap = $request->input('room_code'); // Lấy room_code_cũ
        $room_code_moi = $request ->input('room_code_new'); // Lấy room_code_mố
        $roomCode = 'P'. $room_cu_nhap; // Lấyd đúng định dạng room_code_cũ
//      Kiểm tra có room_code_cu tồn tại
        $room_cu = Room::where('room_code', $roomCode)->first();

        //Lấy room_code_moi đúng định dạng
        $room_moi = 'P'.$room_code_moi;

        $room_type_moi = $request->input('room_type');
        if(!$room_cu) {
            $flasher->addFlash('error', 'Cập nhật thất bại ');
            return redirect() -> route('home_admin');
        }
        else
            {
            Room::where('room_code', $roomCode)->update(['room_code' => $room_moi]);
            Room::where('room_code', $roomCode)->update(['room_type' => $room_type_moi]);
            $flasher->addFlash('success', 'Cập nhật thành công!');
            return redirect() -> route('home_admin');
        }
    }

    // Tạo 1 loại phòng mới
    function create_room_type(Request $request , FlasherInterface $flasher)
    {
        $room_type = $request->input('room_type');
        $max_occupancy = $request->input('max_occupancy');

        $room_type_check = Room_type::where('room_type', $room_type)->first();
        if (!$room_type_check) {
            $result = DB::table('room_types')->insert([
                'room_type' => $room_type,
                'max_occupancy' => $max_occupancy,
                'created_at' => now(), // Thời gian tạo
                'updated_at' => now(), // Thời gian cập nhật
            ]);
            if ($result) {
                $flasher->addFlash('success', "Thêm thành công");
                return redirect()->route('home_admin');

            } else {
                $flasher->addFlash('error', "Thêm thất bài");
                return redirect()->route('home_admin');

            }
        } else {
            $flasher->addFlash('error', "Đã có loại phòng này");
            return redirect()->route('home_admin');

        }
    }

    // Hiển thị phòng đã có khách
    public function take_room_with_guests()
    {
        $rooms = Room::where('status', 1)->orderBy('room_code')->get();
        $phongtrong = DB::table('rooms')
            ->join('room_types' , 'rooms.room_type', '=', 'room_types.room_type' )
            ->join('tenacies' , 'tenacies.room_code', '=', 'rooms.room_code')
            ->where('tenacies.is_active' ,1)
            ->select('room_types.max_occupancy', 'rooms.room_code','tenacies.customer')->get();
        $maxOccupancyByRoomCode = [];
        $customer = [];

        foreach ($phongtrong as $item) {
            $maxOccupancyByRoomCode[$item->room_code] = $item->max_occupancy;
        }
        foreach ($phongtrong as $item){
            $customer[$item->room_code] = $item->customer;
        }

        return view('admin.home.take_room_with_guest', ['rooms' => $rooms , 'roomtypes' => $this -> roomtypes, 'customer'=> $customer ,'max_occupancy' => $maxOccupancyByRoomCode]);
    }

    // Hiện thị phòng đang sửa
    public function take_room_under_maintenance(FlasherInterface $flasher){
        $rooms = Room::where('status', 1)->orderBy('room_code')->get();
        $phongtrong = DB::table('rooms')
            ->join('room_types' , 'rooms.room_type', '=', 'room_types.room_type' )
            ->join('tenacies' , 'tenacies.room_code', '=', 'rooms.room_code')
            ->select('room_types.max_occupancy', 'rooms.room_code','tenacies.customer')->get();
        if ($rooms){
            $flasher->addFlash('info', 'Không có phòng nào ');
            return view('admin.home.under_maintenance');
        }
        else{
            return view('admin.home.under_maintenance');


        }
    }

}
