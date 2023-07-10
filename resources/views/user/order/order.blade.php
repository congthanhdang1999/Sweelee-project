@extends('layouts.user')
@section('css')
<link rel="stylesheet" href="{{ asset('user/css/detail_order.css') }}">
@endsection
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div id="content" class="container-fluid detail-order">
            <div class="card info-order">
                <div class="card-header font-weight-bold">
                    Thông tin đơn hàng
                </div>
                <div class="card-body">
                    <ul class="list-item">
                        <li>
                            <h5 class="title">
                                <i class="fas fa-barcode"></i>
                                Mã đơn hàng
                            </h5>
                            <span class="order-id"></span>
                        </li>
                        <li>
                            <h5 class="title">
                                <i class="fas fa-clock"></i>
                                Thời gian đặt hàng
                            </h5>
                            <span class="order-time"></span>
                        </li>
                        <li>
                            <h5 class="title">
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
                                    <tr>
                                        <td>địa chỉ</td>
                                        <td>email</td>
                                        <td>được chưa</td>
                                        <td>ok chưa</td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                        <form method="post">
                            @csrf
                            <li>
                                <h5 class="title">
                                    <i class="fas fa-tasks"></i>
                                    Tình trạng đơn hàng
                                </h5>

                            </li>
                        </form>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold">
                    Sản phẩm đơn hàng
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" width="13%">Ảnh</th>
                                <th scope="col">Tên sản phâm</th>

                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>ảnh</td>
                                <td>sản phẩm</td>
                                <td>Đơn giá</td>
                                <td>thành tiền</td>
                                <td>thành tiền</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold">
                    Giá trị đơn hàng
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="title-num">Tổng số lượng sản phẩm</td>
                            <td class="detail-num">20000000</td>
                        </tr>
                        <tr class="total-order">
                            <td class="title-price">Tổng giá trị đơn hàng</td>
                            <td class="detail-price">200000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection