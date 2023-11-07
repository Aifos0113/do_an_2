<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Request;
use App\Models\Tenacy;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request as MyRequest;

use App\Models\RequestRentRoom;
use Illuminate\Support\Facades\DB;

class AdminRequestRentRoomController extends Controller
{
    // Danh sách yêu cầu thuê phòng
    public function list_request_rent(){
        $request = DB::table('request_rent_rooms')
            ->where('is_active' , 1)
            ->where('status', '>', 0) // Loại bỏ các bản ghi có status là 0
            ->orderBy('status', 'asc') // Sắp xếp theo status tăng dần
            ->paginate(10);
        return view('admin.request_rent_room.list_request_rent_room', ['request' => $request]);
    }

    // Chi tiết yêu cầu thuê phòng
    public function detail_request_rent($id){
        $request_rent = RequestRentRoom::find($id);
        return view('admin.request_rent_room.detail_request_rent' , ['request' =>$request_rent]);
    }

    // Cập nhật trạng thái yêu cau thue phòng
    public function update_status_rent_room(MyRequest $request , FlasherInterface $flasher){
        $request_id = $request->input('request_id');
        $requests = RequestRentRoom::find($request_id);
        $requests->status = 2;
        $requests->save();
        $flasher ->addFlash('success' , 'Đã chấp nhận yêu cầu thuê phòng, chờ thanh toán');

        return redirect()->route('admin_list_request_rent');


    }
    // Xử lý yêu cầu thuê phòng
    public function update_request_rent_form(MyRequest $request , $id)
    {
        $request_rent = RequestRentRoom::find($id);
        return view('admin.request_rent_room.update_form_request_rent' , ['request' =>$request_rent]);
    }

    // Xử lý yêu cầu thuê phòng
    public function update_request_rent(MyRequest $request , FlasherInterface $flasher)
    {
        $id = $request->input('request_id');
        $customerNames = $request->input('customer_names'); // Mảng chứa tên của các khách hàng
        $customerIds = $request->input('customer_ids'); // Mảng chứa ID của các khách hàng
        $phoneNumbers = $request->input('phone_numbers'); // Mảng chứa số điện thoại của các khách hàng
        $record = DB::table('request_rent_rooms')
            ->where('id' , $id)
            ->first();

        $room_code  = $record->room_code;
        $customer = $record->customer;
        $currentYearMonth = date('m/Y');
        $contract = 'HD' . $room_code . $customer . $currentYearMonth;
        if($customerNames){
            for ($i = 0; $i < count($customerNames); $i++) {
                $cus = new Customer(); // Tạo một đối tượng Customer

                // Thiết lập các thuộc tính của đối tượng Customer từ dữ liệu biểu mẫu
                $cus->name = $customerNames[$i];
                $cus->personal_id = $customerIds[$i];
                $cus->phone_number = $phoneNumbers[$i];

                $cus->room_code = $room_code;
                $cus->tenancy = $contract;
                // Lưu bản ghi vào cơ sở dữ liệu
                $cus->save();
            }
        }
        $personal_id = DB::table('users')
            ->where('cccd' , $record->personal_id)
            ->first();
        if ($personal_id)
        {
            DB::table('users')
                ->update(['is_active' =>1])
                ->update(['room_code'=>$room_code]);
        } else{
            DB::table('customers')->insert([
                'name' =>$customer,
                'is_active' =>1,
                'personal_id' => $record->personal_id,
                'phone_number' => $record->phone_number,
                'room_code' =>$room_code,
                'tenancy' => $contract,
                'created_at' => now(), // Thời gian tạo
                'updated_at' => now(), // Thời gian cập nhật
            ]);
        }
        $result = DB::table('tenacies')->insert([
            'tenacy_id' => $contract,
            'customer' => $customer,
            'phone_number' =>$record->phone_number,
            'personal_id' =>$record->personal_id,
            'start_day' => $record->start_date,
            'end_date' => $record->end_date,
            'room_code' => $room_code,
            'price' => $record->price,
            'rule' => $record->note,
                    'amount_of_people' =>$record->amount_of_people,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if ($result)
        {
            DB::table('rooms')
                ->where('room_code', $room_code)
                ->update(['status' => 1]);
            $record = RequestRentRoom::find($id);
            $record->is_active = 0;
            $record->save();
            $flasher->addFlash('success' , "Thêm thành công");
            return redirect()->route('admin_list_request_rent');

        }
        else {
            $flasher->addFlash('error', "Thêm thất bài");
            return redirect()->route('admin_list_request_rent');
        }
    }

    // Xoá yêu cầu thue phong
    public function delete_request_rent(MyRequest $request , $id , FlasherInterface $flasher){
        $record = RequestRentRoom::find($id);
        $record->is_active = 0;
        $record->status = 0;
        $record->save();
        $flasher->addFlash('success', 'Xoá thành công');
        return redirect()->route('admin_list_request_rent');
    }

    // Hoàn thành yeeu cầu thuê phòng
//    public function done_request_rent(MyRequest $request , $id , FlasherInterface $flasher)
//    {
//        $record = RequestRentRoom::find($id);
//        $tenancy = DB::table('tenacies')
//            ->where('room_code' , $record->room_code)
//            ->where('personal_id' , $record->personal_id)
//            ->update(['is_active'=>1]);
//        if($tenancy)
//        {
//            $flasher ->addFlash('success',  'Thêm hợp đồng thành công');
//        }
//
//    }

}
