@extends('layouts.user')
@section('css')
<style>
    .section-detail__item {
        border-radius: 5%;
    }
</style>
@endsection
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"></h3>
                    <div class="filter-wp fl-right">

                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="price_filter">
                                    
                                    <option value="3">2tr đến 3tr</option>
                                    
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($listProduct as $item)
                        <li class="section-detail__item">
                            <a href="{{route('detail.product',$item->id)}}" title="" class="thumb">
                                <img src="{{asset($item->feature_image_path)}}" width="200px" height="200px">
                            </a>
                            <a href="{{route('detail.product',$item->id)}}" title="" class="product-name">{{$item->name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->sale_price, 0, 0, '.')}}đ</span>
                                <span class="old">{{number_format($item->price, 0, 0, '.')}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
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