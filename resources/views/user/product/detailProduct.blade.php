@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/detail_product.css') }}">
@endsection
@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            @include('sweetalert::alert')
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">{{$detailProduct->category->name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">

                        <div class="thumb-wp fl-left">

                            <img id="main__thumbnail" src="{{asset($detailProduct->feature_image_path)}}"/>

                            <div id="list-thumb">
                                @foreach($detailProduct->images as $item)
                                    <img src="{{asset($item->image_path)}}" alt="">
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>


                        <div class="info fl-right">
                            <h3 class="product-name">{{$detailProduct->name}}</h3>
                            <div class="desc">
                                {!!$detailProduct->short_desc!!}
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">Còn hàng</span>
                            </div>
                            <del class="old_price">{{number_format($detailProduct->price,0,0,'.')}}đ</del>
                            <p class="price">{{number_format($detailProduct->sale_price,0,0,'.')}}đ</p>
                            <form action="{{ route('cart.add', $detailProduct->id) }}" method="POST">
                                @csrf

                                <div id="num-order-wp">

                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>

                                </div>

                                <input type="submit" name="add-cart" value="Thêm vào giỏ" class="add-cart">
                            </form>

                        </div>

                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <div id="product-detail_id" class="product-detail detail-hide">

                            {!! $detailProduct->description !!}
                        </div>
                        <div class="readmore">
                            <a href="javascript:void();" class="readmore__bottom">Xem thêm</a>
                        </div>

                    </div>
                </div>
                @if($detailProduct->video)
                    <div class="section" id="same-category-wp">
                        <div class="section-head">
                            <h3 class="section-title">Video</h3>
                        </div>
                        <div class="section-detail">
                            <video width="100%" height="auto" controls>
                                <source src="{{asset($detailProduct->video)}}">
                            </video>
                        </div>
                    </div>
                @endif
                <div class="section" id="same-category-wp">

                    <div class="fb-comments" data-href="{{url()->current()}}" data-width="100%" data-numposts="5"></div>
                </div>


                <!-- <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/kawai/Grand/dan-piano-grand-kawai-gl20.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/roland/piano/piano-roland-501r-mau-den.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/roland/piano/piano-roland-501r-mau-den.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/kawai/Grand/dan-piano-grand-kawai-gl20.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/kawai/Grand/dan-piano-grand-kawai-gl20.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/kawai/Grand/dan-piano-grand-kawai-gl20.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            <li>
                                <a href="" title="" class="thumb">
                                    <img src="https://vietthuong.vn/image/catalog/kawai/Grand/dan-piano-grand-kawai-gl20.jpg">
                                </a>
                                <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                                <div class="price">
                                    <span class="new">17.900.000đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="sidebar fl-left">
                @include('components.sidebar')
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(
            $("#list-thumb img").click(function () {
                let imgPath = $(this).attr('src')
                $('#main__thumbnail').attr('src', imgPath)
                //alert(imgPath)
            })
        )
        $(".readmore__bottom").on('click', function () {
            $('#product-detail_id').attr('class', 'product-detail showcontent')
            //alert("ok")
        })
    </script>
@endsection
