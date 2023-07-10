@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/product/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="price">Giá gốc </label>
                            <input class="form-control" type="text" name="price" id="price" placeholder="Nhập giá gốc sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Giá sale</label>
                            <input class="form-control" type="text" name="sale_price" id="sale_price" placeholder="Nhập giá sale sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input class="form-control" type="text" name="quantity" id="quantity" placeholder="Nhập số lượng sản phẩm">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fileUpLoads">Chọn ảnh đại diện</label>
                            <input class="form-control" type="file" value="Thêm hình ảnh" name="feature_image_name" id="fileUpLoads">
                        </div>
                        <div class="form-group">
                            <label for="fileUpLoads">Ảnh chi tiết</label>
                            <input class="form-control" type="file" value="Thêm hình ảnh" name="img_path[]" multiple="multiple" id="fileUpLoads">
                        </div>
                        <div class="form-group">
                            <label for="video">Video sản phẩm</label>
                            <input class="form-control" type="file" name="video" id="video">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="short_desc">Ưu đãi sản phẩm</label>
                    <textarea name="short_desc" class="form-control" id="short_desc" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Chi tiết sản phẩm</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="category_product_id">
                        <option value="0">Danh mục cha</option>
                        @foreach ($data_select as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Nổi bật
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            Không nổi bật
                        </label>
                    </div>
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