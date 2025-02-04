<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Role;

class PackageController extends Controller
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
        $this->title = "Pricing Packages";
        $this->model_primary = "id";
        $this->view_page = "pages.package.view";
        $this->store_page = "pages.package.store";
        $this->redirect_page = "view.package";
        $this->model = Package::class;
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
            if ($key != 'is_popular' && $key != "_token" && $key != "id") {
                if($key === 'social_media' || $key === 'features'){
                    $req = implode("?=", $req);
                }
                $model->$key = $req;
            }
        }
        $model->is_popular = isset($request->is_popular) ? 1 : 0;
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
