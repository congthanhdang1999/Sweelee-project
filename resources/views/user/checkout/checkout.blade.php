@extends('layouts.user')
@section('css')
    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        body {

            background: linear-gradient(to right, #0a346d, #1598ef);
        }

        .card-signin {
            border: 0;
            border-radius: 0rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-signin .card-body {
            padding: 2rem;
        }

        .form-signin {
            width: 100%;
        }

        .form-signin .btn {
            font-size: 80%;
            border-radius: 0rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input {
            height: auto;
        }

        .form-label-group > input,
        .form-label-group > label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .btn-google {
            color: white;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white;
            background-color: #3b5998;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@section('content')
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            @include('sweetalert::alert')
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{route('home')}}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <form method="POST" action="{{route('order.add')}}">
                <div class="section" id="customer-info-wp">
                    @if(Auth::user())
                        <div class="section-head">
                            <h1 class="section-title">Thông tin khách hàng</h1>
                        </div>
                        @csrf
                        <div class="section-detail">
                            <div class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" class="form-control" name="fullname" id="fullname"
                                       value="{{Auth::user()->name}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}"
                                       id="email" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address"
                                       value="{{Auth::user()->information->address}}" id="address" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone"
                                       value="{{Auth::user()->information->phone}}" id="phone" placeholder="">
                            </div>
                        </div>
                    @else
                        <h5 class="card-title text-center ">Vui lòng đăng nhập để tiến hành đặt hàng</h5>

                    @endif
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(Session::get('item_order') as $item)
                                <tr class="cart-item">
                                    <td class="product-name">{{$item->name}}<strong
                                            class="product-quantity">x({{$item->qty}})</strong></td>
                                    <td class="product-total">{{number_format($item->price * $item->qty, 0, 0, '.')}}đ
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                @foreach(Session::get('cartTotal') as $total)
                                    <td><strong class="total-price">{{number_format($total, 0, 0, '.')}}đ</strong></td>
                                @endforeach
                            </tr>
                            </tfoot>
                        </table>

                        <div class="place-order-wp clearfix">
                            <input type="submit" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
