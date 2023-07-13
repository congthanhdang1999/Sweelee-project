@extends('layouts.user')
@section('css')
<style>
    .section-detail__item {
        border-radius: 5%;
    }
</style>
@endsection
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        @include('sweetalert::alert')
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach($slider as $item)
                    <div class="item">
                        <img src="{{asset($item->image_path)}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{asset('user/images/icon-1.png')}}">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('user/images/icon-2.png')}}">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('user/images/icon-3.png')}}">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('user/images/icon-4.png')}}">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('user/images/icon-5.png')}}">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($featureProduct as $product)
                        <li class="section-detail__item">
                            <a href="{{route('detail.product',$product->id)}}" title="" class="thumb">
                                <img src="{{asset($product->feature_image_path)}}">
                            </a>
                            <a href="{{route('detail.product',$product->id)}}" title="" class="product-name">{{$product->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->sale_price, 0, 0, '.')}}đ</span>
                                <span class="old">{{number_format($product->price, 0, 0, '.')}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$product->id)}}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{route('checkout.index')}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">iPhone</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($iphones as $iphone)
                        <li class="section-detail__item">
                            <a href="{{route('detail.product',$iphone->id)}}" title="" class="thumb">
                                <img src="{{asset($iphone->feature_image_path)}}" width="200px" height="200px">
                            </a>
                            <a href="{{route('detail.product',$iphone->id)}}" title="" class="product-name">{{$iphone->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($iphone->sale_price, 0, 0, '.')}}đ</span>
                                <span class="old">{{number_format($iphone->price, 0, 0, '.')}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$iphone->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Samsung</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($samsungs as $samsung)
                        <li class="section-detail__item">
                            <a href="{{route('detail.product',$samsung->id)}}" title="" class="thumb">
                                <img src="{{asset($samsung->feature_image_path)}}" width="200px" height="200px">
                            </a>
                            <a href="{{route('detail.product',$samsung->id)}}" title="" class="product-name">{{$samsung->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($samsung->sale_price, 0, 0, '.')}}đ</span>
                                <span class="old">{{number_format($samsung->price, 0, 0, '.')}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$samsung->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        <div class="sidebar fl-left">
            @include('components.sidebar')
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Phụ kiện</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($accessory as $accessory)
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="{{asset($accessory->feature_image_path)}}"  alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">{{$accessory->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($accessory->sale_price, 0, 0, '.')}}đ</span>
                                    <span class="old">{{number_format($accessory->
                                        price, 0, 0, '.')}}đ</span>
                                </div>
                                <a href="{{route('cart.add',$accessory->id)}}" title="" class="buy-now">Thêm giỏ hàng</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11">
    // if (session('status'))
    //     Swal.fire(
    //         'Cảm ơn!',
    //         'Bạn đã đặt hàng thành công',
    //         'success'
    //     )
    // endif
</script>

@endsection
