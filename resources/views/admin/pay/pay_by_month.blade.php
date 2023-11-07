@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1> Danh sách chi phí {{$month}} tháng gần nhất</h1>
        <table class="text-center table table-striped table-responsive table-bordered">
            <thead>
            <tr>
                <th>Tháng</th>
                <th>Phòng</th>
                <th>Đã thanh toán</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Xem</th>
                <th>Sửa</th>
                <th>Ẩn</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $pay)
                <tr>
                    <td>{{ $pay->month }}</td>
                    <td>{{ $pay->room_code }}</td>
                    <td>{{ $pay->da_thanh_toan }}</td>
                    <td>{{ $pay->tong_tien }}</td>
                    <td>
                        @if($pay->is_active == 1)
                            <p class="badge bg-danger">Chưa hoàn thành</p>
                        @else
                            <p class="badge bg-success">Đã hoàn thành</p>
                        @endif
                    </td>
                    <td>
                        <form method="more_infor" action="{{route('pay_detail', ['id'=>$pay->id])}}">
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('update_pay_form' , ['id' =>$pay->id ])}}">
                            @csrf
                            <input name="contract_id" hidden value="{{$pay->id}}">
                            <button class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13  .5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('delete_pays')}}">
                            @csrf
                            <input name="pays_id" hidden value="{{$pay->id}}">
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
    <a href="{{ route('list_pay') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
