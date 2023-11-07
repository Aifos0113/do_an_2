@extends('user.layout_user.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Chi tiết hợp đồng</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">Số phòng: {{ $request_rent_room->room_code }}</p>
                <p class="card-text">Số điện thoại: {{ $request_rent_room->phone_number }}</p>
                <p class="card-text">Ngày thuê: {{ $request_rent_room->start_date }}</p>
                <p class="card-text">Ngày hết hạn: {{ $request_rent_room->end_date }}</p>
                <p class="card-text">Khách thuê: {{ $request_rent_room->customer }}</p>
                <p class="card-text">Giá thuê: {{ $request_rent_room->price }}</p>
                <p class="card-text">Quy định: {{ $request_rent_room->note }}</p>
                <p class="card-text">Trạng thái:
                    @if($request_rent_room->status == 1)
                        <p class="badge bg-info" >Đang yêu cầu</p>
                    @elseif($request_rent_room->status = 2)
                        <p class="badge bg-success">Được phê duyệt</p>
                    @elseif($request_rent_room->status = 3)
                        <p class="badge bg-info">Bổ sung thêm hồ sơ</p>
                    @else
                        <p class="badge bg-danger">Đã bị huỷ bỏ</p>
                    @endif
                    </p>
            </div>
        </div>

        <a href="{{ route('get_contract') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
    </div>
@endsection


