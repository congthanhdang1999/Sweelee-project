<?php

namespace App\Http\Controllers;

use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use App\Slider;

class AdminSliderController extends Controller
{
    use StorageImageTrait;
    public function show()
    {
        $sliders = Slider::all();
        return view('admin.slider.list', compact('sliders'));
    }
    public function add(Request $request)
    {
        $dataSliderCreate = [
            'user_id' => Auth()->id()
        ];
        $dataUploadSliderImage = $this->storageTraitUpload($request, 'slider_image_path', 'slider');
        if (!empty($dataUploadSliderImage)) {
            $dataSliderCreate['image_path'] = $dataUploadSliderImage['file_path'];
            $dataSliderCreate['image_name'] = $dataUploadSliderImage['file_name'];
        }
        //dd($dataSliderCreate);
        Slider::create($dataSliderCreate);
        return redirect('admin/slider/list')->with('status', 'thêm hình ảnh thành công');
    }

    public function delete($id){
        Slider::find($id)->delete();
        return redirect('admin/slider/list')->with('status','Xoá hình ảnh thành công');
    }
}
