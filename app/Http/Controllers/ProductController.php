<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\CategoryProduct;
use App\Product;
use App\ProductImages;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;

use Storage;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $product;
    private $productImages;

    public function __construct(Product $product, ProductImages $productImages)
    {
        $this->product = $product;
        $this->productImages = $productImages;
    }

    public function show(Request $request)
    {
        //dd($request->input('keyword'));
        $keyword = "";
        $status = $request->input('status');
        if ($status == "product_trash") {
            $listProduct = $this->product->onlyTrashed()->paginate(8);
        } else {
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $listProduct = $this->product->where('name', 'like', "%{$keyword}%")->orderBy('id','DESC')->paginate(8);
        }
        $count_product_active = $this->product->count();
        $count_product_trash = $this->product->onlyTrashed()->count();
        $countProduct = [$count_product_active, $count_product_trash];
        //dd($listProduct);
        return view('admin.product.list', compact('listProduct', 'countProduct'));
    }
    public function add()
    {

        $data_select = dataSelect(new CategoryProduct);
        return view('admin.product.add', compact('data_select'));
    }
    public function store(Request $request)
    {

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        //$link_youtube = $request->video;
        //$a = "youtube";
        //dd($link_youtube);
        //$url_youtube = Str::replaceArray('https://youtu.be/',['https://youtube.com/embed/'],$link_youtube);
        //php artisan storage:linkdd($request->all());

        $dataProductCreate = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'user_id' => Auth()->id(),
            'category_product_id' => $request->category_product_id,
        ];
        //dd($dataProductCreate);
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_name', 'product');
        if (!empty($dataUploadFeatureImage)) {
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        //insert data video
        $dataUploadVideo = $this->storageTraitUpload($request, 'video', 'product');
        if (!empty($dataUploadVideo)) {
            $dataProductCreate['video'] = $dataUploadVideo['file_path'];
        }
        $product = $this->product->create($dataProductCreate);
        //dd($product);
        //dd($dataUploadFeatureImage);

        // insert data to product_images
        if ($request->hasFile('img_path')) {
            foreach ($request->img_path as $fileItem) {
                $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                $product->images()->create([
                    'product_id' => $product->id,
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name'],
                ]);
            }
        }
        //dd($dataProductCreate);


        return redirect('admin/product/list')->with('status', 'Thêm sản phẩm thành công');
    }
    public function edit($id)
    {
        $product = $this->product->find($id);
        //$brands = $this->brand->all();
        $data_select = dataSelect(new CategoryProduct);
        return view('admin.product.update', compact('product', 'data_select'));
    }
    public function update($id, Request $request)
    {

        $dataProductUpdate = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth()->id(),
            'category_product_id' => $request->category_product_id,
        ];
        $dataUploadVideo = $this->storageTraitUpload($request, 'video', 'product');
        if (!empty($dataUploadVideo)) {
            $dataProductUpdate['video'] = $dataUploadVideo['file_path'];
        }
        //dd($dataProductUpdate);
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_name', 'product');
        if (!empty($dataUploadFeatureImage)) {
            $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        //dd($dataProductUpdate);
        $product = $this->product->find($id)->update($dataProductUpdate);
        return redirect('admin/product/list')->with('status', 'Cập nhật sản phẩm thành công');
    }

    public function delete($id)
    {
        $this->product->find($id)->delete();
        return redirect('admin/product/list')->with('status', 'Xoá sản phẩm thành công');
    }
}
