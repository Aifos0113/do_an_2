@extends('admin.layout.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Số phòng</th>
                <th>Loại</th>
                <th>Hãng</th>
                <th>Chi tiết</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @php $count = 1 @endphp <!-- Khởi tạo biến đếm -->

            @foreach ($noi_that as $value)
                <tr>
                    <td>{{ $count++ }}</td> <!-- Hiển thị và tăng biến đếm -->
                    <td>{{ $value->room_code }}</td>
                    <td>{{ $attribute[$value->attribute_id] }}</td>
                    <td>{{ $value->value }}</td>
                    <td>{{ $value->note }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>
                        @if($value->is_active == 1)
                            <p class="badge bg-success">Hoạt động bình thường</p>
                        @else
                            <p class="badge bg-danger">Không sử dụng được</p>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{route('delete_furniture_admin' , ['id'=>$value->id])}}">
                            @csrf
                            <input name="pays_id" hidden value="{{$value->id}}">
                            <button class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0-.5-.5Zm-8-2a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H9a2 2 0 0 0 2-2V3a.5.5 0 0 0-.5-.5H7Zm-1-.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-.5.5Z"/>
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
@endsection
