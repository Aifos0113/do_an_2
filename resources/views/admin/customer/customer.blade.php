@extends('admin.layout.app')

@section('content')
    <div class="card">
        <h1>Danh sách khách hàng</h1>
        <table class="table table-striped ">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên khách</th>
                <th>Số chứng minh thư</th>
                <th>Số điện thoại</th>
                <th>Mã phòng thuê</th>
                <th>Mã hợp đồng</th>
                <th>Xem</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            </thead>
            <tbody>
            @php
                $counter = 1 + ($data->currentPage() - 1) * $data->perPage();
            @endphp
            @foreach($data as $cus)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $cus->name }}</td>
                    <td>{{ $cus->personal_id }}</td>
                    <td>{{ $cus->phone_number }}</td>
                    <td>{{ $cus->room_code }}</td>
                    <td>{{ $cus->tenancy }}</td>
                    <td>
                        <form method="get" action="{{route('customer_detail', ['id'=>$cus->id])}}">
                            @csrf
                            <button class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="get" action="{{route('update_customer_form', ['id' =>$cus->id])}}">
                            @csrf
                            <button class="btn btn-outline-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13  .5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('delete_customer')}}">
                            @csrf
                            <input name="customer_id" hidden value="{{$cus->id}}">
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
        {{$data->links()}}
    </div>

@endsection
