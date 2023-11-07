@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="container">
            <h1 class="my-4">Chi tiết yêu cầu thuê phòng số: {{ $request->id }}</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('admin_update_status_rent_room') }}">
                @csrf
                <div class="mb-3 row" style="margin: 5px">
                    <input type="hidden" value="{{$request->id}}" name="request_id">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Họ tên khách hàng:</label>
                        <input placeholder="{{$request->customer}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Phòng muốn thuê:</label>
                        <input placeholder="{{$request->room_code}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số điện thoại:</label>
                        <input placeholder="{{$request->phone_number}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số căn cước công dân:</label>
                        <input placeholder="{{$request->personal_id}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Ngày bắt đầu thuê:</label>
                        <input placeholder="{{$request->start_date}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Ngày hết thúc thuê:</label>
                        <input placeholder="{{$request->end_date}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Mức giá cho thuê:</label>
                        <input placeholder="{{$request->price}}" class="form-control" id="price" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số người ở:</label>
                        <input placeholder="{{$request->amount_of_people}}" class="form-control" id="amount_of_people" required disabled>
                    </div>
                </div>
                <div class="mb-3" style="margin: 10px">
                    <label for="request_content" style="margin-left: 10px" class="form-label">Yêu cầu thêm của khách hàng</label>
                    <input placeholder="{{$request->note}}" class="form-control" id="note" required disabled>
                </div>
                <div style="bottom: 10px; right: 10px">
                    <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-outline-success">Chấp nhận yêu cầu</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin_list_request_rent') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
