<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class CustomerController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;

    public function __construct()
    {
        $this->title = "Customer";
        $this->model_primary = "id";
        $this->view_page = "pages.customer.view";
        $this->store_page = "pages.customer.store";
        $this->redirect_page = "view.customer";
        $this->model = User::class;
    }



    public function index()
    {
        $data['title'] = $this->title;
        $data['listing'] = $this->model::where('id',"!=",1)->orderBy('id','desc')->get();
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
        $model = $request->id > 0 ? $this->model::where($this->model_primary, $request->id)->first() : new $this->model;
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id") {
                $model->$key = $req;
            }
        }
        $model->save();

        if(Auth::user()->role_id !== 1){
            return redirect()->back()->with("success", "Profile Updated Successfully");
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
}
