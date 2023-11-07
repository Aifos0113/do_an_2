@extends('admin.layout.app')

@section('content')
    <div class="card">
        <h1>Danh sách các yêu cầu thuê phòng</h1>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phòng thuê</th>
                    <th>Số điện thoại</th>
                    <th>Số người </th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                    <th>Done</th>
                    <th>Xoá</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $counter = 1 + ($request->currentPage() - 1) * $request->perPage();
                @endphp
                @foreach ($request as  $request)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $request->customer }}</td>
                        <td>{{ $request->room_code }}</td>
                        <td>{{ $request->phone_number }}</td>
                        <td>{{ $request->amount_of_people }}</td>
                        <td>
                            @if($request->status == 1)
                                <p class="badge bg-warning" >Chưa được duyệt</p>
                            @elseif($request->status == 2)
                                <p class="badge bg-info">Đã chấp nhận, chờ thanh toán</p>
                            @elseif($request->status == 3)
                                <p class="badge bg-success">Đã chấp nhận, chờ thanh toán</p>
                            @else
                                <p  class="badge bg-danger">Bi từ chối</p>
                            @endif
                        </td>
                        <td><a href="{{ route('admin_detail_request_rent', ['id' => $request->id]) }}" class="btn btn-outline-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-device-ssd" viewBox="0 0 16 16">
                                    <path d="M4.75 4a.75.75 0 0 0-.75.75v3.5c0 .414.336.75.75.75h6.5a.75.75 0 0 0 .75-.75v-3.5a.75.75 0 0 0-.75-.75h-6.5ZM5 8V5h6v3H5Zm0-5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm7 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM4.5 11a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm7 0a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2Zm11 12V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1v-2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2a1 1 0 0 0 1-1Zm-7.25 1v-2H5v2h.75Zm1.75 0v-2h-.75v2h.75Zm1.75 0v-2H8.5v2h.75ZM11 13h-.75v2H11v-2Z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{route('admin_update_request_rent_form' , ['id' => $request->id])}}">
                                @csrf
                                <input name="contract_id" hidden value="{{$request ->id}}">
                                <button class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('admin_delete_request_rent' , ['id' => $request->id])}}">
                                @csrf
                                <input name="contract_id" hidden value="{{$request ->id}}">
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
    </div>

@endsection
