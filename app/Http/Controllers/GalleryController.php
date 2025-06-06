<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Role;
use App\Models\User;
use Auth;

class GalleryController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;
    protected $model_parent;

    public function __construct()
    {
        $this->title = "Media";
        $this->model_primary = "id";
        $this->view_page = "pages.gallery.view";
        $this->store_page = "pages.gallery.store";
        $this->redirect_page = "view.media";
        $this->model = Media::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        if(Auth::user()->role_id === 1){
            $data['listing'] = $this->model::orderBy('id','desc')->get();
        }else{
            $data['listing'] = $this->model::where('user_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
        }
        return view($this->view_page, $data);
    }

    public function userMedia($id)
    {
        $user = User::find($id);
        $data['title'] = ($user->full_name ?? $user->name) . "'s ".$this->title;
        $data['listing'] = $this->model::where('user_id',$id)->orderBy('id','desc')->get();
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
        $this->ImageUpload($model,"media",$request,"gallery","media");
        $model->user_id =  Auth::guard('web')->user()->id;
        $model->save();
        return redirect()->route($this->redirect_page)->with("success", $this->title . " " . __('messages.saved_successfully'));
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . " " . __('messages.deleted_successfully'));
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
