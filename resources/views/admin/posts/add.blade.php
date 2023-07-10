@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/post/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" id="name">
                </div>
                <div class="form-group">
                    <label for="feature_image">Hình ảnh</label>
                    <input class="form-control" type="file" name="feature_image" id="feature_image">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name= "category_post_id">
                        <option>Chọn danh mục</option>
                        @foreach($cat_post as $item)
                        <option value = "{{$item->id}}" >{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('tinymce')
<script src='https://cdn.tiny.cloud/1/91onsfaccc8juwnjlc2o1x9691007dwmrqw6y9jjaqjtdi5x/tinymce/4/tinymce.min.js'></script>
<script>
    var editor_config = {
        path_absolute: "http://localhost/KHMT/",
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
@endsection