@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><b>Cập nhật hoá đơn:</b> {{$pays->tanancy}} </div>
            <div class="card-header"><b>Người chủ hợp đồng:</b> {{$customer ->customer}}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('update_pay') }}">
                    @csrf
                    <input type="hidden" name="room_code" value="{{ $pays->room_code }}">
                    <input type="hidden" name="pay_id" value="{{ $pays->id }}">

                    <div class="form-group">
                        <label for="so_dien">Số điện tháng này:</label>
                        <input type="number" class="form-control" id="so_dien" placeholder="Số điện tháng này:" name="so_dien" required>
                    </div>

                    <div class="form-group">
                        <label for="so_tien_khac">Chi phí khác:</label>
                        <input type="number" class="form-control" id="so_tien_khac"  placeholder="Chi phí khác:" name="so_tien_khac" required>
                    </div>

                    <div class="form-group">
                        <label for="so_tien_khac">Số tiền đã trả:</label>
                        <input type="number" class="form-control" id="so_tien_khac"  placeholder="Đã thanh toán được" name="so_tien_da_thanh_toan" required>
                    </div>

                    <div class="form-group">
                        <label for="so_tien_khac">Ghi chú:</label>
                        <input type="text" class="form-control" placeholder="Ghi chú về chi phí khác:" id="note" name="note" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <a href="{{ route('list_pay') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
