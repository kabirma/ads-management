<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Company;
// use App\Models\AdsImage;
use App\Models\Role;
use App\Models\UserPackage;
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
        $data['listing'] = $this->model::orderBy('id','desc')->get();
        return view($this->view_page, $data);
    }

    public function add()
    {
        $userPackage = UserPackage::where('user_id',Auth::user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
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
        $model = $request->id > 0 ? $this->model::where('id', $request->id)->first() : new $this->model;
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id" && $key!="gallery") {
                $model->$key = $req;
            }
        }
        // $this->ImageUpload($model,"image",$request,"adss");
        $model->save();
        // $this->MultiImageUpload($this->child_model,$model->id,"gallery",$request,"adss/gallery");
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
}
