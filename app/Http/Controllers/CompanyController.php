<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Role;

class CompanyController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;

    public function __construct()
    {
        $this->title = "Company";
        $this->model_primary = "id";
        $this->view_page = "pages.company.index";
        $this->redirect_page = "company";
        $this->model = Company::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['record'] = $this->model::where($this->model_primary, 1)->first();
        return view($this->view_page, $data);
    }

    public function save(Request $request)
    {
        $model = $request->id > 0 ? $this->model::where('id', $request->id)->first() : new $this->model;
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id") {
                $model->$key = $req;
            }
        }
        $this->ImageUpload($model,"about_image",$request,"about","about_image");
        $this->ImageUpload($model,"mission_image",$request,"mission","mission_image");
        $this->ImageUpload($model,"our_team_image",$request,"our_team","our_team_image");
        $this->ImageUpload($model,"vision_image",$request,"vision","vision_image");
        $this->ImageUpload($model,"cover",$request,"homepage","cover");
        $this->ImageUpload($model,"logo",$request,"settings","logo");
        $this->ImageUpload($model,"favicon",$request,"settings","favicon");
        $model->save();
        return redirect()->route($this->redirect_page)->with("success", $this->title . " Saved Successfully");
    }

}
