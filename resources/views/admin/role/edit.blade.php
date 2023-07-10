@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Cập nhật vai trò</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search float-left" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{route('role.update',$role)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="text-strong" for="name">Tên vai trò</label>
                        <input class="form-control" value="{{$role->name}}" type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label class="text-strong" for="{{$role->display_name}}">Mô tả vai trò</label>
                        <input class="form-control" value="{{$role->display_name}}" type="text" name="display_name" id="{{$role->display_name}}">
                    </div>
                    <strong>Vai trò này có quyền gì?</strong>
                    <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn
                        quyền.</small>
                    <!-- List Permission  -->

                    @foreach($list_permission as $permissions => $values)
                        <div class="card my-4 border">
                            <div class="card-header">
                                <input type="checkbox" class="check-all" name="" id="product">
                                <label for="product" class="m-0">{{$permissions}}</label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($values as $value)
                                        @php
                                            $permission_name = explode('.',$value->keycode)[1]
                                        @endphp
                                            <div class="col-md-3">
                                                <input type="checkbox"
                                                       {{$permissionOfRole->contains('id', $value->id) ? 'checked' :''}}  class="permission"
                                                       value="{{$value->id}}" name="permission_id[]"
                                                       id="{{$value->name}}">
                                                <label for="{{$value->name}}">{{$permission_name}}</label>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="submit" name="btn-add" class="btn btn-primary" value="Cập nhật">
                </form>
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
