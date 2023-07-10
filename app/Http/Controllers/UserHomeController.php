<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    private $product;
    private $categoryProduct;
    private $slider;
    public function __construct(Product $product,CategoryProduct $categoryProduct,Slider $slider)
    {
        $this->product = $product;
        $this->categoryProduct = $categoryProduct;
        $this->slider = $slider;
    }

    
    public function index()
    {
        $slider = $this->slider->all();
        $guitars = $this->categoryProduct->find(1)->productParent->take(8);
        $pianos = $this->categoryProduct->find(4)->productParent->take(8);
        $featureProduct = $this->product->where('status',0)->orderBy('id','DESC')->get();
        $products = $this->product->take(8)->get();
        $category_limit = $this->categoryProduct->where('parent_id',0)->get();
        $accessory = $this->categoryProduct->find(6)->productParent->take(5);
        //dd($accessory);
        //$guitar8 = $guitar->paginate(8);
        //dd($guitars);
        //dd($products);
        return view('user.home',compact('guitars','pianos','featureProduct','products','slider','category_limit','accessory'));
    }
    public function sidebar(){
        $category_limit = $this->categoryProduct->where('parent_id',0)->get();
        return view('components.sidebar',compact('category_limit'));
    }
}
