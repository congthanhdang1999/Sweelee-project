@extends('layouts.user')
@section('css')
<style>
    .not-cart {
        text-align: center;

    }

    .num-order-cart {
        width: 45px;
        text-align: center;
    }

    .not-cart>img {
        width: 40%;
        margin: auto;

    }

    .num-product-wp .minus,
    .num-product-wp .plus {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border: 1px solid #a0a0a0;
        font-family: "Roboto Regular";
        color: #515151;
        font-size: 10px;
        cursor: pointer;
    }

    .num-product-wp .minus:hover {
        color: #3a9800;
        border: 2px solid #3a9800;
    }

    .num-product-wp .plus:hover {
        color: #f00;
        border: 2px solid #f00;
    }

    .num-product-wp .minus.disabled {
        pointer-events: none;
        background-color: #d7d4d4;
    }
</style>
@endsection
@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="wrapper" class="wp-inner clearfix">
        @if(Cart::count()>0)
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">

                <form action="{{route('checkout.index')}}" method="POST">
                    @csrf
                    <table class="table update_cart_url" data-url="{{route('cart.update')}}">
                        <thead>
                            <tr>
                                <td colspan="1">
                                    <input name="checkall" type="checkbox">
                                </td>
                                <td>Tên sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Cart::content() as $product)
                            <tr>
                                <td scope="col">
                                    <input name="item[]" type="checkbox" value="{{$product->rowId}}">
                                </td>
                                <td>
                                    <a href="{{route('detail.product',$product->id)}}" title="" class="name-product">{{$product->name}}</a>
                                </td>
                                <td>
                                    <a href="{{route('detail.product',$product->id)}}" title="" class="thumb">
                                        <img src="{{asset($product->options->thumbnail)}}" alt="">
                                    </a>
                                </td>
                                <td>{{number_format($product->price, 0, 0, '.')}}đ</td>
                                <td>
                                    <input type="number" name="qty[{{$product->rowId}}]" id="" value="{{$product->qty}}" min="1" max="{{$product->options->inventory_number}}" data-rowid="{{$product->rowId}}" class="num-order-cart">

                                </td>
                                <td id="sub-total-{{$product->rowId}}">{{number_format($product->price * $product->qty, 0, 0, '.')}}đ</td>
                                <td>
                                    <a href="{{route('cart.delete',$product->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span  class="total-cart">{{number_format(Cart::subtotal(0,'',''),0, 0, '.')}}đ</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input type="submit" id="checkout-cart" value="Thanh toán">
                                            <!-- <a href="{{route('checkout.index')}}" title="" id="checkout-cart">Thanh toán</a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="{{route('cart.destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
        @else
        <div class="not-cart">
            <img src="{{ asset('user/images/download.png') }}" alt="">
            <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
            <a href="{{route('home')}}" class="btn btn-outline-success" title="trang chủ">Quay trở về Trang
                chủ</a>
        </div>
        @endif
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('user/js/cart.js')}}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('.num-order-cart').change(function() {
            event.preventDefault();
            var rowId = $(this).attr("data-rowid");
            var qty = $(this).parents('tr').find('input.num-order-cart').val();
            var urlUpdate = $(".update_cart_url").data("url");
            $.ajax({
                url: urlUpdate,
                method: "GET",
                data: {
                    rowId: rowId,
                    qty: qty
                },
                dataType: "json",
                success: function(data) {
                    //alert("nhận dữ liệu thành công")
                    if (data.code == 200) {
                        $("#sub-total-" + rowId + "").text(data.subTotal + "đ");
                        setInterval(function () {
                            $("#dropdown-cart-wp").load(
                                location.href + " #dropdown-cart-wp"
                            );
                        }, 2000);
                        $(".num-total").text(data.num);
                        $(".total-cart").text(data.total + "đ");
                    }
                },
            });
            //alert(urlUpdate)
            //alert(quantity);
            //alert(dataId);

        });
    })
</script>
@endsection