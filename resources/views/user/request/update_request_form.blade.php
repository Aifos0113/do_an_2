@extends('user.layout_user.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">Yêu cầu sửa chữa, lắp đặt</h3>

            <div class="card-body">
                <form method="POST" action="{{ route('update_request_user') }}">
                    @csrf
                    <input  placeholder="{{$request->id}}" value="{{$request->id}}" type="hidden" name="request_id" class="form-control" id="room_code" required>

                    <div class="mb-3">
                        <label class="form-label">Room Code</label>
                        <input  placeholder="{{$request->room_code}}" class="form-control" id="room_code" required  disabled>
                    </div>
                    {{--                        <input type="date" class="form-control" value="{{}}" id="start_day" name="start_day" type="hidden"  required>--}}

                    <div class="mb-3">
                        <label for="request_content" class="form-label">Mô tả yêu cầu</label>
                        <textarea class="form-control" id="rule" name="request_user" placeholder="Yêu cầu sửa chữa.... " required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="room_code" class="form-label">Người thuê</label>
                        <input value="chim to" placeholder="{{$user->name}}"  class="form-control" id="room_code" required disabled>
                    </div>

                    <div class="mb-3">
                        <label for="room_code" class="form-label">Số điện thoại:</label>
                        <input placeholder="{{$user->sdt}}"  class="form-control" id="so_dien" required disabled>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

