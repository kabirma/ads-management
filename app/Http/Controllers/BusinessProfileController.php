<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\Role;

class BusinessProfileController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;

    public function __construct()
    {
        $this->title = "Business Profile";
        $this->model_primary = "id";
        $this->view_page = "pages.business.view";
        $this->store_page = "pages.business.store";
        $this->redirect_page = "view.business";
        $this->model = BusinessProfile::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['listing'] = $this->model::orderBy('id','desc')->get();
        return view($this->view_page, $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        return view($this->store_page, $data);
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['record'] = $this->model::where($this->model_primary, $id)->first();
        return view($this->store_page, $data);
    }

    public function save(Request $request)
    {
        $model = $request->id > 0 ? $this->model::where('id', $request->id)->first() : new $this->model;
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id") {
                $model->$key = $req;
            }
        }
        $this->ImageUpload($model,"image",$request,"businessprofile");
        $model->save();
        return redirect()->route($this->redirect_page)->with("success", $this->title . " " .   __('messages.saved_successfully'));
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . " ".  __('messages.deleted_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error", __('messages.no_record_found'));
    }

    public function status($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        $change_status=$data->status==1 ? 0 : 1;
        if (!is_null($data)) {
            $this->model::where('id',$id)->update(['status'=>$change_status]);
            return redirect()->route($this->redirect_page)->with("success", $this->title . " " . __('messages.status_updated_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error", __('messages.no_record_found'));
    }
}
