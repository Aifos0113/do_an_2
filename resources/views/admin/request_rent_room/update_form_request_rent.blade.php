@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="container">
            <h1 class="my-4">Câp nhật yêu cầu thuê phòng số: {{ $request->id }}</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('admin_update_request_rent') }}">
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
                        <input placeholder="{{$request->amount_of_people}}" class="form-control"  disabled>
                    </div>
                </div>
                <div class="mb-3" style="margin: 10px">
                    <label for="request_content" style="margin-left: 10px" class="form-label">Yêu cầu thêm của khách hàng</label>
                    <input placeholder="{{$request->note}}" class="form-control" id="note" required disabled>
                </div>
                <div class="mb-3 row" style="margin: 5px">
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số điện hiện tại:</label>
                        <input placeholder="Số điện thực tế...." class="form-control" name="so_dien" required >
                    </div>
                    <div class="col-md-6">
                        <label for="room_code" class="form-label">Số người ở:</label>
                        <input placeholder="{{$request->amount_of_people}}" id="amount_of_people" name="amount_of_people" class="form-control" required >
                    </div>
                </div>
                <div class="mb-3" style="margin: 10px" id="customer-details">
                    <!-- Trường nhập thông tin của khách hàng sẽ được thêm vào đây bằng JavaScript -->
                </div>
                <div style="bottom: 10px; right: 10px">
                    <button style="margin-left: 10px ; margin-bottom: 10px  " class="btn btn-outline-success">Tạo hợp đồng </button>
                </div>
            </form>
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
                    <h4>Khách hàng số ${i}</h4>
                    <div class="mb-3">
                        <label for="customer_name_${i}" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" id="customer_name_${i}" name="customer_names[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_id_${i}" class="form-label">Căn cước công dân</label>
                        <input type="number" class="form-control" id="customer_id_${i}" name="customer_ids[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number_${i}" class="form-label">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone_number_${i}" name="phone_numbers[]" required>
                    </div>
                `;

                    customerDetailsDiv.innerHTML += customerHtml;
                }
            }
        });
    </script>


    <a href="{{ route('admin_list_request_rent') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
