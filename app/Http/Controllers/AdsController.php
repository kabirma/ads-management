<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Company;
// use App\Models\AdsImage;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPackage;
use App\Http\Controllers\SocialMedia\TikTokController;
use App\Http\Controllers\SocialMedia\SnapChatController;
use App\Http\Controllers\AIController;
use Auth;
use session;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class AdsController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;
    protected $child_model;

    protected const AI_SESSION_KEY = 'ai_session';

    public function __construct()
    {
        $this->title = "Ads";
        $this->model_primary = "id";
        $this->view_page = "pages.ads.view";
        $this->store_page = "pages.ads.store";
        $this->redirect_page = "view.ads";
        $this->redirect_store_page = "add.ads";
        $this->model = Ads::class;
        // $this->child_model = AdsImage::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        if(Auth::user()->role_id === 1){
            $data['listing'] = $this->model::orderBy('id','desc')->get();
        }else{
            $data['listing'] = $this->model::where('user_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
        }
        $data['addHide'] = 0;

        return view($this->view_page, $data);
    }

    public function userAds($id)
    {
        $user = User::find($id);
        $data['title'] = ($user->full_name ?? $user->name) . "'s ".$this->title;
        $data['listing'] = $this->model::where('user_id',$id)->orderBy('id','desc')->get();
        $data['addHide'] = 1;
        return view($this->view_page, $data);
    }

    public function add($ai = 0)
    {
        $userPackage = UserPackage::where('user_id',Auth::guard('web')->user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
        if(!isset($userPackage)){
            return view('auth.package',['title'=>'Subscribe to Packages']);
        }
        $data['title'] = $this->title;
        $data['days'] = 0;
        if($ai == 1){
            $aiSuggestion = session(self::AI_SESSION_KEY);
            if($aiSuggestion !== null && $aiSuggestion !== ''){
                $data = $aiSuggestion;
            }
        }else{
            session([self::AI_SESSION_KEY=>'']);
        }
        
        return view($this->store_page, $data);
    }

    public function addAI()
    {
        $userPackage = UserPackage::where('user_id',Auth::guard('web')->user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
        if(!isset($userPackage)){
            return view('auth.package',['title'=>'Subscribe to Packages']);
        }

        $data['title'] = "Create Ads Using AI";
        return view("pages.ads.ai", $data);
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['record'] = $this->model::with('galleries')->where($this->model_primary, $id)->first();
        $tags = [];
        $company = Company::first();
        $tags = explode(',',$company->tags);
        $data['tags'] = $tags;
        $series = explode(',',$company->series);
        $data['series'] = $series;

        return view($this->store_page, $data);
    }

    private function validateImageResolution(Request $request){
        $url = $request->media;
        $social = $request->social_media;
       
        $image = Image::make(public_path($url));
        $width = $image->width();
        $height = $image->height();

        $valid = false;

        if ($social === 'snapchat') {
            $allowed = [
                ['width' => 1080, 'height' => 1920],
            ];
        }
        else if ($social === 'tiktok') {
            $allowed = [
                ['width' => 720, 'height' => 1280],
                ['width' => 1200, 'height' => 628],
                ['width' => 640, 'height' => 640],
                ['width' => 640, 'height' => 100],
                ['width' => 600, 'height' => 500],
                ['width' => 640, 'height' => 200],
            ];
        }

        $valid = collect($allowed)->contains(function ($size) use ($width, $height) {
            return $width >= $size['width'] && $height >= $size['height'];
        });

        if (!$valid) {
            return $allowed;
        }

        return [];
    }

    public function save(Request $request)
    {
        
        $dates = explode(" - ",$request->dates);
        $request->merge(
            [
                'from'=>$dates[0],
                'to'=>$dates[1]
            ]
        );
        
        $adRequest = new AdRequest();

        $validator = Validator::make(
            $request->all(),
            $adRequest->rules(),
            $adRequest->messages()
        );

        if ($validator->fails()) {
            $error['error']['error']['error']= collect($validator->errors()->all())->first();
            return json_encode([400, $error]);
        }

        $allowedRes = $this->validateImageResolution($request);
        if(count($allowedRes)){
            $sizes = array_map(fn($size) => "{$size['width']} x {$size['height']}", $allowedRes);
            $error['error']['error']['error']= 'Image Should be in following Width & Height '. implode(", ", $sizes);
            return json_encode([400, $error]);
        }

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        if ($to->diffInDays($from) < 1) {
            $error['error']['error']['error']= 'The end date must be at least one day after the start date.';
            return json_encode([400, $error]);
        }

        if($request->social_media == 'tiktok'){
            $tiktokController = new TikTokController();
            $response = $tiktokController->campiagnCreation($request);
            if($response !== null && array_key_exists('error',$response)){
                $error['error']['error']['error'] = $response['error']; 
                return json_encode([400, $error]);
            }
        }else if($request->social_media == 'snapchat'){
            $snapchatController = new SnapChatController();
            $response = $snapchatController->campiagnCreation($request);
            if($response !== null && array_key_exists('error',$response)){
                return json_encode([400, $response['error']]);
            }
        }

        return json_encode([200, $this->title . " Saved Successfully"]);
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . " Deleted Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function delete_image($id)
    {
        $data = $this->child_model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success","Image Deleted Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function status($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        $change_status=$data->status==1 ? 0 : 1;
        if (!is_null($data)) {
            $this->model::where('id',$id)->update(['status'=>$change_status]);
            return redirect()->route($this->redirect_page)->with("success", $this->title . " Status Updated Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function detail($id, $platform){
        $title = "Ads Detail";
        if($platform === 'tiktok'){
            $tiktok = new TikTokController();
            $response = $tiktok->fetchAds($id);
            if(count($response)){
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.tiktok',compact("title","apiResponse","ad"));
        }else if($platform === 'snapchat'){
            $snapchat = new SnapChatController();
            $response = $snapchat->fetchAds($id);
            if(count($response)){
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.snapchat',compact("title","apiResponse","ad"));
        }
    }

    public function generateAd(Request $request){
        $aiController = new AIController();
        tryAgain:
        $response = $aiController->fetchContent($request);
        if($response != ''){
            $suggestion = explode("$==$",$response);
            
            if(count($suggestion) !== 7){
                goto tryAgain;
                return redirect()->back()->with("error", "Something went wrong. Please try again.");
            }

            $name = $suggestion[0];
            $description = $suggestion[1];
            $budget = (int)$suggestion[2];
            $days = (int)$suggestion[3];
            $gender = $suggestion[4];
            $age = $suggestion[5];
            $socialMedia = $suggestion[6];

            $startDate = new \DateTime('tomorrow');
            $endDate = new \DateTime('tomorrow');
            if(is_int($days)){
                $endDate = $endDate->modify("+$days Days");
            }

            $data['title'] = $this->title;
            $data['name'] = $name;
            $data['description'] = $description;
            $data['budget'] = $budget;
            $data['days'] = $days;
            $data['gender'] = $gender;
            $data['age'] = $age;
            $data['social_media'] = $socialMedia;
            $data['ai_sugguested'] = 1;
            session([self::AI_SESSION_KEY=>$data]);
            return redirect()->route('add.ads',['ai'=>1]);
        }

        return redirect()->back()->with("error", "Something went wrong. Please try again.");
    }
}
