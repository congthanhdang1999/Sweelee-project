<?php

namespace App\Helpers;

namespace App\Http\Controllers;


use App\CategoryProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    public function show()
    {
        $categories = CategoryProduct::latest()->paginate(8);
        $data_select= dataSelect(new CategoryProduct);
        //dd($categories);
        return view('admin.categoryProduct.list', compact('data_select', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
            ],
            [
                'required' => 'Tên danh mục không được để trống',
                'min' => 'Tên danh mục chứa ít nhất 3 ký tự'
            ]
        );
        CategoryProduct::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);
        return redirect('admin/cat_product/list')->with('status', 'Thêm danh mục sản phẩm thành công');
    }

    public function getUpdate($id)
    {
        $category = CategoryProduct::find($id);
        $data_select = dataSelect(new CategoryProduct);
        //print_r($category);
        return view('admin.categoryProduct.update', compact('data_select', 'category'));
    }

    public function update($id, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|unique:category_products,name,' . $id . ',id',
            ],
            [
                'required' => 'Tên danh mục không được để trống',
                'unique' => 'Tên danh mục đã tồn tại',
                'min' => 'Tên danh mục chứa ít nhất 3 ký tự'
            ]
        );
        //echo $id;
        CategoryProduct::find($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);
        return redirect('admin/cat_product/list')->with('status', 'Bạn đã cập nhật danh mục thành công');
    }

    public function delete($id)
    {
        CategoryProduct::find($id)->delete();
        return redirect('admin/cat_product/list')->with('status', 'Xoá danh mục sản phẩm thành công');
    }
}
