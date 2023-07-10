@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật thông tin người dùng
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('user.update',$user->id)}}">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="role_id[]" class="form-control" id="role_select_choose" multiple>
                        @foreach ($roles as $role)
                        <option {{$roleOfUser->contains('id', $role->id) ? 'selected' :''}} value="{{$role->id}}">{{$role->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#role_select_choose").select2({
        placeholder: "Chọn vai trò",
    })
</script>
@endsection