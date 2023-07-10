@extends('layouts.user')
@section('css')
<link rel="stylesheet" href="{{ asset('user/css/detail_order.css') }}">
<style>
    

    .title-order,
    .card-header {
        font-weight: normal;
        font-size: 1.5rem;
        margin: 15px 0;
        color: red;
        text-transform: uppercase;
    }

    .table>caption+thead>tr:first-child>th,
    .table>colgroup+thead>tr:first-child>th,
    .table>thead:first-child>tr:first-child>th,
    .table>caption+thead>tr:first-child>td,
    .table>colgroup+thead>tr:first-child>td,
    .table>thead:first-child>tr:first-child>td {
        border-top: 0;
        font-size: 16px;
        text-transform: uppercase;
        text-align: center;
    }

    .table>tbody>tr>th,
    .table>tbody>tr>td {
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        text-align: center;
    }
</style>
@endsection
@section('content')
<div id="main-content-wp" class="clearfix">
    <div class="wp-inner">
        <div id="content" class="container-fluid">
            <div class="card info-order">
                <div class="card-body">
                    <h5 class="title-order">
                        <i class="fas fa-info-circle"></i>
                        Thông tin khách hàng
                    </h5>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(Auth()->user())
                            <tr>

                                <td>{{Auth::user()->name}}</td>
                                <td>0386719273</td>
                                <td>Diễn hạnh diễn châu NGHỆ AN</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card">
                    <div class="card-header font-weight-bold">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Danh sách đơn hàng
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đơn</th>
                                    <th scope="col" width="13%">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>

                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <a href="">
                                            <img src="https://imgs.viettelstore.vn/Images/Product/ProductImage/dien-thoai/Apple/iPhone%2014%20Pro%20Max%20128/iPhone-14-Pro-Max-3.jpg" alt="">
                                    </td>
                                    </a>

                                    <td>
                                        <a href="">
                                            Iphone 14 promax 64gb
                                        </a>

                                    </td>
                                    <td>Đơn giá</td>
                                    <td>thành tiền</td>
                                    <td>thành tiền</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection