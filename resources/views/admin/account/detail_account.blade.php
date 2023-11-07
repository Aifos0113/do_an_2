@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="container">
            <h1 class="my-4">Chi tiết tài khoản: {{ $account->name }}</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('admin_update_account') }}">
                @csrf
                <div class="mb-3 row" style="margin: 5px">
                    <input type="hidden" value="{{$account->id}}" name="account_id">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Tên khách hàng</label>
                        <input placeholder="{{$account->name}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Email</label>
                        <input placeholder="{{$account->email  }}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số điện thoại</label>
                        <input placeholder="{{$account->sdt}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số chứng minh thư</label>
                        <input placeholder="{{$account->cccd}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Ngày tạo tài khoản</label>
                        <input placeholder="{{$account->created_at}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Sinh nhật</label>
                        <input placeholder="{{$account->ngay_sinh}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Đổi quyền người dùng</label>
                        <select class="form-control"  name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div style="bottom: 10px; right: 10px">
                    <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin_list_account') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection

