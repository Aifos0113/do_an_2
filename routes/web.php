<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\NavigationController::class, 'authorization'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    // Các route yêu cầu xác thực người dùng
    Route::group(['middleware' => 'isAdmin'], function (){
        // Các route chỉ dành cho admin
        // Đặt tất cả các route cần phân quyền vào đây
        Route::get('/admin_home/room/dashboard' , [\App\Http\Controllers\admin\HomeController::class, 'get_dashboard'])->name('home_admin');
        Route::get('/admin_home', [\App\Http\Controllers\admin\HomeController::class, 'getRoomsWithStatusZero'])->name('get_room_empty');
        Route::post('/admin_home/room/search' , [\App\Http\Controllers\admin\HomeController::class , 'searchRoom'])->name('search-room');
        Route::post('/admin_home/create', [\App\Http\Controllers\admin\HomeController::class , 'create_room'])->name('create-room');
        Route::post('/admin_home/update-room', [\App\Http\Controllers\admin\HomeController::class , 'update_room'])->name('update_room');
        Route::post('/admin_home/create-room-type', [\App\Http\Controllers\admin\HomeController::class, 'create_room_type'])->name('create-room-type');
        Route::get('/admin_home/occupied-room', [\App\Http\Controllers\admin\HomeController::class , 'take_room_with_guests'])->name('occupied_room');
        Route::get('/admin_home/under-maintenance' , [\App\Http\Controllers\admin\HomeController::class , 'take_room_under_maintenance'])->name('under_maintenance');

// các route của furniture
        Route::get('/admin_home/furniture' , [\App\Http\Controllers\admin\Furniture::class, 'get_all_furniture'])->name('furniture');
        Route::get('/admin_home/details' , [\App\Http\Controllers\admin\RoomController::class, 'get_furniture'])->name('get_furniture');
        Route::post('/admin_home/details/search' , [\App\Http\Controllers\admin\RoomController::class, 'get_furniture_by_room_code'])->name('furniture-by-room-code');
        Route::get('/admin_home/furniture_by_room/{id}' , [\App\Http\Controllers\admin\Furniture::class, 'furniture_by_room'])->name('furniture_by_room_admin');
        Route::post('/admin_home/delete_furniture/{id}' , [\App\Http\Controllers\admin\Furniture::class , 'delete_furniture'])->name('delete_furniture_admin');


// Các route của contract
        Route::get('/admin_home/contract' , [\App\Http\Controllers\admin\ContractController::class , 'get_all_contract'])->name('get_contract');
        Route::get('/admin_home/contract/create_contract_form', [\App\Http\Controllers\admin\ContractController::class , 'create_contract_form'])->name('create_contract_form');
        Route::post('admin_home/contract/create_contract', [\App\Http\Controllers\admin\ContractController::class , 'create_contract'])->name('create_contract');
        Route::get('/admin_home/contract/search_form', [\App\Http\Controllers\admin\ContractController::class, 'search_form'])->name('search_form');
        Route::post('/admin_home/contract/search_contract', [\App\Http\Controllers\admin\ContractController::class, 'search_by_date'])->name('search_by_month_year');
        Route::get('/admin_home/contract/{id}', [\App\Http\Controllers\admin\ContractController::class , 'contract_show_detail'])->name('contract_detail');
        Route::get('/admin_home/contract/update_contract_form/{id}' , [\App\Http\Controllers\admin\ContractController::class , 'update_contract_form'])->name('update_contract_form');
        Route::post('/admin_home/contract/update_contract', [\App\Http\Controllers\admin\ContractController::class, 'update_contract'])->name('update_contract');
        Route::post('admin_home/contract/delete_contract', [\App\Http\Controllers\admin\ContractController::class , 'delete_contract'])->name('delete_contract');


        // ROUTE PAY
        Route::get('/admin_home/pays/list_pay' , [\App\Http\Controllers\admin\PayController::class , 'list_pay'])->name('list_pay');
        Route::get('/admin_home/pays/create_an_invoice', [\App\Http\Controllers\admin\PayController::class ,'show_create_an_invoice'])->name('create_an_invoice');
        Route::post('/admin_home/pays/create_an_invoice', [\App\Http\Controllers\admin\PayController::class ,'create_an_invoice'])->name('create_invoice');
        Route::post('/admin_home/pays/delete_pays' , [\App\Http\Controllers\admin\PayController::class , 'delete_pays'])->name('delete_pays');
        Route::get('/admin_home/pays/paid', [\App\Http\Controllers\admin\PayController::class , 'unpaid_invoice'])->name('unpaid_invoice');
        Route::get('/admin_home/pays/unpaid' , [\App\Http\Controllers\admin\PayController::class , 'invoice_paid'])->name('invoice_paid');
        Route::get('/admin_home/pays/search_pay_by_month/{months}', [\App\Http\Controllers\admin\PayController::class, 'search_pays_by_month'])->name('search_pays_by_month');
        Route::get('/admin_home/pays/{id}', [\App\Http\Controllers\admin\PayController::class, 'pay_detail'])->name('pay_detail'); // xem chi tiết pay
        Route::get('/admin_home/pays/update_pay-form/{id}', [\App\Http\Controllers\admin\PayController::class, 'update_pay_form'])->name('update_pay_form');      // cập nhật pay
        Route::post('/admin_home/pays/update_pay', [\App\Http\Controllers\admin\PayController::class,'update_pay'])->name('update_pay');
        Route::post('/admin_home/pays/done_pay' , [\App\Http\Controllers\admin\PayController::class , 'done_pay'])->name('done_pay');

// ROUTE CUSTOMER
        Route::get('/admin_home/customer/list_customer' , [\App\Http\Controllers\admin\CustomerController::class , 'get_customer_active'])->name('get_customer_active');
        Route::get('admin_home/customer/add_customer' , [\App\Http\Controllers\admin\CustomerController::class, 'get_view_add_customer'])->name('get_view_add_customer');
        Route::post('admin_home/customer/add_customer' , [\App\Http\Controllers\admin\CustomerController::class , 'add_customer'])->name('add_customer');
        Route::get('/admin_home/customer/update_customer_form/{id}' , [\App\Http\Controllers\admin\CustomerController::class, 'update_customer_form'])->name('update_customer_form');
        Route::post('/admin_home/customer/update_customer', [\App\Http\Controllers\admin\CustomerController::class, 'update_customer'])->name('update_customer');
        Route::get('/admin_home/customer/customer_detail/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'customer_detail'])->name('customer_detail');
        Route::post('/admin_home/customer/delete_customer', [\App\Http\Controllers\admin\CustomerController::class, 'delete_customer'])->name('delete_customer');

// Danh sách yêu cầu sửa chữa
        Route::get('/admin_home/request_fix/list_request' , [\App\Http\Controllers\admin\AdminRequestFixController::class , 'list_request_fix'])->name('list_request_fix_admin');
        Route::post('/admin_home/request_fix/update_status/{id}', [\App\Http\Controllers\admin\AdminRequestFixController::class, 'done_status_request'])->name('done_status_request_admin');
        Route::get('/admin_home/request_fix/detail_request/{id}' , [\App\Http\Controllers\admin\AdminRequestFixController::class , 'detail_request_fix'])->name('detail_request_fix_admin');
        Route::post('/admin_home/request_fix/update_request_fix' , [\App\Http\Controllers\admin\AdminRequestFixController::class, 'update_request_fix'])->name('update_request_fix_admin');

// Danh sách quản lý tài khoản
        Route::get('/admin_home/account/list_account' , [\App\Http\Controllers\admin\AdminAccountController::class , 'list_account'])->name('admin_list_account');
        Route::get('admin_home/account/detail_account/{id}' , [\App\Http\Controllers\admin\AdminAccountController::class, 'detail_account'])->name('admin_detail_account');
        Route::post('admin_home/account/update_account' , [\App\Http\Controllers\admin\AdminAccountController::class, 'update_account'])->name('admin_update_account');
        Route::post('admin_home/account/delete_account/{id}' , [\App\Http\Controllers\admin\AdminAccountController::class, 'delete_account'])->name('admin_delete_account');

        // Danh sách quản lý yêu cầu thuê phòng
        Route::get('/admin_home/rent_home/list_request_rent', [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'list_request_rent'])->name('admin_list_request_rent');
        Route::get('/admin_home/rent_home/detail_request_rent/{id}', [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'detail_request_rent'])->name('admin_detail_request_rent');
        Route::post('/admin_home/rent_home/update_request_rent_form/{id}' , [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'update_request_rent_form'])->name('admin_update_request_rent_form');
        Route::post('/admin_home/rent_home/update_request_rent' , [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'update_request_rent'])->name('admin_update_request_rent');
        Route::post('/admin_home/rent_home/delete_request/{id}' , [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'delete_request_rent'])->name('admin_delete_request_rent');
        Route::post('/admin_home/rent_home/update_status_rent_home', [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'update_status_rent_room'])->name('admin_update_status_rent_room');
        Route::post('/admin_home/rent_home/done_request_rent/{id}' , [\App\Http\Controllers\admin\AdminRequestRentRoomController::class , 'done_request_rent'])->name('admin_done_request_rent');

        // Danh sách chỉnh sửa khác
        Route::get('/admin_home/edit/list_price' ,[\App\Http\Controllers\admin\AdminEditController::class, 'list_price'])->name('admin_list_price');
        Route::get('/admin_home/edit/list_service' ,[\App\Http\Controllers\admin\AdminEditController::class, 'list_service'])->name('admin_list_service');
        Route::get('/admin_home/edit/list_repairer', [\App\Http\Controllers\admin\AdminEditController::class,'list_repairer'])->name('admin_list_repairer');
        Route::post('/admin_home/edit/add_repairer' , [\App\Http\Controllers\admin\AdminEditController::class, 'add_repairer'])->name('admin_add_repairer');
        Route::get('/admin_home/edit/update_repairer_form/{id}' , [\App\Http\Controllers\admin\AdminEditController::class, 'update_repairer_form'])->name('admin_update_repairer_form');
        Route::post('/admin_home/edit/update_repairer', [\App\Http\Controllers\admin\AdminEditController::class, 'update_repairer'])->name('admin_update_repairer');
        Route::post('/admin_home/edit/delete_repairer/{id}', [\App\Http\Controllers\admin\AdminEditController::class, 'delete_repairer'])->name('admin_delete_repairer');
        Route::get('/admin_home/edit/update_form/{id}' , [\App\Http\Controllers\admin\AdminEditController::class , 'update_price_form'])->name('admin_update_price_form');
        Route::post('/admin_home/edit/update_price' , [\App\Http\Controllers\admin\AdminEditController::class, 'update_price'])->name('admin_update_price');
        Route::post('/admin_home/edit/delete_price/{id}' , [\App\Http\Controllers\admin\AdminEditController::class , 'delete_price'])->name('admin_delete_price');

        //      Route excel
        Route::post('/admin_home/export_excel', [\App\Http\Controllers\ExcelExportController::class , 'export_bill'])->name('export_bill_admin');
        Route::post('/admin_home/import_excel', [\App\Http\Controllers\ExcelExportController::class , 'import_bill'])->name('import_bill_admin');
        Route::post('/admin_home/import_furniture', [\App\Http\Controllers\ExcelExportController::class, 'import_furniture'])->name('import_furniture_admin');
        Route::post('/admin_home/export_furniture', [\App\Http\Controllers\ExcelExportController::class, 'export_furniture'])->name('export_furniture_admin');

    });

    Route::group(['middleware' => 'isAdmin'], function () {
        // Các route chỉ dành cho manager
        // Thêm các route khác ở đây
    });


    // Home user
    Route::get('/user_home', [\App\Http\Controllers\user\UserController::class, 'home_user'])->name('home_user');
    Route::get('/user_home/information' , [\App\Http\Controllers\user\UserController::class, 'information_user'])->name('information_user');
    Route::post('/user_home/update_information' , [\App\Http\Controllers\user\UserController::class , 'update_information_user'])->name('update_information_user');

    // Yêu cầu khách hàng
    Route::get('/user_home/list_request' , [\App\Http\Controllers\user\RequestUserController::class , 'list_request'])->name('list_request_user');
    Route::get('/user_home/request_detail/{id}' , [\App\Http\Controllers\user\RequestUserController::class , 'request_detail'])->name('request_detail_user');
    Route::get('/user_home/create_request_form' , [\App\Http\Controllers\user\RequestUserController::class , 'create_request_form'])->name('create_request_user_form');
    Route::post('/user_home/create_request', [\App\Http\Controllers\user\RequestUserController::class , 'create_request'])->name('create_request_user');
    Route::get('/user_home/update_request_form/{id}' , [\App\Http\Controllers\user\RequestUserController::class, 'update_request_form'])->name('update_request_user_form');
    Route::post('user_home/update_request' , [\App\Http\Controllers\user\RequestUserController::class , 'update_request'])->name('update_request_user');
    Route::post('user_home/delete_request/{id}' , [\App\Http\Controllers\user\RequestUserController::class , 'delete_request'])->name('delete_request_form');

    // Khách yêu cầu thuê thêm phòng
    Route::get('/user_home/list_empty_room' , [\App\Http\Controllers\user\RoomUser::class , 'list_empty_room'])->name('empty_room_user');
    Route::post('/user_home/request_rent_room', [\App\Http\Controllers\user\RoomUser::class , 'request_rent_room'])->name('request_rent_room_user');
    Route::get('/user_home/room_detail/{id}' , [\App\Http\Controllers\user\RoomUser::class , 'room_detail'])->name('room_detail_user');
    Route::get('/user_home/request_rent_detail/{id}' , [\App\Http\Controllers\user\RoomUser::class, 'request_rent_detail'])->name('request_rent_detail_user');
    Route::get('/user_home/list_request_rent_room' , [\App\Http\Controllers\user\RoomUser::class , 'list_request_rent_room'])->name('list_request_rent_room_user');
    Route::post('/user_home/delete_request_rent_user/{id}' , [\App\Http\Controllers\user\RoomUser::class , 'delete_request_rent'])->name('delete_request_rent_user');






});


