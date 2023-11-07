@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="container">
            <h1 class="my-4">Cập nhật thợ sửa: {{ $repairer->value }}</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('admin_update_repairer') }}">
                @csrf
                <div class="mb-3 row" style="margin: 5px">
                    <input type="hidden" value="{{$repairer->id}}" name="request_id">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Tên thợ sửa chữa:</label>
                        <input placeholder="Tên cũ: {{$repairer->value}}" class="form-control" id="room_code" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số điện thoại</label>
                        <input placeholder="Sđt cũ: {{$repairer->note}}" type="number" class="form-control" id="room_code" name="phone_number" required>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Nhân viên sửa chữa</label>
                        <select class="form-control" id="room_code" name="chuc_vu" required>
                            @foreach($attribute_and_values as $item)
                                <option value="{{ $item->attribute_id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Trạng thái</label>
                        <select class="form-control" id="room_code" name="is_active" required>
                            <option value="1">Hoạt động bình thường</option>
                            <option value="0">Dừng hoạt động</option>
                        </select>
                    </div>
                </div>

                <div style="bottom: 10px; right: 10px">
                    <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('admin_list_repairer') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
