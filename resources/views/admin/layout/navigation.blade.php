<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý phòng
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('get_room_empty')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Phòng trống
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('occupied_room')}}" >
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Phòng có người thuê
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('under_maintenance')}}" >
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Phòng bảo dưỡng, sửa
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('furniture') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            Quản lý thiết bị
        </a>
    </li>
{{--    <li class="nav-item">--}}
{{--    <a class="nav-link" href="{{ route('get_furniture') }}">--}}
{{--        <svg class="nav-icon">--}}
{{--            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>--}}
{{--        </svg>--}}
{{--        Quản lý thiết bị--}}
{{--    </a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('get_contract') }}">--}}
{{--            <svg class="nav-icon">--}}
{{--                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>--}}
{{--            </svg>--}}
{{--            {{ __('Contract management') }}--}}
{{--        </a>--}}
{{--    </li>--}}

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý hợp đồng
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('get_contract')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Danh sách các hợp đồng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('create_contract_form')}}" >
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Tạo hợp đồng mới
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý chi phí
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list_pay')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Danh sách chi phí
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('create_an_invoice')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Tạo chi phí mới
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý khách hàng
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('get_customer_active')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Danh sách khách hàng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('get_view_add_customer')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Thêm khách hàng
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Quản lý yêu cầu sửa chữa
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list_request_fix_admin')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Danh sách yêu cầu
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
        </ul>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
            </svg>
            Quản lý tài khoản
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_list_account')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
                    </svg>
                    Danh sách tài khoản
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-home') }}"></use>
            </svg>
            Quản lý yêu cầu thuê
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_list_request_rent')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
                    </svg>
                    Danh sách yêu cầu thuê
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-home') }}"></use>
            </svg>
            Quản lý chỉnh sửa
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_list_price')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
                    </svg>
                    Chỉnh sửa giá tiền
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_list_service')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
                    </svg>
                    Chỉnh sửa dịch vụ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin_list_repairer')}}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
                    </svg>
                    Chỉnh sửa thợ sửa
                </a>
            </li>
        </ul>
    </li>
</ul>
