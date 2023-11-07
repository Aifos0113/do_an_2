<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\YourModel;
use Illuminate\Http\Request as MyRequest;
use App\Models\Request;

use Flasher\Prime\FlasherInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestUserController extends Controller
{

    // Danh sách yêu cầu của khách
    public function list_request()
    {
        $user = Auth::user();
        $room_code = DB::table('tenacies')
            ->join('users' , 'tenacies.personal_id' , '=' , 'users.cccd')
            ->where('tenacies.personal_id' , $user->cccd)
            ->select('room_code')
            ->first();
        if($room_code)
        {
            $requests = DB::table('requests')
                ->where('room_code' , $room_code->room_code)
                ->get();
            return view('user.request.list_request_user' , ['requests' => $requests , 'user' => $user]);
        }
        else
        {
            $requests = DB::table('requests')
                ->where('status' , 4)
                ->get();
            return view('user.request.list_request_user' , ['requests' => $requests, 'user' =>$user]);
        }

    }

    // From thêm yêu cầu
    public function create_request_form()
    {
        $user = Auth::user();
        return view('user.request.create_request_user' , ['user' => $user]);
    }

    // Xử lý thêm yêu cầu
    public function create_request(MyRequest $request , FlasherInterface $flasher)
    {
        $request_user = $request->input('request_user'); // hoặc $request->room_code
        $user = Auth::user();

        $room_code = DB::table('users')
            ->join('tenacies' , 'users.cccd' , '=' , 'tenacies.personal_id')
            ->where('tenacies.personal_id' , $user->cccd)
            ->where('tenacies.is_active' ,1)
            ->select('tenacies.room_code')
            ->first();

        $record = DB::table('requests')->insert([
            'room_code' => $room_code->room_code,
            'request_date' => now(),
            'content_request' => $request_user,
            'status' => 1,
            'created_at' => now(), // Thời gian tạo
            'updated_at' => now(), // Thời gian cập nhật
        ]);
        if($record)
        {
            $flasher->addFlash('success' , 'Thêm yêu cầu thành công');
            return redirect()->route('list_request_user');
        }else{
            $flasher->addFlash('error' , 'Có lỗi khi thêm yêu cầu');
            return redirect()->route('list_request_user');
        }
    }

    public function update_request_form($id)
    {
        $user = Auth::user();
        $request = Request::find($id);
        return view('user.request.update_request_form' , ['request' => $request, 'user' => $user ]);
    }
    public function update_request(MyRequest $request  ,FlasherInterface $flasher)
    {
        $request_user = $request->input('request_user'); // hoặc $request->room_code
        $request_id = $request->input('request_id');

        $record = DB::table('requests')
            ->where('id' , $request_id)
            ->update([
            'content_request' => $request_user,
            'updated_at' => now(), // Thời gian cập nhật
        ]);

//        dd($record);
        if($record)
        {
            $flasher->addFlash('success' , 'Thêm yêu cầu thành công');
            return redirect()->route('list_request_user');
        }else{
            $flasher->addFlash('error' , 'Có lỗi khi thêm yêu cầu');
            return redirect()->route('list_request_user');
        }
    }
    public function delete_request($id)
    {
        $request = Request::find($id);

        $request->status = 0;

        $request->save();
        return redirect()->route('list_request_user');
    }


}
