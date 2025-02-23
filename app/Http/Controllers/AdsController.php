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
use Auth;

class AdsController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;
    protected $child_model;

    public function __construct()
    {
        $this->title = "Ads";
        $this->model_primary = "id";
        $this->view_page = "pages.ads.view";
        $this->store_page = "pages.ads.store";
        $this->redirect_page = "view.ads";
        $this->model = Ads::class;
        // $this->child_model = AdsImage::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['listing'] = $this->model::where('user_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
        return view($this->view_page, $data);
    }

    public function add()
    {
        $userPackage = UserPackage::where('user_id',Auth::guard('web')->user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
        if(!isset($userPackage)){
            return view('auth.package',['title'=>'Subscribe to Packages']);
        }

        if(Auth::user()->tiktok_refresh_token !== null){
            $this->refreshTikTokToken();
        }

        $data['title'] = $this->title;
        $tags = [];
        $company = Company::first();
        $tags = explode(',',$company->tags);
        $data['tags'] = $tags;
        $series = explode(',',$company->series);
        $data['series'] = $series;
        return view($this->store_page, $data);
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
            $snapchatController->campiagnCreation($request);
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
        }
    }
}
