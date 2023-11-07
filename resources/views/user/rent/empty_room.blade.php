@extends('user.layout_user.app')

@section('content')
    <div class="room-grid">
            @foreach ($rooms as $room)
                <div class="room-item">
                    <p>Room Code: {{ $room->room_code }}</p>
                    <p>Room Type: {{ $room->room_type }}</p>
                    <p>Max Occupancy: {{ $max_occupancy[$room->room_code] }}</p>
                    <p>
                        <form method="get" action="{{route('room_detail_user', ['id' =>$room->id])}}">
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
@endsection


