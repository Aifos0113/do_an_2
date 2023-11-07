@extends('admin.layout.app')

@section('content')
    <div class="container">
        <table class="text-center table table-striped table-responsive table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Phòng</th>
                <th>Ngày yêu cầu</th>
                <th>Mô tả yêu cầu</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
                <th>Xong</th>
            </tr>
            </thead>
            <tbody>
            @foreach($request_fix as $request)
                <tr >
                    <td>1</td>
                    <td>{{ $request->room_code }}</td>
                    <td>{{ $request->request_date }}</td>
                    <td>{{ $request->content_request }}</td>
                    <td>
                        @if($request->status == 0)
                            <p class="badge bg-danger">Chưa hoàn thành</p>
                        @elseif($request->status == 1)
                            <p  class="badge bg-danger">Đang sửa chữa</p>
                        @else
                            <p  class="badge bg-success">Đã hoàn thành</p>
                        @endif
                    </td>
                    <td>
                        <form method="get" action="{{route('detail_request_fix_admin', ['id'=>$request->id])}}">
                            @csrf
                            <button class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('done_status_request_admin' , ['id' => $request->id])}}">
                            @csrf
                            <input name="pays_id" hidden value="{{$request->id}}">
                            <button class="btn btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
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
