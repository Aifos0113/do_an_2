@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Craete bill of room</div>

            <div class="card-body">
                <form method="POST" action="{{ route('update_customer') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="room_code" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="room_code" name="customer" placeholder="Viết thường" required>
                    </div>

                    <div class="mb-3">
                        <label for="room_code" class="form-label">Customer ID</label>
                        <input placeholder="Số chứng minh thư" type="number" class="form-control" id="room_code" name="customer_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="room_code" class="form-label">Phone number</label>
                        <input placeholder="Số điện thoại" type="number" class="form-control" id="phone_number" name="phone_number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Room Code</label>
                        <select class="form-select" id="roomtype" name="room_code" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->room_code }}">{{ $room->room_code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <a href="{{ route('get_customer_active') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

    </div>
@endsection

