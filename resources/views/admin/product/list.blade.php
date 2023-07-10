@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline ">
                <form action="">
                    <input type="text" class="form-control form-search float-left" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm sản phẩm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'product_active']) }}" class="text-primary">Kích hoạt<span class="text-muted">({{$countProduct[0]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'product_trash']) }}" class="text-primary">Vô hiệu hoá<span class="text-muted">({{$countProduct[1]}})</span></a>
            </div>
            <form action="{{route('check.test')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <!-- <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option>Tác vụ 1</option>
                        <option>Tác vụ 2</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary"> -->
                </div>

                <table class="table table-striped table-checkall">

                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Ảnh chi tiết</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($listProduct->total()>0)
                        @php
                        $stt = 1
                        @endphp
                        @foreach($listProduct as $product)
                        <tr class="">
                            <td>
                                <input name="ids[]" type="checkbox" value="{{$product->id}}">
                            </td>
                            <td>{{$stt++}}</td>
                            <td><img src="{{asset($product->feature_image_path)}}" alt="" width="80px" height="80px"></td>
                            <td>{{$product->name}}</td>
                            <td>{{number_format($product->sale_price, 0, 0, '.')}}đ</td>
                            <td>
                                <a href="{{route('product.image',$product->id)}}" class="btn btn-outline-info" data-toggle="tooltip" title="Ảnh chi tiết"><i class="fas fa-images"></i></a>
                            </td>
                            <td>{{$product->category->name}}</td>
                            @if($product->quantity == 0)
                            <td><span class="badge badge-success">Hết hàng</span></td>
                            @else
                            <td><span class="badge badge-danger">Còn hàng</span></td>
                            @endif
                            <td>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('product.delete',$product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">Không có bản sản phẩm nào</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{$listProduct->links()}}
        </div>
    </div>
</div>
@endsection