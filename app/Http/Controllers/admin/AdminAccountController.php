<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAccountController extends Controller
{
    // Danh sách tài khoản
    public function list_account()
    {
        $accounts = DB::table('users')
            ->orderByRaw("CASE WHEN role = 'admin' THEN 1 ELSE 2 END")
            ->paginate(9);


        return view('admin.account.list_account', ['accounts' =>$accounts]);
    }

    // Chi tiết tài khoản
    public function detail_account($id)
    {
        $account = User::find($id);
        return view('admin.account.detail_account', ['account'=>$account]);
    }

    // Update tài khoản
    public function update_account(Request $request, FlasherInterface $flasher)
    {
        $account_id = $request->input('account_id');
        $role = $request->input('role');
        $account = DB::table('users')
            ->where('id', $account_id)
            ->update(['role' => $role]);
        if($account){
            $flasher ->addFlash('success' , 'Phân quyền thành công');
            return redirect()->route('admin_list_account');
        }else{
            $flasher ->addFlash('error' , 'Có lỗi khi phân quyền');
            return redirect()->route('admin_list_account');
        }
    }
    // Delete account
    public function delete_account($id){
        $account = User::find($id);

    }
}
