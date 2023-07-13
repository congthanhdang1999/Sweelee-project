@extends('layouts.admin')
@section('content')
<div class="container-fluid py-5">
    <div class="row ">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$data['success']}}</h5>
                    <p class="card-text">Đơn hàng thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$data['processing']}}</h5>
                    <p class="card-text">Đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($successOrder,0,0,'.')}}đ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$data['cancel']}}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stt= 1
                    @endphp
                    @foreach($orders as $item)
                    <tr>
                    <td>
                            {{$stt++}}
                    </td>


                        <td>{{$item->code}}</td>
                        <td>
                            {{$item->users->name}}

                        </td>
                        <td>{{$item->orderDetails->sum('quantity')}}</td>
                        <td>{{number_format($item->total,0,0,'.')}}đ</td>

                        @if($item->status == 0)
                        <td><span class="badge badge-warning">Đang xử lý</span></td>
                        @elseif($item->status == 1)
                        <td><span class="badge badge-warning">Đang giao hàng</span></td>
                        @else
                        <td><span class="badge badge-warning">Hoàn thành</span></td>
                        @endif
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td class="bottom__action">
                            <a href="{{route('order.detail',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

</div>
@endsection
