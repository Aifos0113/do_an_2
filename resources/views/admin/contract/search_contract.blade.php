@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1>Tìm kiếm theo tháng và năm</h1>
        <form action="{{ route('searchByMonthAndYear') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="monthInput" class="form-label">Chọn tháng:</label>
                <input type="month" class="form-control" id="monthInput" name="monthInput">
            </div>
            <div class="mb-3">
                <label for="yearInput" class="form-label">Chọn năm:</label>
                <input type="number" class="form-control" id="yearInput" name="yearInput">
            </div>
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>
@endsection






