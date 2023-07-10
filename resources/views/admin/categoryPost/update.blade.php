@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật danh mục bài viết
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('categoryPost.store',$categoryPost->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$categoryPost->name}}">
                            @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection