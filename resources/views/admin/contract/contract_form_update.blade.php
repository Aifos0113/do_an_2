@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1 class="my-4 card-header">  Sửa hợp đồng số: {{ $contracts->tenacy_id }}</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('update_contract') }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contracts->tenacy_id }}">

                        <div class="mb-3">
                            <label for="room_code" class="form-label">Chủ hợp đồng</label>
                            <input type="text" class="form-control" id="room_code" name="customer" placeholder="Viết thường" required>
                        </div>

                        <div class="mb-3">
                            <label for="room_code" class="form-label">Chứng minh thư chủ hợp đồng</label>
                            <input placeholder="Số chứng minh thư" type="number" class="form-control" id="room_code" name="customer_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="room_code" class="form-label">Số điện thoại</label>
                            <input placeholder="Số điện thoại" type="number" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_day" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="start_day" name="start_day" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mã phòng</label>
                            <select class="form-select" id="roomtype" name="room_code" required>
                                @foreach($rooms as $room)
                                   @if ($room->status == 0)  {{-- Chỉ cho phép chọn phòng có trạng thái = 0--}}
                                    <option value="{{ $room->room_code }}">{{ $room->room_code }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Giá thuê</label>
                            <input type="number" step="0.1" class="form-control" id="price" name="price" placeholder="Tiền nhà theo tháng   " required>
                        </div>

                        <div id="customer-details">
                            <!-- Trường nhập thông tin của khách hàng sẽ được thêm vào đây bằng JavaScript -->
                        </div>

                        <div class="mb-3">
                            <label for="rule" class="form-label">Yêu cầu thêm:  </label>
                            <textarea class="form-control" id="rule" name="note" placeholder="Yêu cầu ngoài của khách" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{route('get_contract')}}  " class="btn btn-primary mt-3">Quay lại danh sách</a>
    </div>
@endsection
