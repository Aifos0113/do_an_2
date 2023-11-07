@extends('admin.layout.app')


@section('content')
    <h1>Empty room</h1>
    <div class="room-grid">
        <div class="room-item" style="height: 140px ; text-align:center " >
            <p>Thêm phòng mới</p>
            <button   class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
            </button>
        </div>
        <div class="room-item" style="height: 140px ; text-align:center " >
            <p>Sửa phòng</p>
            <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#staticBackdrop">
                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                    <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                </svg>
            </button>
        </div>
        <div class="room-item" style="height: 140px ; text-align:center " >
            <p>Sửa phòng</p>
            <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#staticbackdrop">
                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                    <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                </svg>
            </button>
        </div>
        @foreach ($rooms as $room)
            <div class="room-item">
                <p>Room Code: {{ $room->room_code }}</p>
                <p>Room Type: {{ $room->room_type }}</p>
                <p>Max Occupancy: {{ $max_occupancy[$room->room_code] }}</p>
                {{-- Các thông tin khác về phòng (nếu cần) --}}
            </div>
        @endforeach
    </div>
{{--    Thêm phòng--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" method="post" action="{{route('create-room') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Room Code</label>
                            <input type="number" class="form-control" id="roomcode" name="room_code" placeholder="For example: 101" required>
                        </div>

                        <!-- Trường "roomtype" -->
                        <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <select class="form-select" id="roomtype" name="room_type" required>
                                @foreach($roomtypes as $roomtype)
                                    <option value="{{ $roomtype->room_type}}">{{ $roomtype->room_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Add new</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Sửa phòng   --}}
    <div class="modal fade" id="staticBackdrop" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form autocomplete="off" method="post" action="{{route('update_room') }}">
                        @csrf
                        <div class="modal-body">
                            {{-- Lấy mã phòng--}}
                            <div class="mb-3">
                                <label class="form-label">Room Code</label>
                                <input type="number" class="form-control" id="roomcode" name="room_code" placeholder="For example: 101" required>
                            </div>
                            {{-- Đổi mã phòng--}}
                            <div class="mb-3">
                                <label class="form-label">Room Code</label>
                                <input type="number" class="form-control" id="roomcode" name="room_code_new" placeholder="For example: 101" required>
                            </div>
                            <!-- Đổi room type -->
                            <div class="mb-3">
                                <label class="form-label">Room Type</label>
                                <select class="form-select" id="roomtype" name="room_type_new" required>
                                    @foreach($roomtypes as $roomtype)
                                        <option value="{{ $roomtype->room_type}}">{{ $roomtype->room_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Thêm loại phòng   --}}
    <div class="modal fade" id="staticbackdrop" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" method="post" action="{{route('create-room-type') }}">
                    @csrf
                    <div class="modal-body">
                        {{-- Lấy loại phòng--}}
                        <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <input type="text" class="form-control" id="roomtype" name="room_type" placeholder="For example: PT1" required>
                        </div>
                        {{-- Đổi mã phòng--}}
                        <div class="mb-3">
                            <label class="form-label">Max Occupancy</label>
                            <input type="number" class="form-control" id="maxoccupancy" name="max_occupancy" placeholder="For example: 1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Create new</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
