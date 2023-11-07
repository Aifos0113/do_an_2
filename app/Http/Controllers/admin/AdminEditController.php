<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\VLookup;

class AdminEditController extends Controller
{
    // Danh sách chi phí
    public function list_price(){
        $record = DB::table('values')
            ->join('attributes' , 'attributes.id' , '=' , 'values.attribute_id')
            ->where('attributes.entity_id' , 2)
            ->where('attributes.is_active' , 1)
            ->orderBy('values.is_active' , 'asc')
            ->select('attributes.name', 'values.value' , 'values.note', 'values.is_active' , 'values.id')
            ->paginate(10);
        return view('admin.edit.list_price' , ['record' => $record]);
    }

    // Update price
    public function update_price(Request $request){
        dd($request->all());
    }
    // Danh sách dịch vụ
    public function list_service(){

        return view('admin.edit.list_service');
    }

    // Danh sách thợ sửa chữa
    public function list_repairer(){
        $attribute_and_values = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->where('attributes.entity_id' , 4)
            ->where('attributes.is_active' , 1)
            ->orderBy('is_active', 'desc')
            ->select('attributes.name', 'values.value', 'values.attribute_id' , 'values.note' , 'values.is_active' , 'values.id')
            ->paginate(10);
        return view('admin.edit.list_repairer' , ['attribute_and_values' => $attribute_and_values]);
    }

    // Add thợ sửa chữa
    public function add_repairer(Request $request , FlasherInterface $flasher){
        $name = $request->input('name');
        $cong_viec  = $request->input('attribute_id');
        $sdt = $request->input('sdt');
        $record = DB::table('values')
            ->insert([
                'room_code' => 'PT-goc',
                'attribute_id' => $cong_viec,
                'value' => $name,
                'note' => $sdt,
            ]);
        if($record){
            $flasher->addFlash('success' , 'Thêm thợ sửa chữa thành công');
            return redirect() ->route('admin_list_repairer');
        }else{
            $flasher->addFlash('error' , 'Có lỗi khi thêm thợ');
            return redirect() ->route('admin_list_repairer');
        }
    }

    // Form cập nhật thợ
    public function update_repairer_form($id){
        $attribute_and_values = DB::table('attributes')
            ->join('values', 'attributes.id', '=', 'values.attribute_id')
            ->where('attributes.entity_id' , 4)
            ->where('attributes.is_active' , 1)
            ->select('attributes.name','values.attribute_id' , 'values.value' , 'values.note' , 'values.is_active' , 'values.id')
            ->get();
        $repairer = Value::find($id);
        return view('admin.edit.update_repairer_form' , ['repairer' => $repairer , 'attribute_and_values' => $attribute_and_values]);
    }

    // Cập nhật thợ sửa chữa
    public function update_repairer(Request $request, FlasherInterface $flasher){
        $id = $request->input('request_id');
        $value = $request->input('name');
        $sdt = $request->input('phone_number');
        $chuc_vu = $request->input('chuc_vu');
        $is_active = $request->input('is_active');
        $repairer = Value::find($id);
        $repairer->attribute_id = $chuc_vu;
        $repairer->value = $value;
        $repairer->note = $sdt;
        $repairer->is_active = $is_active;
        $repairer->save();
        $flasher ->addFlash('success', 'Cập nhật thành công');
    }

    // Xoá thợ sửa chưa
    public function delete_repairer(Request $request, $id , FlasherInterface $flasher)
    {
        $repairer = Value::find($id);
        $repairer->is_active = 0;
        $repairer->save();
        $flasher ->addFlash('success' , 'Xoá thành công');
    }
}
