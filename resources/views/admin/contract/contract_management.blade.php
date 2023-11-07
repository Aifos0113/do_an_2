@extends('admin.layout.app')

@section('content')
{{--    <div>--}}
{{--        <h1>Tìm kiếm theo tháng và năm</h1>--}}
{{--        <form action="{{ route('search_by_month_year') }}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="monthInput" class="form-label">Chọn tháng:</label>--}}
{{--                <input type="month" class="form-control" id="monthInput" name="monthInput">--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Tìm kiếm</button>--}}
{{--        </form>--}}
{{--    </div>--}}
<div class="card">
    <h1 class="card-title">  Danh sách các hợp đồng</h1>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Mã hợp đồng</th>
                <th>Số phòng</th>
                <th>Số điện thoại</th>
                <th>Khách thuê</th>
                <th>Ngày thuê</th>
                <th>Ngày hết hạn</th>
                <th>Giá thuê</th>
                <th>Xem</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            </thead>
            <tbody>
            @php
                $counter = 1 + ($contracts->currentPage() - 1) * $contracts ->perPage();
            @endphp
            @foreach ($contracts as $contract)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $contract->tenacy_id }}</td>
                    <td>{{ $contract->room_code }}</td>
                    <td>{{ $contract->personal_id }}</td>
                    <td>{{ $contract->customer }}</td>
                    <td>{{ $contract->start_day }}</td>
                    <td>{{ $contract->end_date }}</td>
                    <td>{{ $contract->price }}</td>
                    <td><a href="{{ route('contract_detail', ['id' => $contract->id]) }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </a></td>
                    <td>
                        <a href="{{ route('update_contract_form', ['id' =>$contract->id]) }}" class="btn btn-outline-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{route('delete_contract')}}">
                            @csrf
                            <input name="contract_id" hidden value="{{$contract->id}}">
                            <button class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{$contracts->links()}}
    </div>
</div>


@endsection
