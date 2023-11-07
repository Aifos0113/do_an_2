<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request as MyRequest;
use App\Models\Request;
use Illuminate\Support\Facades\DB;

class AdminRequestFixController extends Controller
{
    // Danh sách yêu cầu sửa chữa , lap đặt
    public function list_request_fix()
    {
        $record = DB::table('requests')
            ->orderBy('status', 'asc') // Sắp xếp theo status tăng dần (status = 0 sẽ ưu tiên đầu tiên)
            ->get();
        return view('admin.request_fix.list_request_fix' , ['request_fix' => $record]);
    }

    // Hoàn thành yêu cầu
    public function done_status_request(MyRequest $request, $id )
    {
        $requests = Request::find($id);
        $requests->status = 2;
        $requests->created_at = now();
        $requests->save();
        return redirect()->route('list_request_fix_admin');
    }

    // Chi tiết yêu cầu
    public function detail_request_fix($id)
    {
        $requests = Request::find($id);
//        $nguoi_sua_chua = DB::table('values')
//            ->join('attributes' , 'attributes.id' ,'=' , 'values.attribute_id')
//            ->where('attributes.entity_id' , 4)
//            ->where('attributes.is_active' , 1)
//            ->where('values.is_active' ,1 )
//            ->select('attributes.name' , 'values.value')
//            ->get();

        $attribute_and_values = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->where('attributes.entity_id' , 4)
            ->where('attributes.is_active' , 1)
            ->where('values.is_active' ,1 )
            ->select('attributes.name', 'values.value')
            ->get();

//        $attribute = [];
//
//        foreach ($attribute_name as $item) {
//            $attribute[$item->name] = $item->value;
//        }
        return view('admin.request_fix.detail_request_fix' , ['request' => $requests , 'attribute_and_values' =>$attribute_and_values]);
    }

    public function update_request_fix(MyRequest $request , FlasherInterface $flasher)
    {
        $request_id = $request->input('request_id');
        $nvsc = $request->input('nhan_vien_sua_chua');
        $note = $request->input('note');
        $requests = Request::find($request_id);

        if ($requests) {
            $requests->update([
                'status' => 1,
                'repair_person' => $nvsc,
                'note' => $note,
                'updated_at' => now(),
            ]);
            $flasher ->addFlash('success' , 'Cập nhật trạng thái thành công');
            return redirect()->route('list_request_fix_admin');


            // Cập nhật thành công
        } else {
            // Xử lý trường hợp không tìm thấy dữ liệu với $request_id
            $flasher->addFlash('error' , 'Có sai sót khi cập nhật dữ liệu');
            return redirect()->route('list_request_fix_admin');
        }

    }
}
