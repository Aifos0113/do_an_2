<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function get_information_customer(Request $request)
    {

    }
    public function get_customer_active()
    {
        $data = Customer::where('is_active', 1)->orderBy('room_code')->paginate(10); // Lấy toàn bộ hợp đồng còn hoạt động
        return view('admin.customer.customer', ['data' => $data]);
    }
    public function get_view_add_customer()
    {
        $room = DB::table('rooms')->where('status' , 1)->orderBy('room_code')->get();

        return view('admin.customer.add_customer' , ['rooms' =>$room]);
    }

    public function add_customer(Request $request , FlasherInterface $flasher)
    {
        $customer  = $request ->input('customer');
        $customer_id = $request ->input('customer_id');
        $phone_number = $request ->input('phone_number');
        $room_code   = $request ->input('room_code');
        $tenancy = DB::table('tenacies')
            ->where('tenacies.room_code' , '=' , $room_code )
            ->where('is_active', '=' , 1)
            ->select('tenacy_id' )
            ->first();
        $record = DB::table('customers')->insert([
            'name' => $customer,
            'personal_id' => $customer_id,
            'phone_number' =>$phone_number,
            'tenancy' =>$tenancy->tenacy_id,
            'room_code' => $room_code,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if ($record) {
            // Truy vấn để lấy giá trị hiện tại của 'amount_of_people'
            $people_in_room = DB::table('tenacies')
                ->where('tenacy_id', $tenancy->tenacy_id)
                ->value('amount_of_people');

            // Kiểm tra xem có dữ liệu không
            if ($people_in_room !== null) {
                // Tăng giá trị 'amount_of_people' lên 1
                $newPeopleCount = $people_in_room + 1;

                // Cập nhật giá trị mới vào bảng 'tenancies'
                DB::table('tenacies')
                    ->where('tenacy_id', $tenancy->tenacy_id)
                    ->update(['amount_of_people' => $newPeopleCount]);

                $flasher->addFlash('success', 'Thêm thành công');
                return redirect()->route('get_customer_active');
            }
        }
        else
        {
            $flasher->addFlash('error' , 'Thêm thất bại');
            return redirect()->route('get_customer_active');
        }
    }

    // Chi tiết khách hàng
    public function customer_detail($id){
        $customer = Customer::find($id);
        return view('admin.customer.customer_detail' , ['customer' =>$customer]);
    }

    // Xoá khách hàng
    public function delete_customer(Request $request , FlasherInterface $flasher){


        $id = $request->input('customer_id');
        $customer = Customer::find($id);

        if ($customer) {
            // Thay đổi giá trị của cột is_active
            $customer->is_active = 0; // Đặt giá trị mới (0)
            $customer->save();

            $so_nguoi = DB::table('tenacies')
                ->where('tenacy_id', $customer->tenancy)
                ->select('tenacies.amount_of_people')
                ->first();
            $so_nguoi = intval($so_nguoi->amount_of_people);
            $so_nguoi_update = $so_nguoi - 1;
            DB::table('tenacies')
                ->where('tenacy_id', $customer->tenancy)
                ->update(['amount_of_people' => $so_nguoi_update]);

            // Lưu bản ghi đã cập nhật
            $flasher->addFlash('success' , "Xoá thành công");
            return redirect()->route('get_customer_active');

        }
        else{
            $flasher->addFlash('error', "Xoá thất bài");
            return redirect()->route('get_customer_active');
        }
    }

    // Form cập nhật người dụng
    public function update_customer_form($id){
        $customer = Customer::find($id);
        $rooms = DB::table('rooms')->where('status' , 1)->orderBy('room_code')->get();
        return view('admin.customer.update_customer_form' ,['customer' => $customer , 'rooms'=>$rooms ]);
    }

    // Cập nhật khách hàng
    public function update_customer(Request $request , FlasherInterface $flasher)
    {
        $customer  = $request ->input('customer');
        $customer_id = $request ->input('customer_id');
        $phone_number = $request ->input('phone_number');
        $room_code   = $request ->input('room_code');
        $tenancy = DB::table('tenacies')
            ->where('tenacies.room_code' , '=' , $room_code )
            ->where('is_active', '=' , 1)
            ->select('tenacy_id' )
            ->first();
        $record = DB::table('customers')->update([
            'name' => $customer,
            'personal_id' => $customer_id,
            'phone_number' =>$phone_number,
            'tenancy' =>$tenancy->tenacy_id,
            'room_code' => $room_code,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if($record) {
            // Truy vấn để lấy giá trị hiện tại của 'amount_of_people'
            $flasher->addFlash('success', 'Cập nhật thành công');
            return redirect()->route('get_customer_active');
        }
        else
        {
            $flasher->addFlash('error' , 'Cập nhật thất bại');
            return redirect()->route('get_customer_active');
        }
    }
}
