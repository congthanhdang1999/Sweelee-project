<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductImages;
class ProductImageController extends Controller
{
    private $productImages;
    public function __construct(ProductImages $productImages){
        $this->productImages = $productImages;
    }
    public function show($id){
        $detailImages =  $this->productImages->where('product_id',$id)->get();
        return view('admin.productImage.list', compact('detailImages'));
        //dd($detailImage);
    }
    public function delete($id){
        $this->productImages->find($id)->delete();
        return back()->with('status','Xoá hình ảnh thành công');
    }
}
