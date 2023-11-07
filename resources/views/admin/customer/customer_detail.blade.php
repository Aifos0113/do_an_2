@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Chi tiết khách hàng: {{ $customer->name }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-text">Số phòng: {{ $customer->room_code }}</h5>
                <p class="card-text">Số điện thoại: {{ $customer->phone_number }}</p>
                <p class="card-text">Số chứng minh thư: {{ $customer->personal_id }}</p>
                <p class="card-text">Số hợp đồng: {{ $customer->tenancy }}</p>

            </div>
        </div>

        <a href="{{ route('get_customer_active') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
    </div>
@endsection
