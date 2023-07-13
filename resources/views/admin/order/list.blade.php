@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center ">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>

            <div class="form-search form-inline">
                <form action="">
                    <input type="text" class="form-control form-search float-left" value="{{request()->input('search')}}" name="search" placeholder="Tìm kiếm đơn hàng">
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
                <a href="{{route('order.index')}}" class="text-primary">Tất cả<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statusOrder' => 'processing']) }}" class="text-primary">Đang xử lý<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statusOrder' => 'delivery']) }}" class="text-primary">Đang giao<span class="text-muted">({{$count[2]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statusOrder' => 'success']) }}" class="text-primary">Hoàn thành<span class="text-muted">({{$count[3]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statusOrder' => 'cancel']) }}" class="text-primary">Đã bị huỷ<span class="text-muted">({{$count[4]}})</span></a>
            </div>
            <div class="form-action form-inline py-3">

            </div>
            <table class="table table-striped table-checkall text-center">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->total() > 0)
                    @php
                    $stt = 1
                    @endphp
                    @foreach($orders as $item)
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>

                        <td>{{$stt++}}</td>
                        <td>{{$item->code}}</td>
                        <td>
                            {{$item->users->name}}<br>
                            {{$item->users->phone}}
                        </td>
                        <td>{{$item->orderDetails->sum('quantity')}}</td>
                        <td>{{number_format($item->total,0,0,'.')}}đ</td>
                        @if($item->status == 0)
                        <td><span class="badge badge-warning">Đang xử lý</span></td>
                        @elseif($item->status == 1)
                        <td><span class="badge badge-warning">Đang giao hàng</span></td>
                        @elseif($item->status == 2)
                        <td><span class="badge badge-warning">Hoàn thành</span></td>
                        @else
                        <td><span class="badge badge-warning">Đã huỷ</span></td>
                        @endif
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td class="bottom__action">
                            <a href="{{route('order.detail',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-eye"></i></a>
                            
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9">Không có đơn hàng</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>
</div>


@endsection
