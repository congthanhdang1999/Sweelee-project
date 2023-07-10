@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách vai trò</h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="text" class="form-control form-search float-left"
                               value="" name="keyword" placeholder="Tìm kiếm">
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


                <div class="form-action form-inline py-1">

                </div>
                <table class="table table-striped table-checkall text-center align-items-center">
                    <thead>

                        <th scope="col">
                            <input type="checkbox" name="listCheck[]">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col-3">Mô tả vai trò</th>
                        <th scope="col-3">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>

                    </thead>
                    <tbody>

                    @php
                        $stt = 1
                    @endphp
                    @foreach($listRole as $role)
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td >{{$stt++}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{ date('d/m/Y', strtotime($role->created_at)) }}</td>
                            <td class="">
                                <a href="{{route('role.edit',$role->id)}}"
                                   class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                   data-toggle="tooltip" data-placement="top" title="Edit"><i
                                        class="fa fa-edit"></i></a>
                                <a href="{{route('role.delete',$role->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá vai trò này không!')"
                                   class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                   data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
