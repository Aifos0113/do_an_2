@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="container">
            <h1 class="my-4">Yêu cầu sữa chữa phòng: {{ $request->room_code }}</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('update_request_fix_admin') }}">
                @csrf
                <div class="mb-3 row" style="margin: 5px">
                    <input type="hidden" value="{{$request->id}}" name="request_id">
                    <input value="{{$request->room_code}}" type="hidden" name="room_code">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Mã phòng</label>
                        <input placeholder="{{$request->room_code}}" class="form-control" id="room_code" required disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Ngày yêu cầu</label>
                        <input placeholder="{{$request->request_date}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Nhân viên sửa chữa</label>
                        <select class="form-control" id="room_code" name="nhan_vien_sua_chua" required>
                            @foreach($attribute_and_values as $item)
                                <option value="{{ $item->value }}">{{ $item->name }} - {{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Ngày cập nhật xử lý</label>
                        <input placeholder="{{$request->updated_at}}" class="form-control" id="room_code" required disabled>
                    </div>
                </div>
                    <div class="col-md-6" style="margin: 15px">
                        <label for="room_code" class="form-label">Mô tả yêu cầu</label>
                        <input placeholder="{{$request->content_request}}" class="form-control" id="room_code" required disabled>
                    </div>

                <div class="mb-3" style="margin: 10px">
                    <label for="request_content" style="margin-left: 10px" class="form-label">Yêu cầu thêm của bạn</label>
                    <textarea class="form-control" id="rule" name="note" placeholder="Viết các yêu cầu khác của bạn.... " required></textarea>
                </div>
                <div style="bottom: 10px; right: 10px">
                    <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('list_request_fix_admin') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
