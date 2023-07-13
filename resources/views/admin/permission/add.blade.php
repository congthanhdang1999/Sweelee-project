@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">

                    <div class="card-header font-weight-bold">
                        Thêm quyền
                    </div>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{route('permission.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên quyền</label>
                                <input class="form-control" type="text" value="{{old('name')}}" name="name" id="name">
                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="checkbox" class="check-all" name="" id="post">
                                <label for="post" class="m-0">Lựa chọn quyền</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="checkbox" class="permission" value="view" name="permission[]"
                                           id="product.view">
                                    <label for="product.view">View</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="permission" value="add" name="permission[]"
                                           id="product.add">
                                    <label for="product.add">add</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="permission" value="edit" name="permission[]"
                                           id="product.edit">
                                    <label for="product.edit">Edit</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" class="permission" value="delete" name="permission[]"
                                           id="product.delete">
                                    <label for="product.delete">Delete</label>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col">
                                    @error('permission')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card border">
                    <div class="card-header font-weight-bold">
                        Danh sách
                    </div>
                    @foreach($list_permission as $permission => $values)
                        <div class="card-body pb-0">
                            <div class="card my-2 border">
                                <div class="card-header">
                                    <input type="checkbox" class="check-all" name="" id="post">
                                    <label for="post" class="m-0">{{$permission}}</label>
                                </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($values as $value)
                                                @php
                                                    $permission_name = explode('.',$value->keycode)[1]
                                                @endphp
                                            <div class="col-md-3">

                                                <input type="checkbox" class="permission" value="{{$value->id}}"
                                                       name="permission_id[]"
                                                       id="{{$value->keycode}}">
                                                <label for="{{$value->keycode}}">{{$permission_name}}</label>

                                            </div>
                                            @endforeach
                                        </div>

                                    </div>


                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>


    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.check-all').click(function () {
            $(this).closest('.card').find('.permission').prop('checked', this.checked)
        })
    </script>
@endsection
