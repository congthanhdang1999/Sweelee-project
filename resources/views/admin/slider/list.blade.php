@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm slider
                </div>
                <div class="card-body">
                    <form action="{{url('admin/slider/add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="slider">Ảnh slider</label>
                            <input id="slider" type="file" name="slider_image_path">
                            @error('image_path')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách slider
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
                                    <th scope="col" width="20%">Ảnh slider</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Ngày tạo</td>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($sliders->count() > 0)
                                    @php
                                        $t = 1;
                                    @endphp
                                    @foreach ($sliders as $item)
                                        <tr>
                                            <td scope="row">{{ $t++ }}</td>
                                            <td ><img class="img-fluid" src="{{ asset($item->image_path)}}" width="100px" height="150px"
                                                    alt=""></td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <!-- <a href=""
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a> -->

                                                    <a href="{{ route('slider.delete', ['id' => $item->id]) }}"
                                                        onclick="return confirm('Bán có chắc chắn muốn xóa tạm bản ghi này')"
                                                        class="btn btn-danger btn-sm rounded-0" data-toggle="tooltip"
                                                        title="Delete"><i class="fa fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">Không có bản ghi nào</td>
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
