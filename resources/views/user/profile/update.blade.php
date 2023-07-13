@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .avatar {
            margin: 0 auto;
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
                            @if(Auth::user())
                                <form action="{{route('profile.update')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="fullname">Họ và tên</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                               aria-describedby="emailHelp" placeholder="Nhập họ tên"
                                               value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               aria-describedby="emailHelp" placeholder="Enter email"
                                               value="{{Auth::user()->email}}" disabled>
                                    </div>
                                    @if(!is_null(Auth::user()->information))

                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone"
                                                   value="{{Auth::user()->information->phone}}" name="phone"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Nhập số điện thoại của bạn!">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address"
                                                   value="{{Auth::user()->information->address}}" id="address"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Nhập địa chỉ của bạn!">
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Nhập số điện thoại của bạn!">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                   aria-describedby="emailHelp" placeholder="Nhập địa chỉ của bạn!">
                                        </div>
                                    @endif
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                                    </div>
                                </form>
                            @else
                                <form>
                                    <div class="form-group">
                                        <label for="fullname">Họ và tên</label>
                                        <input type="text" class="form-control" id="fullname"
                                               aria-describedby="emailHelp" placeholder="Nhập họ tên" disabled
                                               value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                               placeholder="Enter email" value="{{Auth::user()->email}}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" value=""
                                               placeholder="Nhập số điện thoại của bạn!">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Địa chỉ</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" value=""
                                               placeholder="Nhập địa chỉ của bạn!">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Thêm thông tin</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
