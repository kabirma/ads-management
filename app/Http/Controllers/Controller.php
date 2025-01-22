<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ImageUpload(&$model,$field,$request,$location = "company",$field_database="image")
    {
        if($request->hasFile($field)){
            $filenameWithExt = $request->file($field)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($field)->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file($field)->storeAs("images/".$location."/",$fileNameToStore);
            $model->$field_database = "storage/images/".$location."/".$fileNameToStore;
        }
    }

    public function MultiImageUpload($model,$parent_id,$field,$request,$location = "company")
    {
        if($request->hasFile($field)){
            foreach($request->file($field) as $gallery){
                $filenameWithExt = $gallery->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $gallery->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $gallery->storeAs($location,$fileNameToStore);
                $gallery=new $model;
                $gallery->image = "storage/".$location.'/'.$fileNameToStore;
                $gallery->parent_id=$parent_id;
             
                $gallery->save();
            }
        }
    }
}
