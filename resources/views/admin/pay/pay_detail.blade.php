@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Chi tiết hoá đơn phòng <strong>{{ $tenacies->tenacy_id }}    </strong></p>
                    </div>
                    <div class="col-xl-3 float-end">
                        <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                class="fas fa-print text-primary"></i> Print</a>
                        <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                class="far fa-file-pdf text-danger"></i> Export</a>
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                            <h2 class="pt-0">Hoá đơn phòng</h2>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted"><b>To:</b> <span style="color:#5d9fc5 ;">{{$tenacies->customer}}</span></li>
                                <li class="text-muted"><b>Số điện thoai:</b> {{$tenacies->phone_number}}</li>
                                <li class="text-muted"><b>Phòng:</b> {{$tenacies->room_code}}</li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted"><b>Mã hợp đồng: {{$pays->tanancy}}</b></p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">ID:</span>{{$pays->id}}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Creation Date: </span>{{ $pays->thang }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">Unpaid</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Chú thích</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Chi phí</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Tiền điện</td>
                                <td>{{$so_dien_su_dung}}</td>
                                <td>{{$gia_dien->value}}</td>
                                <td>{{$pays->so_dien}}</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Tiền nước</td>
                                <td>{{ $tenacies->amount_of_people }}</td>
                                <td>{{ $gia_nuoc->value }}</td>
                                <td>{{$pays->tien_nuoc}}</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Tiền mạng</td>
                                <td>{{ $tenacies->amount_of_people }}</td>
                                <td>{{ $gia_mang ->value }}</td>
                                <td>{{ $pays->tien_mang }}</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Chi phí khác</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{ $pays->tien_khac }}</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Tiền phòng</td>
                                <td>1</td>
                                <td>{{ $pays->tien_phong }}</td>
                                <td>{{ $pays->tien_phong }}</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3">Note: {{$pays->note}}</p>

                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">Tổng</span>{{ $pays->tong_tien }}</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Trừ tiền</span></li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Tổng tiền</span><span
                                    style="font-size: 25px;">{{ $pays->tong_tien }}</span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p></p>
                        </div>
                        <div class="col-xl-2">
                            <a type="button" href="{{route('done_pay', ['id' => $pays->id])}}" class="btn btn-primary text-capitalize"
                                    style="background-color:#60bdf3 ;">Hoàn thành</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('list_pay') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>

@endsection
