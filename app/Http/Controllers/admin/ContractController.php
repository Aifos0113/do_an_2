<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\YourModel;
use App\Models\Customer;
use App\Models\Tenacy;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{

    // Lấy toàn bộ hợp đồng con hiệu lực ---Route::get('/home/contract')
    public function get_all_contract()
    {
        $contracts = DB::table('tenacies')->where('is_active' , 1)->paginate(10);
        $rooms = DB::table('rooms')->orderBy('room_code')->get();
        return view('admin.contract.contract_management', ['contracts' => $contracts , 'rooms'=>$rooms]);
    }

    // Lấy form để tạo hợp đồng mới  ---- Route::get('/home/contract/create_contract_form')
    public function create_contract_form()
    {
        $contracts = Tenacy::where('is_active', 1)->get(); // Lấy toàn bộ hợp đồng còn hoạt động
        $rooms = DB::table('rooms')->orderBy('room_code')->get();
        return view('admin.contract.create_contract', ['contracts' => $contracts , 'rooms'=>$rooms]);
    }

    // Tạo hợp đồng mới  ---  Route::post('home/contract/create_contract')
    public function create_contract(Request $request ,FlasherInterface $flasher)
    {
        // Tạo hợp đồng mới //

        $customer = $request ->input('customer');
        $customer_id = $request->input('customer_id');
        $phone_number = $request ->input('phone_number');
        $start_day = $request ->input('start_day');
        $end_date = $request ->input('end_date');
        $room_code = $request ->input('room_code');
        $so_dien = $request ->input('so_dien');
//        $price = $request ->input('price');
        $note = $request -> input('note');
        $amount_of_people = $request ->input('amount_of_people');
        $customerNames = $request->input('customer_names'); // Mảng chứa tên của các khách hàng
        $customerIds = $request->input('customer_ids'); // Mảng chứa ID của các khách hàng
        $phoneNumbers = $request->input('phone_numbers'); // Mảng chứa số điện thoại của các khách hàng
        $currentYearMonth = date('m/Y');

        $contract_id = 'HD' . $room_code . $customer . $currentYearMonth;

        $price = DB::table('values')
            ->where('room_code', $room_code->room_type)
            ->where('is_active', 1)
            ->select('value')
            ->first();
        // Lặp qua danh sách khách hàng và chèn từng bản ghi vào cơ sở dữ
        if($customerNames)
        {
            for ($i = 0; $i < count($customerNames); $i++) {
                $cus = new Customer(); // Tạo một đối tượng Customer

                // Thiết lập các thuộc tính của đối tượng Customer từ dữ liệu biểu mẫu
                $cus->name = $customerNames[$i];
                $cus->personal_id = $customerIds[$i];
                $cus->phone_number = $phoneNumbers[$i];

                $cus->room_code = $room_code;
                $cus->tenancy = $contract_id;
                // Lưu bản ghi vào cơ sở dữ liệu
                $cus->save();
            }

        }
        $nguoi = DB::table('customers')->insert([
            'name' =>$customer,
            'personal_id' => $customer_id,
            'phone_number' => $phone_number,
            'room_code' =>$room_code,
            'tenancy' => $contract_id,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);

        $update_so_dien = DB::table('rooms')
            ->where('room_code' , $room_code)
            ->update(['so_dien_thang_nay' => $so_dien]);

        $result = DB::table('tenacies')->insert([
            'tenacy_id' => $contract_id,
            'customer' => $customer,
            'phone_number' =>$phone_number,
            'personal_id' =>$customer_id,
            'start_day' => $start_day,
            'end_date' => $end_date,
            'room_code' => $room_code,
            'price' => $price,
            'rule' => $note,
            'amount_of_people' =>$amount_of_people,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if ($result)
        {
            DB::table('rooms')
                ->where('room_code', $room_code)
                ->update(['status' => 1]);

            $flasher->addFlash('success' , "Thêm thành công");
            return redirect()->route('get_contract');

        }
        else {
            $flasher->addFlash('error', "Thêm thất bài");
            return redirect()->route('get_contract');
        }
    }

    // Chi tiết hợp đồng       ----     Route::get('/home/contract/{id}')
    public function contract_show_detail($id)
    {
        $contract = Tenacy::find($id); // Thay Contract bằng tên của model hợp đồng của bạn
        $customer = DB::table('customers')
            ->where('is_active' , 1)
            ->where('tenancy', $contract->tenacy_id)
            ->select('name')
            ->get();

        return view('admin.contract.contract_detail', ['contract' => $contract, 'customer' => $customer]);
    }

    // Xoá hợp đồng theo request     ------   Route::post('home/contract/delete_contract')
    public function delete_contract(Request $request , FlasherInterface $flasher)
    {
        //Buoc 1: tim hop donh theo ma
        // Buoc 2: chuyen trang thai họp dong -> 0 (kết thuc hợp đồng)
        // Buoc3: chuyển phong hop dong do 0-> 1 (phòng trống -> có tể cho thuê)
        //

        $id = $request->input('contract_id');
        $tenancy = Tenacy::find($id);

        if ($tenancy) {
            // Thay đổi giá trị của cột is_active
            $tenancy->is_active = 0; // Đặt giá trị mới (0)

            // Lưu bản ghi đã cập nhật
            $tenancy->save();

            DB::table('rooms')
                ->where('room_code', $tenancy->room_code)
                ->update(['status' => 0]);
            DB::table('customers')
                ->where('tenancy' , $tenancy->tenacy_id)
                ->update(['is_active' => 0]);
            return redirect()->route('get_contract');
            $flasher->addFlash('success' , "Xoá thành công");
        }
        else{
            $flasher->addFlash('error', "Xoá thất bài");
            return redirect()->route('get_contract');
        }
    }


    // Tìm kiếm form        -----        Route::get('/home/contract/search_form')
    public function search_form()
    {
        return view('admin.contract.contract_management');
    }


    // Tìm kiếm theo thời gian    --------     Route::post('/home/contract/search_contract')
    public function search_by_date(Request $request)
    {
        $inputMonth = $request->input('monthInput');

        $startOfMonth = date('Y-m-01', strtotime($inputMonth));

        // Chuyển đổi chuỗi tháng thành định dạng Y-m-d (ngày cuối tháng)
        $endOfMonth = date('Y-m-t', strtotime($inputMonth));
//
        // Thêm năm vào ngày đầu và cuối tháng
//        $startOfMonthWithYear = $inputYear . '-' . date('m-d', strtotime($startOfMonth));
//        $endOfMonthWithYear = $inputYear . '-' . date('m-d', strtotime($endOfMonth));
//
//        $results = YourModel::whereBetween('created_at', [$startOfMonthWithYear, $endOfMonthWithYear])->get();
//
//        return view('your-results-view', compact('results'));
//        echo $inputMonth;
    }

    // Form để cập nhật    -----     Route::get('/home/contract/update_contract_form')
    public function update_contract_form($id)
    {
        $contracts = Tenacy::find($id); // Thay Contract bằng tên của model hợp đồng của bạn
        $rooms = DB::table('rooms')->orderBy('room_code')->get();
        return view('admin.contract.contract_form_update', ['contracts' => $contracts, 'rooms' => $rooms]);
    }

    // Cập nhật hơợp đồng phòng mới
    public function update_contract(Request $request , FlasherInterface $flasher)
    {
        $contract_id = $request->input('contract_id');
        $customer = $request->input('customer');
        $customer_id = $request->input('customer_id');
        $phone_number = $request->input('phone_number');
        $start_day = $request->input('start_day');
        $end_date = $request->input('end_date');
        $room_code = $request->input('room_code');
        $price = $request->input('price');
        $note = $request->input('note');

        $room_code_cu = DB::table('rooms')
            ->join('tenacies', 'rooms.room_code', '=', 'tenacies.room_code')
            ->where('tenacies.tenacy_id', $contract_id)
            ->select('rooms.room_code')
            ->first();

        if($room_code_cu != $room_code) {
            DB::table('rooms')
                ->where('room_code', $room_code_cu->room_code)
                ->update(['status' => 0]);
            DB::table('rooms')
                ->where('room_code', $room_code)
                ->update(['status' => 1]);
        }
        $result = DB::table('tenacies')
            ->where('tenacy_id', $contract_id)
            ->update([
                'customer' => $customer,
                'phone_number' => $phone_number,
                'personal_id' => $customer_id,
                'start_day' => $start_day,
                'end_date' => $end_date,
                'room_code' => $room_code,
                'price' => $price,
                'rule' => $note,
                'updated_at' => now(),
            ]);
        if ($result) {

            $flasher->addFlash('success', "Thêm thành công");
            $update_person = DB::table('customers')
                ->where('tenancy', $contract_id)
                ->update(['room_code' => $room_code]);
            if ($update_person) {
                $flasher->addFlash('success', 'Đổi phòng thành công');
                return redirect()->route('get_contract');
            } else {
                $flasher->addFlash('error', 'Đã xảy ra lỗi khi đổi phòng');
                return redirect()->route('get_contract');
            }

        } else {
            $flasher->addFlash('error', "Thêm thất bài");
            return redirect()->route('get_contract');
        }
    }
}
