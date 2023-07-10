<?php
namespace App\Traits;
use Storage;
trait StorageImageTrait{
    public function storageTraitUpload($request,$fieldName,$folder){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            //file name
            $fileNameOrigin = $file->getClientOriginalname();
            //let use str_random. Can install helper via composer
            $fileNameHash = str_random(20) . '.' .$file->getClientOriginalExtension();
            $file_path = $request->file($fieldName)->storeAs('public/product/'.Auth()->id(),$fileNameHash);
            $dataUpload = [
                'file_name'=> $fileNameOrigin,
                'file_path' => Storage::url($file_path)
            ];
            return $dataUpload;
        }
        return null;
        
        

    }
    public function storageTraitUploadVideo($request,$fieldName,$folder){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            //file name
            $fileNameOrigin = $file->getClientOriginalname();
            //let use str_random. Can install helper via composer
            $fileNameHash = str_random(20) . '.' .$file->getClientOriginalExtension();
            $file_path = $request->file($fieldName)->storeAs('public/product/'.Auth()->id(),$fileNameHash);
            $dataUpload = [
                'file_path' => Storage::url($file_path)
            ];
            return $dataUpload;
        }
        return null;

    }
    public function storageTraitUploadMultiple($file,$folder){
            //file name
            $fileNameOrigin = $file->getClientOriginalname();
            //let use str_random. Can install helper via composer
            $fileNameHash = str_random(20) . '.' .$file->getClientOriginalExtension();
            $file_path = $file->storeAs('public/product/'.Auth()->id(),$fileNameHash);
            $dataUpload = [
                'file_name'=> $fileNameOrigin,
                'file_path' => Storage::url($file_path)
            ];
            return $dataUpload;
    }
}

?>