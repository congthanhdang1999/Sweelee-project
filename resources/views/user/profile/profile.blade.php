@extends('layouts.user')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .avatar {
        margin: 0 auto;
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
                        <img src="{{asset('/user/images/user.png')}}" alt="avatar" class="avatar rounded-circle img-fluid" width="100px">
                        <h5 class="my-3">{{Auth::user()->name}}</h5>


                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{route('profile.store')}}">
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
                        @if(Auth::user()->information->count() > 0)
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số điện thoại</p>
                            </div>
                            @foreach(Auth::user()->information as $key)
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$key->phone}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Địa chỉ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$key->address}}</p>
                            </div>
                            @endforeach
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
        
    </div>
</section>
@endsection