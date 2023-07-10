@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="">
                    <input type="text" class="form-control form-search float-left" value="{{request()->input('keyword')}}" name="keyword" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích hoạt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu hoá<span class="text-muted">({{$count[1]}})</span></a>
            </div>
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
                        <th>
                            <input type="checkbox" name="listCheck[]">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($listUser->total()>0)
                    @php
                    $stt = 1
                    @endphp
                    @foreach($listUser as $user)
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <th scope="row">{{$stt++}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge badge-warning">{{$role->name}}</span>
                            @endforeach
                        </td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id() != $user->id)
                            <a href="{{ route('user.delete',$user->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="7">Không có bản ghi nào</td>
                        </tr>
                    @endif

                </tbody>
            </table>
            {{$listUser->links()}}
        </div>
    </div>
</div>
@endsection
