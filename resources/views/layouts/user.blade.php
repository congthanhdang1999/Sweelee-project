<!DOCTYPE html>
<html>

<head>
    <title>SWEE LEE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('user/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('css')
</head>

<body>
    @yield('comments')

    <div id="site">
        <div id="container">
            <div id="header-wp" style="background-color: #00483d;">
                <div id="head-top" class="clearfix" style="background-color: #00483d;">
                    <div class="wp-inner" style="background-color: #00483d;">

                        @if(Auth::user())
                        <a href="{{route('profile.index')}}" title="" id="payment-link" class="fl-left">
                            {{Auth::user()->name}}
                        </a>
                        @else
                        <a href="{{route('login')}}" title="" id="payment-link" class="fl-left">
                             Đăng nhập
                             <i class="fa-solid fa-user"></i>
                        </a>
                        @endif

                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{route('home')}}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{route('post.index')}}" title="">Bài viết</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix" style="background-color: #00483d;">
                    <div class="wp-inner">
                        <a href="{{route('home')}}" title="" id="logo" class="fl-left"><img src="{{asset('user/images/sweelee.svg')}}" width="150px" height="50px" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="" action="{{route('product.search')}}">
                                <input type="text" name="keyword" id="s" value="{{request()->input('keyword')}}" placeholder="Hôm nay bạn cần tìm gì?">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                                <!-- <select name="price_filter">
                                    <option value="0">Sắp xếp</option>
                                    <option value="3">2tr đến 3tr</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select> -->
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0386.719.273</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="{{route('cart.index')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">{{Cart::count()}}</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num" class="num-total">{{Cart::count()}}</span>
                                </div>
                                @if(Cart::count()>0)
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{Cart::count()}}</span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        @foreach(Cart::content() as $product)
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="{{asset($product->options->thumbnail)}}" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">{{$product->name}}</a>
                                                <p class="price">{{number_format($product->price,0,0,'.')}}đ
                                                <p>
                                                <p class="qty">Số lượng: <span>{{$product->qty}}</span></p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">{{Cart::total()}}</p>
                                    </div>
                                    <div class="action-cart text-right" style="text-align: center">
                                        <a href="{{route('cart.index')}}" title="Giỏ hàng" class="view-cart">Giỏ hàng</a>
                                    </div>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div id="footer-wp">
                <div id="foot-body" style="background-color: #00483d; color: #fff;">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">SWEE LEE</h3>
                            <p class="desc">SWEE LEE luôn cung cấp luôn là sản phẩm có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop" style="color: #fff;">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>1120 - Bạch Mai - Hai Bà Trưng - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0386.719.273 - 0964.592.802</p>
                                </li>
                                <li>
                                    <p>sweeleemusic@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="POST" action="">
                                    <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="52IEuu29"></script>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script src="{{asset('user/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('user/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
        <script src="{{asset('user/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('user/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset('user/js/main.js')}}" type="text/javascript"></script>
        <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
        @yield('js')
</body>

</html>
