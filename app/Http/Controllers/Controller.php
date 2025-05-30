<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\Campaign;
use App\Models\AdGroup;
use App\Models\Ads;
use App\Models\Media;
use App\Models\Company;
use App\Models\LogResponse;
use App\Models\Transaction;
use DateTime;
use App\Http\Controllers\AIController;


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

    public function saveMedia($field,$request,$location = "company",$reference_id)
    {
        if($request->hasFile($field)){
            $filenameWithExt = $request->file($field)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($field)->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file($field)->storeAs("media/".$location."/",$fileNameToStore);
            $fullPath = "storage/media/".$location."/".$fileNameToStore;
           
            $mediaDB = new Media();
            $mediaDB->name = $filename;
            $mediaDB->media = $fullPath;
            $mediaDB->media_type = $field;
            $mediaDB->reference_id = $reference_id;
            $mediaDB->reference_table = 'ads';
            $mediaDB->user_id = Auth::guard('web')->user()->id;
            $mediaDB->save();
            
            return $fullPath;
        }
    }

    
    function campaignCreationDB($data): int {
        if(count($data) === 0){
            return 0;
        }
        $campaign = isset($data['id']) ? Campaign::where('id', $data['id'])->first() : new Campaign();
        foreach ($data as $key => $req) {
            if ($key != "id") {
                $campaign->$key = $req;
            }
        }
        try{
            $campaign->save();
            return $campaign->id;
        }catch(\Exception $ex){
            dd($ex);
            return 0;
        }
    }

    function adGroupCreationDB($data): int {
        if(count($data) === 0){
            return 0;
        }
        $adGroup = isset($data['id']) ? AdGroup::where('id', $data['id'])->first() : new AdGroup();
        foreach ($data as $key => $req) {
            if ($key != "id") {
                $adGroup->$key = $req;
            }
        }
        try{
            $adGroup->save();
            return $adGroup->id;
        }catch(\Exception $ex){
            dd($ex);

            return 0;
        }
    }

    function adCreationDB($data): int {
        if(count($data) === 0){
            return 0;
        }
        $ad = isset($data['id']) ? Ads::where('id', $data['id'])->first() : new Ads();
        foreach ($data as $key => $req) {
            if ($key != "id") {
                $ad->$key = $req;
            }
        }
        try{
            $ad->save();
            return $ad->id;
        }catch(\Exception $ex){
            dd($ex);

            return 0;
        }
    }

    function validateImage($request, $field){
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);
    
        $image = $request->file($field);
        $imagePath = $image->getPathname();
    
        list($width, $height) = getimagesize($imagePath);
    
        $allowedSizes = [
            [720, 1280],
            [1200, 628],
            [640, 640],
            [640, 100],
            [600, 500],
            [640, 200],
        ];
    
        $validSize = false;
        foreach ($allowedSizes as $size) {
            if ($width == $size[0] && $height == $size[1]) {
                $validSize = true;
                break;
            }
        }
    
        if (!$validSize) {
            return back()->with(['error' => 'Invalid image size. Allowed sizes: 720x1280, 1200x628, 640x640, 640x100, 600x500, 640x200 pixels.']);
        }
    
    }

    public function refreshSnapChatAccessToke($clientSecret, $clientId){
        $setting = Company::find(1);
        $refreshToken = $setting->snapchat_refresh_toke;
        $expiry = new \DateTime($setting->snapchat_access_token_expiry);
        $currentTime = new \DateTime('now');
        $diff = $currentTime->getTimestamp() - $expiry->getTimestamp();
        if ($diff > (50 * 60)) {
            $response = Http::asForm()->post('https://accounts.snapchat.com/login/oauth2/access_token', [
                'refresh_token' => $refreshToken,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'refresh_token',
            ]);
        
            $data = $response->json();
            if(!array_key_exists('error',$data)){
                $setting->snapchat_access_token_expiry = $currentTime;
                $setting->snapchat_access_token = $data['access_token'];
                $setting->snapchat_refresh_toke = $data['refresh_token'];
                $setting->save();

                return $setting;
            }
        }

        return $setting;

    }

    function logResponse($data){
        $log = new LogResponse();
        $log->reference_id = $data['reference_id'];
        $log->reference_table = $data['reference_table'];
        $log->request = $data['request'];
        $log->url = $data['url'];
        $log->response = $data['response'];
        $log->user_id = Auth::guard('web')->user()->id;
        $log->save();
    }

    function dateDiff($start,$end){
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);

        $diff = $date1->diff($date2);
        return $diff->days + 1;
    }

    
    public function validateData($request){
        $from = (new \DateTime($request->from));
        $to = (new \DateTime($request->to));
        $budget = (int)$request->budget;

        $diff = $from->diff($to);
        
        if($budget/($diff->days + 1) < 5){
            return ['error'=>'Budget should be atleast 5 SAR per day'];
        }

        $mediaType = $request->media_type == 1 ? "image" : "video";
        if ($request->media == '') {
            return ['error' => 'No '.$mediaType.' uploaded'];
        }

        if($to->format('Y-m-d') < $from->format('Y-m-d')){
            return ['error' => 'Campaign end date can not be before start date'];
        }

        return [];
    }

    public function modifyError($error){
        $aiController = new AIController();
        return $aiController->modifyErrorContent($error);
    }

    public function dateRangeList($start, $end, $format){
        $startDate = new DateTime(substr($start, 0, 10));
        $endDate = new DateTime(substr($end, 0, 10));

        $dates = [];

        while ($startDate <= $endDate) {
            $dates[] = $startDate->format($format);
            $startDate->modify('+1 day');
        }

        return $dates;
    } 

    public function createTransaction($data){
        $transaction = new Transaction();
        $transaction->user_id = $data['user_id'];
        $transaction->amount = $data['amount'];
        $transaction->ref_id = $data['ref_id'];
        $transaction->ref = $data['ref'];
        $transaction->payment_id = $data['payment_id'];
        if(array_key_exists('payment_response', $data)){
            $transaction->payment_response = $data['payment_response'];
        }
        $transaction->save();
    }
}
