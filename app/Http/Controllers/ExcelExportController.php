<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\Furniture;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Pay;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class ExcelExportController extends Controller
{
    //
    public function export_bill(){
        // Lấy dữ liệu từ bảng "pays" trong database
        $data = Pay::where('is_active', 1)->get();

        // Tạo một đối tượng Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Tạo một trang tính mới
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt tiêu đề cho cột
        $sheet->setCellValue('A1', 'Tháng');
        $sheet->setCellValue('B1', 'Mã Phòng');
        $sheet->setCellValue('C1', 'Tiền Phòng');
        $sheet->setCellValue('D1', 'Số Điện');
        $sheet->setCellValue('E1', 'Tiền Nước');
        $sheet->setCellValue('F1', 'Tiền Mạng');
        $sheet->setCellValue('G1', 'Tiền Khác');
        $sheet->setCellValue('H1', 'Tổng Tiền');
        $sheet->setCellValue('I1', 'Ghi Chú');
        $sheet->setCellValue('J1', 'Đã Thanh Toán');
        $sheet->setCellValue('K1', 'Trạng Thái');

        // Lặp qua dữ liệu từ database và đổ dữ liệu vào file Excel
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->thang);
            $sheet->setCellValue('B' . $row, $item->room_code);
            $sheet->setCellValue('C' . $row, $item->tien_phong);
            $sheet->setCellValue('D' . $row, $item->so_dien);
            $sheet->setCellValue('E' . $row, $item->tien_nuoc);
            $sheet->setCellValue('F' . $row, $item->tien_mang);
            $sheet->setCellValue('G' . $row, $item->tien_khac);
            $sheet->setCellValue('H' . $row, $item->tong_tien);
            $sheet->setCellValue('I' . $row, $item->note);
            $sheet->setCellValue('J' . $row, $item->da_thanh_toan);
            $sheet->setCellValue('K' . $row, $item->is_active);
            $row++;
        }

        // Tạo một đối tượng Writer để xuất file Excel
        $writer = new Xlsx($spreadsheet);

        // Thiết lập header cho tệp xuất
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="pays.xlsx"');

        // Ghi tệp Excel vào đầu ra
        $writer->save('php://output');
    }

    // Import bill
    public function import_bill(Request $request){
        $file = $request->file('excel_file');

        // Kiểm tra xem có tệp được tải lên không
        if (!$file) {
            return redirect()->route('list_pay')->with('error', 'Chưa chọn tệp Excel.');
        }

        // Đọc tệp Excel
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
//        dd($rows);
        // Bỏ qua hàng đầu tiên (tiêu đề)
        array_shift($rows);

        // Lặp qua dữ liệu từ Excel và lưu vào database
        foreach ($rows as $row) {
            $thang = $row[0];
            $room_code = $row[1];
            $so_dien_moi = intval($row[2]);
            $so_tien_khac = intval($row[3]);
            $so_tien_da_tra = $row[4];
            $note = $row[5];

            $hop_dong = DB::table('tenacies')
                ->where('is_active' ,1 )
                ->where('room_code' , $room_code)
                ->value('tenacy_id');
            // Xử lý tiền điện

            // Lấy số điện tháng trước
            $so_dien_cu = DB::table('rooms')
                ->where('room_code' , $room_code)
                ->select('so_dien_thang_nay')
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

            // Sau khi đã xử lý dữ liệu, tạo một bản ghi trong bảng "pays"
            Pay::create([
                'thang' => now(),
                'so_dien' => $tien_dien, // Số tiền điện sau khi xử lý
                'tien_nuoc' => $tien_nuoc, // Số tiền nước sau khi xử lý
                'tien_mang' => $tien_mang, // Số tiền mạng sau khi xử lý
                'tien_khac' => $so_tien_khac,
                'da_thanh_toan' => $so_tien_da_tra,
                'tien_phong' => $tien_phong, // Giá tiền phòng sau khi xử lý
                'room_code' => $room_code,
                'note' => $note,
                'tanancy' => $hop_dong,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('list_pay')->with('success', 'Dữ liệu đã được nhập thành công từ tệp Excel.');
    }

    // Import nội thất
    public function import_furniture(Request $request)
    {
        $file = $request->file('excel_file');

        if (!$file) {
            return redirect()->route('list_pay')->with('error', 'Chưa chọn tệp Excel.');
        }

        // Đọc tệp Excel
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
//        dd($rows);
        // Bỏ qua hàng đầu tiên (tiêu đề)
        array_shift($rows);
        foreach ($rows as $row) {
            $room_code = $row[0];
            $attribute_id = $row[1];
            $value = $row[2];
            $quantity = $row[3];
            $note = $row[4];

            Value::create([
                'room_code' => $room_code,
                'attribute_id' => $attribute_id,
                'value' => $value,
                'quantity' => $quantity,
                'note' => $note,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
        return redirect()->route('furniture')->with('success', 'Dữ liệu đã được nhập thành công từ tệp Excel.');
    }

    // Export list khách hàng
    public function export_furniture(){
        // Lấy dữ liệu từ bảng "pays" trong database
        $data = DB::table('values')
            ->join('attributes', 'values.attribute_id', '=', 'attributes.id')
            ->where('attributes.entity_id', 1)
            ->where('attributes.is_active' , 1)
            ->where('values.is_active', 1)
            ->get();

        // Tạo một đối tượng Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Tạo một trang tính mới
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt tiêu đề cho cột
        $sheet->setCellValue('A1', 'Mã phòng');
        $sheet->setCellValue('B1', 'Mã nội thất');
        $sheet->setCellValue('C1', 'Hãng nội thất');
        $sheet->setCellValue('D1', 'Số lượng');
        $sheet->setCellValue('E1', 'Mô tả chi tiết');
        $sheet->setCellValue('K1', 'Trạng Thái');

        // Lặp qua dữ liệu từ database và đổ dữ liệu vào file Excel
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->room_code);
            $sheet->setCellValue('B' . $row, $item->attribute_id);
            $sheet->setCellValue('C' . $row, $item->value);
            $sheet->setCellValue('D' . $row, $item->quantity);
            $sheet->setCellValue('E' . $row, $item->note);
            $sheet->setCellValue('K' . $row, $item->is_active);
            $row++;
        }

        // Tạo một đối tượng Writer để xuất file Excel
        $writer = new Xlsx($spreadsheet);

        // Thiết lập header cho tệp xuất
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="pays.xlsx"');

        // Ghi tệp Excel vào đầu ra
        $writer->save('php://output');
    }

}
