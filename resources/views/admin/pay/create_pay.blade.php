@extends('admin.layout.app')

@section('content')
    <div class="container">
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
                <div class="card">
                    <div class="card-header">Craete bill of room</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create_invoice') }}">
                            @csrf
{{--                            <input type="hidden" name="contract_id" value="{{ $contracts->tenacy_id }}">--}}

{{--                            <div class="mb-3">--}}
{{--                                <label for="start_day" class="form-label">Create day</label>--}}
{{--                                <input type="date" class="form-control" placeholder="Ngày tạo" id="create_day" name="create_day" required>--}}
{{--                            </div>--}}

                            <div class="mb-3">
                                <label class="form-label">Room Code</label>
                                <select class="form-select" id="roomtype" name="room_code" required>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->room_code }}" data-so-dien="{{ $room->so_dien_thang_nay }}">{{ $room->room_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Số điện tháng trước:</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$room->so_dien_thang_nay}}" disabled>
                            </div>

                            <div class="form-group">
                                    <label for="so_dien">Electricity number</label>
                                <input type="number" class="form-control" id="so_dien" placeholder="Số điện tháng này:" name="so_dien" required>
                            </div>

                            <div class="form-group">
                                <label for="so_tien_khac">Extra expenses</label>
                                <input type="number" class="form-control" id="so_tien_khac"  placeholder="Chi phí khác:" name="so_tien_khac" required>
                            </div>

                            <div class="form-group">
                                <label for="so_tien_khac">Payment has been made</label>
                                <input type="number" class="form-control" id="so_tien_khac"  placeholder="Đã thanh toán được" name="so_tien_da_thanh_toan" required>
                            </div>

                            <div class="form-group">
                                <label for="so_tien_khac">Note</label>
                                <input type="text" class="form-control" placeholder="Ghi chú về chi phí khác:" id="note" name="note" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <script>
        // Lắng nghe sự kiện thay đổi trường "Room Code"
        document.getElementById('roomtype').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var soDienThangNay = selectedOption.getAttribute('data-so-dien');
            var soDienThangTruocInput = document.getElementById('disabledTextInput');
            soDienThangTruocInput.value = soDienThangNay;
        });
    </script>
@endsection
