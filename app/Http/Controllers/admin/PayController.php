<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Carbon\Carbon;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    // Danh sách hoá đơn
    public function list_pay()
    {
        $data = DB::table('pays')
            ->join('tenacies' , 'pays.room_code' , '=' , 'tenacies.room_code')
            ->where('tenacies.is_active' , 1)
            ->whereIn('pays.is_active', [1, 2])
            ->select(DB::raw("FORMAT(thang, 'dd/MM/yyyy') as month"), 'pays.id' , 'pays.room_code',  'tien_phong', 'so_dien', 'tien_nuoc', 'tien_mang', 'tien_khac', 'tong_tien', 'da_thanh_toan', 'pays.is_active' , 'tenacies.customer')
            ->paginate(10);

//        $data = $query-> // Số 10 là số bản ghi trên mỗi trang, bạn có thể thay đổi nó tùy ý.


        return view('admin.pay.pay', ['data' => $data]);
    }

    // Form tạo hoá đơn
    public function show_create_an_invoice( )
    {
        $rooms = DB::table('rooms')
            ->where('status' , 1)
            ->orderBy('room_code')
            ->get();
        return view('admin.pay.create_pay' , ['rooms' =>$rooms]);
    }

    // Tạo hoá đơn
    public function create_an_invoice(Request $request , FlasherInterface $flasher)
    {

        $room_code = $request ->input('room_code');
        $so_dien_moi = intval($request->input('so_dien'));
        $so_tien_khac = intval($request->input('so_tien_khac'));
        $so_tien_da_tra = $request ->input('so_tien_da_thanh_toan');
        $note = $request ->input('note');


        $hop_dong = DB::table('tenacies')
            ->where('is_active' ,1 )
            ->where('room_code' , $room_code)
            ->select('tenacy_id')
            ->first();

        // Xử lý tiền điện

        // Lấy số điện tháng trước
        $so_dien_cu = DB::table('rooms')
            ->where('rooms.room_code' , $room_code)
            ->select('rooms.so_dien_thang_nay')
            ->first();
        $so_dien_cu = intval($so_dien_cu->so_dien_thang_nay);


        $so_dien_phai_tra = $so_dien_moi - $so_dien_cu;// Tìm số điện tháng này

        // Lấy giá điện
        $gia_dien = DB::table('values')
            ->where('id' , 30 )
            ->select('values.value')
            ->first();
        $gia_dien = intval($gia_dien ->value); // Giá điện theo dạng int

        $tien_dien  =$so_dien_phai_tra * $gia_dien; // Tiền điện

        // Update số điện vào bảng điện
        DB::table('rooms')
            ->where('room_code', $room_code)
            ->update(['so_dien_thang_nay' => $so_dien_moi]);

        DB::table('rooms')
            ->where('room_code' , $room_code)
            ->update(['so_dien' => $so_dien_cu]);


        // Lấy tiền phòng
        $tien_phong =DB::table('tenacies')
            ->where('tenacies.room_code' , $room_code )
            ->select('tenacies.price')
            ->first();

        // Tiền nước
        $so_nguoi_o = DB::table('tenacies')
            ->where('tenacies.is_active' , 1)
            ->where('tenacies.room_code' , $room_code)
            ->select('tenacies.amount_of_people')
            ->first();
        $so_nguoi_o = intval($so_nguoi_o->amount_of_people);
        $gia_nuoc = DB::table('values')
            ->where('values.id', 31)
            ->select('values.value')->first();
        $gia_nuoc = intval($gia_nuoc->value);
        $tien_nuoc = $so_nguoi_o * $gia_nuoc;

        // Tiền mạng
        $gia_mang = DB::table('values')
            ->where('values.id', 32)
            ->select('values.value')->first();
        $gia_mang = intval($gia_mang->value);
        $tien_mang = $so_nguoi_o * $gia_mang;

        $tien_phong = intval($tien_phong->price);

        $pays = DB::table('pays')
            ->join('tenacies' , 'tenacies.room_code' , '=' , 'pays.room_code')
            ->where('is_active' , 1)
            ->insert([
            'thang' => now(),
            'tien_phong' => $tien_phong,
            'so_dien' => $tien_dien,
            'tien_nuoc' => $tien_nuoc,
            'tien_mang' => $tien_mang,
            'tien_khac' => $so_tien_khac,
            'da_thanh_toan' => $so_tien_da_tra,
            'tanancy' => $hop_dong->tenacy_id,
            'room_code' => $room_code,
            'note' =>$note,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if($pays){
            $flasher->addFlash('success', 'Thêm chi phí thành công');
            return redirect()->route('list_pay');
        }
        else
        {
            $flasher->addFlash('error' , 'Thêm chi phí thất bại');
            return redirect()->route('list_pay');
        }

    }

    // Xoá hoá đơn
    public function delete_pays(Request $request , FlasherInterface $flasher)
    {
        //Buoc 1: tim hop donh theo ma
        // Buoc 2: chuyen trang thai họp dong -> 0 (kết thuc hợp đồng)
        // Buoc3: chuyển phong hop dong do 0-> 1 (phòng trống -> có tể cho thuê)
        //

        $id = $request->input('pays_id');
        $pays = Pay::find($id);

        if ($pays) {
            // Thay đổi giá trị của cột is_active
            $pays->is_active = 0; // Đặt giá trị mới (0)

            // Lưu bản ghi đã cập nhật
            $pays->save();

            DB::table('pays')
                ->where('id', $pays->id)
                ->update(['is_active' => 0]);
            return redirect()->route('list_pay');
            $flasher->addFlash('success' , "Đã xoá");
        }
        else{
            $flasher->addFlash('error', "Xoá thất bài");
            return redirect()->route('list_pay');
        }
    }

    // Tìm hoá đơn theo tháng
    public function search_pays_by_month(Request $request, $months)
    {
        // Lấy thời gian hiện tại
        $currentDate = now();
        $endDate = $currentDate;
        $month = $months;

        // Tính thời gian bắt đầu (khoảng thời gian tương ứng) và kết thúc (hiện tại)
        $startDate = $currentDate->copy()->subMonths($months);

        // Truy vấn dữ liệu với điều kiện WHERE để lọc theo thời gian
        $result = Pay::where('thang', '>=', $startDate)
            ->where('thang', '<=', $endDate)
            ->join('tenacies', 'pays.room_code', '=', 'tenacies.room_code')
            ->where('tenacies.is_active', 1)
            ->whereIn('pays.is_active', [1, 2])
            ->select(DB::raw("FORMAT(thang, 'MM/yyyy') as month"), 'pays.id', 'pays.room_code', 'tong_tien', 'da_thanh_toan', 'pays.is_active', 'tenacies.customer')
            ->get();

        // Trả về view hiển thị kết quả
        return view('admin.pay.pay_by_month', ['result' => $result , 'month' => $month]);
    }


    // Form cập nhật hoá đơn
    public function update_pay_form($id){
        $pays = Pay::find($id);
        $customer = DB::table('tenacies')
            ->join('pays' , 'pays.room_code' , '=' , 'tenacies.room_code')
            ->where('pays.is_active' , 1)
            ->where('tenacies.is_active' ,1)
            ->select('customer')
            ->first();
        return view('admin.pay.update_pay_form' , ['pays' => $pays , 'customer' => $customer]);
    }

    // Cập nhật hoá đơn
    public function update_pay(Request $request , FlasherInterface $flasher)
    {
        $so_dien = intval($request->input('so_dien'));
        $chi_phi_khac = $request->input('so_tien_khac');
        $tien_da_thanh_toan = $request->input('so_tien_da_thanh_toan');
        $note = $request->input('note');
        $room_code = $request->input('room_code');
        $pay_id = $request->input('pay_id');

        // Lấy số điện tháng trước
        $so_dien_cu = DB::table('rooms')
            ->where('rooms.room_code' , $room_code)
            ->select('rooms.so_dien')
            ->first();
        $so_dien_cu = intval($so_dien_cu->so_dien);


        $so_dien_phai_tra = $so_dien- $so_dien_cu;// Tìm số điện tháng này

        // Lấy giá điện
        $gia_dien = DB::table('values')
            ->where('id' , 30 )
            ->select('values.value')
            ->first();
        $gia_dien = intval($gia_dien ->value); // Giá điện theo dạng int

        $tien_dien  =$so_dien_phai_tra * $gia_dien; // Tiền điện

        $update_so_dien = DB::table('rooms')
            ->where('status', 1)
            ->where('room_code' , $room_code)
            ->update(['so_dien_thang_nay' => $so_dien]);
        $result = DB::table('pays')
            ->where('id', $pay_id)
            ->update([
                'tien_khac' => $chi_phi_khac,
                'da_thanh_toan' => $tien_da_thanh_toan,
                'note' => $note,
                'so_dien' => $tien_dien,
                'updated_at' => now(),
            ]);
        $record = DB::table('pays')->where('id', $pay_id)->first();

        if ($record) {
            if ($record->da_thanh_toan == $record->tong_tien) {
                DB::table('pays')->where('id', $pay_id)->update(['is_active' => 2]);
            }
        }
        if($result)
        {
            $flasher->addFlash('success' , 'Cập nhật hoá đơn thành công');
            return redirect()->route('list_pay');
        }else{
            $flasher->addFlash('error' , 'Cập nhật hoá đơn phòng thất bai');
            return redirect()->route('list_pay');
        }

    }

    // Chi tiết hoá đơn
    public function pay_detail($id)
    {
        $pays = Pay::find($id);

        $tenacies = DB::table('tenacies')
            ->join('pays' , 'pays.room_code' , '=' , 'tenacies.room_code')
            ->where('tenacies.is_active' , 1)
            ->where('pays.is_active' ,1)
            ->first();
        $so_dien = DB::table('rooms')
            ->where('status' , 1)
            ->where('room_code' , $pays->room_code)
            ->select('so_dien', 'so_dien_thang_nay')
            ->first();
        $so_dien_cu = intval($so_dien->so_dien);
        $so_dien_moi = intval($so_dien->so_dien_thang_nay);
        $so_dien_su_dung = $so_dien_moi - $so_dien_cu;
        $gia_dien = DB::table('values')
            ->where('id' , 30 )
            ->select('values.value')
            ->first();
        $gia_nuoc = DB::table('values')
            ->where('id' , 31)
            ->select('values.value')
            ->first();
        $gia_mang  =DB::table('values')
            ->where('id' , 32)
            ->select('values.value')
            ->first();
        return view('admin.pay.pay_detail', ['pays' => $pays ,'tenacies'=>$tenacies, 'so_dien_su_dung' => $so_dien_su_dung , 'so_dien' => $so_dien , 'gia_dien' =>$gia_dien , 'gia_nuoc' =>$gia_nuoc , 'gia_mang' => $gia_mang]);
    }
}

