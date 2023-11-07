@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Chi tiết hợp đồng: {{$contract->tenacy_id}} </h1>

        <div class="card">
            <div class="card-body">
                <div>
                    <form method="POST" action="{{ route('admin_update_status_rent_room') }}">
                        @csrf
                        <div class="mb-3 row" style="margin: 5px">
                            <input type="hidden" value="{{$contract->id}}" name="request_id">
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Chủ hợp đồng:</label>
                                <input placeholder="{{$contract->customer}}" class="form-control" id="room_code" required disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Phòng muốn thuê:</label>
                                <input placeholder="{{$contract->room_code}}" class="form-control" id="room_code" required disabled>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin: 5px">
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Số điện thoại:</label>
                                <input placeholder="{{$contract->phone_number}}" class="form-control" id="room_code" required disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Số căn cước công dân:</label>
                                <input placeholder="{{$contract->personal_id}}" class="form-control" id="room_code" required disabled>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin: 5px">
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Ngày bắt đầu thuê:</label>
                                <input placeholder="{{$contract->start_day}}" class="form-control" id="room_code" required disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Ngày hết thúc thuê:</label>
                                <input placeholder="{{$contract->end_date}}" class="form-control" id="room_code" required disabled>
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin: 5px">
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Mức giá cho thuê:</label>
                                <input placeholder="{{$contract->price}}" class="form-control" id="price" required disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="room_code" class="form-label">Số người ở:</label>
                                <input placeholder="{{$contract->amount_of_people}}" class="form-control" id="amount_of_people" required disabled>
                            </div>
                        </div>
                            <div class="mb-3" style="margin: 10px">
                                <label for="request_content" style="margin-left: 10px" class="form-label">Danh sách khách hàng</label>
                                @foreach ($customer as $customer)
                                    <br>
                                <input placeholder="{{$customer->name}}" class="form-control" id="note" required disabled>
                                @endforeach
                            </div>
                        <div class="mb-3" style="margin: 10px">
                            <label for="request_content" style="margin-left: 10px" class="form-label">Yêu cầu thêm của khách hàng</label>
                            <input placeholder="{{$contract->rule}}" class="form-control" id="note" required disabled>
                        </div>
                        <div style="bottom: 10px; right: 10px">
                            <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-outline-success">Chỉnh sửa hợp đồng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('get_contract') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
    </div>
@endsection
