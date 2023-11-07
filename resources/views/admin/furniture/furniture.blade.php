@extends('admin.layout.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="d-flex justify-content-between">
                    <div class="col-xl-9">
                        <h1 style="color: #7e8d9f;font-size: 30px;">Nội thất sẵn có<strong>  </strong></h1>
                    </div>
                    <div class="d-flex justify-content-between float-end" style="margin-bottom: 10px">
                        <div class="btn btn-light text-capitalize">
                            <form  action="{{route('import_furniture_admin')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="excel_file" type="file" accept="application/vnd.ms-excel" class="form-control">
                                <input type="submit" class="btn btn-primary" value="Nhập">
                            </form>
                        </div>
                        <div style="margin: 15px">
                            <form action="{{ route('export_furniture_admin') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Xuất</button>
                            </form>
                        </div>
                    </div>

                    <hr>

                </div>
                <div class="room-grid">
                    @foreach ($rooms as $room)
                        <div class="room-item">
                            <p>Room Code: {{ $room->room_code }}</p>
                            <p>Room Type: {{ $room->room_type }}</p>
                            <p>Max Occupancy: {{ $max_occupancy[$room->room_code] }}</p>
                            <p>
                            <form method="get" action="{{route('furniture_by_room_admin', ['id' =>$room->id])}}">
                                @csrf
                                <button class="btn btn-secondary">
                                    Chi tiết phòng
                                </button>
                            </form>
                            </p>
                            {{-- Các thông tin khác về phòng (nếu cần) --}}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
