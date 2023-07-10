@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách ảnh về sản phẩm
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form action="">
                        <table class="table table-striped table-checkall text-center">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">#</th>
                                    <th scope="col">Tên ảnh</th>
                                    <th scope="col" width="14%">Hình ảnh</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detailImages->count() > 0)
                                @php
                                $t = 1;
                                @endphp
                                @foreach ($detailImages as $item)
                                <tr>
                                    
                                    <td scope="row">{{ $t++ }}</td>
                                    <td>{{ $item->image_name}}</td>
                                    <td><img class="img-thumbnail" src="{{ asset($item->image_path) }}" alt=""></td>
                                    <td class="text-center">
                                        <a href="{{ route('productImage.delete', ['id' => $item->id]) }}" onclick="return confirm('Bán có chắc chắn muốn xóa tạm hình này')" class="btn btn-danger btn-sm rounded-0" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Không có bản ghi nào</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection