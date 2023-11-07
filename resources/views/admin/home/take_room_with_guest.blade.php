@extends('admin.layout.app')

@section('content')
    <h1> Occupeid Rooms</h1>
    <div class="room-grid" >
        @foreach ($rooms as $room)
            <div class="room-item">
                <p>Room Code: {{ $room->room_code }}</p>
                <p>Room Type: {{ $room->room_type }}</p>
                <p>Max Occupancy: {{ $max_occupancy[$room->room_code] }}</p>
                <p>Customer: {{ $customer[$room->room_code] }}</p>
                {{-- Các thông tin khác về phòng (nếu cần) --}}
            </div>
        @endforeach
    </div>
@endsection
