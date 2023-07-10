@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục sản phẩm
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{url('admin/cat_product/store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="parent_id">
                                <option value="0">Danh mục cha</option>
                                @foreach ($data_select as $key => $val)
                                <option value="{{$key}}">{{ $val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $t = 1;
                            @endphp

                            @foreach ($categories as $item)
                            <tr>
                                <th scope="row">{{ $t++}}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                @if ($item->parent_id == 0)
                                <td></td>
                                @else
                                <td>{{ $item->catProductParent->name }}</td>
                                @endif
                                <td>
                                    <a href="{{route('category_product.getupdate',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="{{route('category_product.delete',$item->id)}}" onclick="return confirm('Bạn chắc chắn xoắ danh mục này')" class="btn btn-danger btn-sm rounded-0 text-white" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection