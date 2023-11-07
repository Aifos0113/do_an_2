@extends('admin.layout.app')

@section('content')
    <div>
        <form action="{{route('furniture-by-room-code')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input name="room_code" type="number" class="form-control" placeholder="Input your room you want to check" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2" >Check</button>
            </div>
        </form>
    </div>
{{--    <div class="room-grid">--}}
{{--        @foreach ($details as $detail)--}}
{{--            <div class="room-item">--}}
{{--                <p>Name of furniture type: {{$detail->name}} </p>--}}
{{--                <p>Name: {{ $detail->value }}</p>--}}
{{--                <p>Quantity: {{ $detail->quantity }}</p>--}}
{{--                <p>Description: {{ $detail->note}}</p>--}}
{{--                 Các thông tin khác về phòng (nếu cần)--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
<table>
    <thead>
    <tr>
        <th>Keys</th>
        <th>Values</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->key }}</td>
            <td> {{ $item->value }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
