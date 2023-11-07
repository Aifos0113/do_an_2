@extends('user.layout_user.app')

@section('content')
    <div class="card">
        <h1>    Danh sách cách nội thất</h1>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Số phòng</th>
                    <th>Loại</th>
                    <th>Hãng</th>
                    <th>Chi tiết</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                    <tbody>
                    @php $count = 1 @endphp <!-- Khởi tạo biến đếm -->

                    @foreach ($noi_that as $value)
                        <tr>
                            <td>{{ $count++ }}</td> <!-- Hiển thị và tăng biến đếm -->
                            <td>{{ $value->room_code }}</td>
                            <td>{{ $attribute[$value->attribute_id] }}</td>
                            <td>{{ $value->value }}</td>
                            <td>{{ $value->note }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>
                                @if($value->is_active == 1)
                                    <p class="badge bg-success">Hoạt động bình thường</p>
                                @else
                                    <p class="badge bg-success">Không sử dụng được</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
        <div>
            <form method="POST" action="{{ route('request_rent_room_user') }}">
                @csrf
                    <div class="mb-3 row" style="margin: 5px">
                        <input value="{{$room->room_code}}" type="hidden" name="room_code">
                        <div class="col-md-6">
                            <label for="room_code" class="form-label">Mã phòng</label>
                            <input placeholder="{{$room->room_code}}" class="form-control" id="room_code" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="room_code" class="form-label">Tên khách thuê</label>
                            <input placeholder="{{$user->name}}" class="form-control" id="room_code" required disabled>
                        </div>
                    </div>
                    <div class="mb-3 row" style="margin: 5px">
                        <div class="col-md-6">
                            <label for="room_code" class="form-label">Căn cước công dân</label>
                            <input placeholder="{{$user->cccd}}" class="form-control" id="room_code" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="room_code" class="form-label">Số điện thoại</label>
                            <input placeholder="{{$user->sdt}}" class="form-control" id="room_code" required disabled>
                        </div>
                    </div>
                    <div class="mb-3 row" style="margin: 5px">
                        <div class="col-md-6">
                            <label for="start_day" class="form-label">Ngày bắt đầu thuê</label>
                            <input type="date" class="form-control" id="start_day" name="start_day" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Ngày trả phòng</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <input type="hidden" value="{{$max_occupancy->max_occupancy}}" name="max_occupancy">
                        <label for="start_day" class="form-label">Số người tối đa</label>
                        <input type="number" class="form-control" id="start_day" value="{{$max_occupancy->max_occupancy }}"  required disabled>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" value="{{$values->value}}" name="tien_phong">
                        <label for="end_date" class="form-label">Giá phòng</label>
                        <input type="text" class="form-control" id="end_date" value="{{ number_format($values->value, 0, ',', '.') }} VND" required disabled>
                    </div>
                </div>
                    <div class="mb-3" style="margin: 10px">
                        <label for="request_content" style="margin-left: 10px" class="form-label">Yêu cầu thêm của bạn</label>
                        <textarea class="form-control" id="rule" name="note" placeholder="Viết các yêu cầu khác của bạn.... " required></textarea>
                    </div>
                    <div style="bottom: 10px; right: 10px">
                        <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-primary">Thuê ngay</button>
                    </div>
            </form>
        </div>
    </div>


@endsection

