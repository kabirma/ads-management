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

    public function refreshTikTokToken(){
        $response = Http::asForm()->post('https://open.tiktokapis.com/v2/oauth/token/', [
            'client_key' => config('services.tiktok.client_key'),
            'client_secret' => config('services.tiktok.client_secret'),
            'grant_type' => 'refresh_token',
            'refresh_token' => Auth::user()->tiktok_refresh_token,
        ]);
        
        $data = $response->json();
        
        if (isset($data['data']['access_token'])) {
            $user = Auth::user();
            $user->tiktok_token = $data['data']['access_token'];
            $user->tiktok_refresh_token = $data['data']['refresh_token'];
            $user->tiktok_token_expiry = now()->addSeconds($data['data']['expires_in']);
            $user->save();
        }
    }
}
