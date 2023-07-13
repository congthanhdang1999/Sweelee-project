@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .avatar {
            margin: 0 auto;
        }

        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
            font-size: 16px;
            text-transform: uppercase;
            text-align: center;
        }

        .table > tbody > tr > th,
        .table > tbody > tr > td {
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            text-align: center;
        }

        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            margin: 30px auto;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-wrapper .btn {
            float: right;
            color: #333;
            background-color: #fff;
            border-radius: 3px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-wrapper .btn:hover {
            color: #333;
            background: #f2f2f2;
        }

        .table-wrapper .btn.btn-primary {
            color: #fff;
            background: #03A9F4;
        }

        .table-wrapper .btn.btn-primary:hover {
            background: #03a3e7;
        }

        .table-title .btn {
            font-size: 13px;
            border: none;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        .table-title {
            color: #fff;
            background: #4b5366;
            padding: 16px 25px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .show-entries select.form-control {
            width: 60px;
            margin: 0 5px;
        }

        .table-filter .filter-group {
            float: right;
            margin-left: 15px;
        }

        .table-filter input, .table-filter select {
            height: 34px;
            border-radius: 3px;
            border-color: #ddd;
            box-shadow: none;
        }

        .table-filter {
            padding: 5px 0 15px;

            margin-bottom: 5px;
        }

        .table-filter .btn {
            height: 34px;
        }

        .table-filter label {
            font-weight: normal;
            margin-left: 10px;
        }

        .table-filter select, .table-filter input {
            display: inline-block;
            margin-left: 5px;
        }

        .table-filter input {
            width: 200px;
            display: inline-block;
        }

        .filter-group select.form-control {
            width: 110px;
        }

        .filter-icon {
            float: right;
            margin-top: 7px;
        }

        .filter-icon i {
            font-size: 18px;
            opacity: 0.7;
        }

        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 80px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.view {
            width: 30px;
            height: 30px;
            color: #2196F3;
            border: 2px solid;
            border-radius: 30px;
            text-align: center;
        }

        table.table td a.view i {
            font-size: 22px;
            margin: 2px 0 0 1px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }

        .text-success {
            color: #10c469;
        }

        .text-info {
            color: #62c9e8;
        }

        .text-warning {
            color: #FFC107;
        }

        .text-danger {
            color: #ff5b5b;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

    </style>
@endsection
@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông tin người dùng</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{asset('/user/images/user.png')}}" alt="avatar"
                                 class="avatar rounded-circle img-fluid" width="100px">
                            <h5 class="my-3">{{Auth::user()->name}}</h5>


                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{route('profile.edit')}}">
                                    <button type="button" class="btn btn-primary">Cập nhật thông tin</button>
                                </a>
                                <a href="{{ route('profile.logout') }}">
                                    <button type="button" class="btn btn-outline-primary ml-1 ms-1">Đăng xuất</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Họ và tên</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{Auth::user()->name}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{Auth::user()->email}}</p>
                                </div>
                            </div>
                            <hr>
                            @if(!is_null(Auth::user()->information))
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Số điện thoại</p>
                                    </div>

                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{Auth::user()->information->phone}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Địa chỉ</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{Auth::user()->information->address}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Số điện thoại</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">Bạn chưa cập nhật số điện thoại!</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Địa chỉ</p>
                                    </div>

                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">Bạn chưa cập nhật địa chỉ!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Order <b>Details</b></h2>
                        </div>
                    </div>
                </div>
                <div class="table-filter">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <div class="filter-group">
                                <label>Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataOrdered as $item)
                        <tr>
                            <td>1</td>
                            <td>{{$item->code}}</td>
                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                            <td>{{number_format($item->total, 0, 0, '.')}}đ</td>
                            @if($item->status == 0)
                                <td><span class="badge badge-warning">Đang xử lý</span></td>
                            @elseif($item->status == 1)
                                <td><span class="badge badge-warning">Đang giao hàng</span></td>
                            @elseif($item->status == 2)
                                <td><span class="badge badge-warning">Hoàn thành</span></td>
                            @elseif($item->status == 3)
                                <td><span class="badge badge-warning">Đã huỷ</span></td>
                            @endif
                            <td class="bottom__action">
                                <a href="{{route('order.detail',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
