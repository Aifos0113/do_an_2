<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('information_user')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Thông tin cá nhân
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('occupied_room')}}" >--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Phòng có người thuê--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('under_maintenance')}}" >--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Phòng bảo dưỡng, sửa--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('furniture') }}">--}}
{{--            <svg class="nav-icon">--}}
{{--                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>--}}
{{--            </svg>--}}
{{--            Quản lý thiết bị--}}
{{--        </a>--}}
    </li>
{{--    --}}{{--    <li class="nav-item">--}}
{{--    --}}{{--        <a class="nav-link" href="{{ route('get_contract') }}">--}}
{{--    --}}{{--            <svg class="nav-icon">--}}
{{--    --}}{{--                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>--}}
{{--    --}}{{--            </svg>--}}
{{--    --}}{{--            {{ __('Contract management') }}--}}
{{--    --}}{{--        </a>--}}
{{--    --}}{{--    </li>--}}

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý yêu cầu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list_request_user')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Yêu cầu của bạn
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('create_request_user_form')}}" >
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Tạo yêu cầu mới
                </a>
            </li>
        </ul>
    </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('list_request_rent_room_user') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                </svg>
                Danh sách yêu cầu
            </a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('empty_room_user') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-room') }}"></use>
            </svg>
            Danh sách phòng trống
        </a>
    </li>
{{--    <li class="nav-group" aria-expanded="false">--}}
{{--        <a class="nav-link nav-group-toggle" href="#">--}}
{{--            <svg class="nav-icon">--}}
{{--                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>--}}
{{--            </svg>--}}
{{--            Quản lý chi phí--}}
{{--        </a>--}}
{{--        <ul class="nav-group-items" style="height: 0px;">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('list_pay')}}">--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Danh sách chi phí--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('create_an_invoice')}}">--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Tạo chi phí mới--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}

{{--    <li class="nav-group" aria-expanded="false">--}}
{{--        <a class="nav-link nav-group-toggle" href="#">--}}
{{--            <svg class="nav-icon">--}}
{{--                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>--}}
{{--            </svg>--}}
{{--            Quản lý khách hàng--}}
{{--        </a>--}}
{{--        <ul class="nav-group-items" style="height: 0px;">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{ route('get_customer_active')}}">--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Danh sách khách hàng--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('get_view_add_customer')}}">--}}
{{--                    <svg class="nav-icon">--}}
{{--                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>--}}
{{--                    </svg>--}}
{{--                    Thêm khách hàng--}}
{{--                </a>--}}
{{--            </li>--}}
    </li>
</ul>
