<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Company;
// use App\Models\AdsImage;
use App\Models\Role;
use App\Models\UserPackage;
use App\Http\Controllers\SocialMedia\TikTokController;
use App\Http\Controllers\SocialMedia\SnapChatController;
use App\Http\Controllers\AIController;
use Auth;
use session;

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
        $data['listing'] = $this->model::where('user_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
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

    public function save(Request $request)
    {
        $dates = explode(" - ",$request->dates);
        $request->merge(
            [
                'from'=>$dates[0],
                'to'=>$dates[1]
            ]
        );

        if($request->social_media == 'tiktok'){
            $tiktokController = new TikTokController();
            $tiktokController->campiagnCreation($request);
        }else if($request->social_media == 'snapchat'){
            $snapchatController = new SnapChatController();
            $response = $snapchatController->campiagnCreation($request);
            if($response !== null && array_key_exists('error',$response)){
                return redirect()->route($this->redirect_store_page)->with("error", $response['error']);
            }
        }
        return redirect()->route($this->redirect_page)->with("success", $this->title . " Saved Successfully");
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
        $response = $aiController->fetchContent($request);
        if($response != ''){
            $suggestion = explode("$==$",$response);
            if(count($suggestion) !== 6){
                return redirect()->back()->with("error", "Something went wrong. Please try again.");
            }

            $name = $suggestion[0];
            $description = $suggestion[1];
            $budget = (int)$suggestion[2];
            $days = (int)$suggestion[3];
            $gender = $suggestion[4];
            $age = $suggestion[5];

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
            $data['social_media'] = $request->social_media;
            $data['ai_sugguested'] = 1;
            
            session([self::AI_SESSION_KEY=>$data]);
            return redirect()->route('add.ads',['ai'=>1]);
        }

        return redirect()->back()->with("error", "Something went wrong. Please try again.");
    }
}
