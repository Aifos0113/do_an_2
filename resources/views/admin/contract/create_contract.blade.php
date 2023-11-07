@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <h1 class="card-header">Tạo hợp đồng mới</h1>

                <div class="card-body">
                        <form method="POST" action="{{ route('create_contract') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="room_code" class="form-label">Chủ hợp đồng</label>
                                <input type="text" class="form-control" id="room_code" name="customer" placeholder="Họ và tên..." required>
                            </div>

                            <div class="mb-3">
                                <label for="room_code" class="form-label">Căn cước công dân</label>
                                <input placeholder="Số chứng minh thư...." type="number" class="form-control" id="room_code" name="customer_id" required>
                            </div>

                            <div class="mb-3">
                                <label for="room_code" class="form-label">Số điện</label>
                                <input placeholder="Số điện hiện tại..." type="number" class="form-control" id="so_dien" name="so_dien" required>
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
                                        @if ($room->status == 0)  Chỉ cho phép chọn phòng có trạng thái = 0
                                        <option value="{{ $room->room_code }}">{{ $room->room_code }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount_of_people" class="form-label">Số lượng người thực tế</label>
                                <input type="number" step="0.1" class="form-control" id="amount_of_people" name="amount_of_people" placeholder="Số lượng người ở" required>
                            </div>

                            <div id="customer-details">
                                <!-- Trường nhập thông tin của khách hàng sẽ được thêm vào đây bằng JavaScript -->
                            </div>

                            <div class="mb-3">
                                <label for="rule" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="rule" name="note" placeholder="Yêu cầu ngoài của khách" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Đồng ý</button>
                        </form>
                </div>
        </div>
    </div>

    <script>
        document.getElementById('amount_of_people').addEventListener('input', function () {
            var amountOfPeople = parseInt(this.value);
            var customerDetailsDiv = document.getElementById('customer-details');
            customerDetailsDiv.innerHTML = ''; // Xóa bất kỳ thông tin khách hàng cũ nào

            if (amountOfPeople >= 2) {
                for (var i = 2; i <= amountOfPeople; i++) {
                    var customerHtml = `
                    <h4>Customer ${i}</h4>
                    <div class="mb-3">
                        <label for="customer_name_${i}" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name_${i}" name="customer_names[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_id_${i}" class="form-label">Customer ID</label>
                        <input type="number" class="form-control" id="customer_id_${i}" name="customer_ids[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number_${i}" class="form-label">Phone number</label>
                        <input type="number" class="form-control" id="phone_number_${i}" name="phone_numbers[]" required>
                    </div>
                `;

                    customerDetailsDiv.innerHTML += customerHtml;
                }
            }
        });
    </script>


@endsection
