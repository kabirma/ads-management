<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BTS;
use App\Models\Role;
use App\Models\Event;

class BTSController extends Controller
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
        $this->title = "BTS";
        $this->model_primary = "id";
        $this->view_page = "pages.bts.view";
        $this->store_page = "pages.bts.store";
        $this->redirect_page = "view.bts";
        $this->model = BTS::class;
        $this->model_parent = Event::class;
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
        $data['parent'] = $this->model_parent::orderBy('id','desc')->get();
        return view($this->store_page, $data);
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['parent'] = $this->model_parent::orderBy('id','desc')->get();
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
        $this->ImageUpload($model,"image",$request,"btss");
        $model->save();
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
