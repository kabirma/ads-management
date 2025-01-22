<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Role;

class PageController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;

    public function __construct()
    {
        $this->title = "Page";
        $this->model_primary = "id";
        $this->view_page = "pages.page.view";
        $this->store_page = "pages.page.store";
        $this->redirect_page = "view.page";
        $this->model = Page::class;
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
                if($key == 'category' && $request->id == 0){
                    $req = str_replace(" ","_",strtolower($request->title));
                }
                $model->$key = $req;
            }
        }
        $this->ImageUpload($model,"image",$request,"pages");
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
