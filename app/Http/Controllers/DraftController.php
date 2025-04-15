<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft;
use App\Models\Role;

class DraftController extends Controller
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
        $this->title = "Draft";
        $this->model_primary = "id";
        $this->view_page = "pages.draft.view";
        $this->store_page = "pages.draft.store";
        $this->redirect_page = "view.draft";
        $this->model = Draft::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['listing'] = $this->model::where('status',0)->orderBy('id','desc')->get();
        return view($this->view_page, $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        $data['parent'] = $this->model_parent::orderBy('id','desc')->get();
        return view($this->store_page, $data);
    }

    public function continue($id)
    {
        $data['title'] = $this->title;
        $record = $this->model::where($this->model_primary, $id)->first();
        $draft = json_decode($record->value);
        $dates = explode(' - ', $draft->dates);
        $data['name'] = $draft->title;
        $data['description'] = $draft->description;
        $data['website_url'] = $draft->website_url;
        $data['call_to_action'] = $draft->call_to_action;
        $data['budget'] = $draft->budget;
        $data['goal'] = $draft->goal;
        $data['gender'] = $draft->gender;
        $data['days'] = $this->dateDiff(...$dates);
        $data['start_date'] = $dates[0];
        $data['end_date'] = $dates[1];
        $data['social_media'] = $draft->social_media;
        $data['step_count'] = $draft->step;
        $data['media'] = $draft->media;
        $data['media_type'] = $draft->media_type;
        $data['ai_sugguested'] = 0;
        return view('pages.ads.store', $data);
    }

    public function save(Request $request)
    {
        $model = $request->id > 0 ? $this->model::where('id', $request->id)->first() : new $this->model;
        $data = $request->all();
        unset($data['id']);
        unset($data['_token']);
        $data_json = json_encode($data);
        $model->name = $data['social_media'];
        $model->value = $data_json;
        $model->status = 0;
        $model->type = 'ads';
        // $this->ImageUpload($model,"image",$request,"drafts");
        $model->save();
        return $model->id;
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
