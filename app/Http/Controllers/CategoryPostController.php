<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryPost;
use Illuminate\Support\Str;
class CategoryPostController extends Controller
{
    public function show(){
        $categoryPost = CategoryPost::latest()->paginate(5);
        return view('admin.categoryPost.list',compact('categoryPost'));
    }
    public function add($id){
        return redirect('admin/cat_post/list')->with('status','Thêm danh mục bài viết thành công');
    }
    public function update($id,Request $request){
        $categoryPost = CategoryPost::find($id);
        return view('admin.categoryPost.update',compact('categoryPost'));
    }
    public function store(Request $request,$id){
        $request->validate(
            [
                'name' => 'required|min:3|unique:category_products',
            ],
            [
                'required' => 'Tên danh mục không được để trống',
                'unique' => 'Tên danh mục đã tồn tại',
                'min' => 'Tên danh mục chứa ít nhất 5 ký tự'
            ]
        );
        CategoryPost::find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
    
        return redirect('admin/cat_post/list')->with('status', 'Bạn đã cập nhật danh mục thành công');
    }
    public function delete($id){
        CategoryPost::find($id)->delete();
        return redirect('admin/cat_post/list')->with('status', 'Bạn đã xoá danh mục thành công');
    }
}
