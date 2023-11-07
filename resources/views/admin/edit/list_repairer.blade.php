@extends('admin.layout.app')

@section('content')
    <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
        Thêm thợ sửa
    </button>


    <div class="card" style="margin: 10px">
        <h1>Danh sách thợ sửa chữa</h1>
        <table class="table table-striped ">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên thợ</th>
                <th>Chức vụ</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            </thead>
            <tbody>
            @php
                $counter = 1 + ($attribute_and_values->currentPage() - 1) * $attribute_and_values->perPage();
            @endphp
            @foreach($attribute_and_values as $nhan_vien)
                <tr>
                    <td >{{$counter++}}</td>
                    <td>{{ $nhan_vien->name }}</td>
                    <td>{{ $nhan_vien->value }}</td>
                    <td>{{ $nhan_vien->note }}</td>
                    <td>
                        @if($nhan_vien->is_active == 1)
                            <p class="badge bg-success">Hoạt động</p>
                        @else
                            <p class="badge bg-danger">Dừng hoạt động</p>
                        @endif
                    </td>
                    <td>
                        <form method="get" action="{{route('admin_update_repairer_form', ['id' =>$nhan_vien->id])}}">
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
                        <form method="post" action="{{route('admin_delete_repairer' , ['id'=> $nhan_vien->id])}}">
                            @csrf
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
{{--        {{$data->links()}}--}}
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('admin_add_repairer')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên thợ sửa:</label>
                            <input autocomplete="off" type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: Nguyễn Văn A" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control"  name="sdt" placeholder="Ví dụ: 09...." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Công việc sửa chữa</label>
                            <select class="form-select" id="roomtype" name="attribute_id" required>
                                @foreach($attribute_and_values as $nv)
                                    <option value="{{ $nv->attribute_id}}">{{ $nv->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
