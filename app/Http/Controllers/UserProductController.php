<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{
    private $product;
    private $categoryProduct;
    private $brand;
    public function __construct(Product $product, CategoryProduct $categoryProduct, Brand $brand)
    {
        $this->brand = $brand;
        $this->categoryProduct = $categoryProduct;
        $this->product = $product;
    }
    public function show($id, Request $request)
    {
        // $check_brand_id = $request->input('select_brand');
        // //echo($check_brand);
        // //return $request->all();
        // //sidebar
        //dd($request->all());
        $category_limit = $this->categoryProduct->where('parent_id', 0)->get();
        $categoryProduct = $this->categoryProduct->find($id);
        // $category_product = $this->categoryProduct->find($id);
        if ($categoryProduct->parent_id == 0) {
            //get category child from category parent
            $categoryChilds = $this->categoryProduct->where('parent_id', $id)->get();
            foreach ($categoryChilds as $category) {
                $listId[] = $category->id;
            }
            $listProduct = $this->product->whereIn('category_product_id', $listId)->get();
        } else {
            $listProduct = $this->product->where('category_product_id', $id)->paginate(12);
            //dd($listProduct);
        }
        return view('user.product.list', compact('category_limit', 'listProduct'));
        //return view('user.product.list',compact('category_limit','listProduct','categoryProduct'));
    }
    public function search(Request $request)
    {
        // dd($request->all());
        // $filter = $request->price_filter;
        //echo $filter;
        $category_limit = $this->categoryProduct->where('parent_id', 0)->get();
        $keyword = "";
        // if($filter){
        //     $listProduct = $this->product->where('price', '<', 5000000)->get();
        // }
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
            //dd($keyword);
            $listProduct = $this->product->where('name', 'like', "%{$keyword}%")->orderBy('id', 'DESC')->get();
        } 
        return view('user.product.list', compact('category_limit', 'listProduct'));
    }
    public function check(Request $request){
        dd($request->all());
        return view('user.order.update');
        return view('user.order.test');
        return view('user.order.detailOrder');
        return view('user.order.order');
    }
    public function detailProduct($id)
    {
        $detailProduct = $this->product->find($id);
        $category_limit = $this->categoryProduct->where('parent_id', 0)->get();

        return view('user.product.detailProduct', compact('detailProduct', 'category_limit'));
    }
}
