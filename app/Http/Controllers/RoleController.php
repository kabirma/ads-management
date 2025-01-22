<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Role;
class RoleController extends Controller
{
    public function roles()
    {
        $data = array();
        $data['title'] =  'Roles & Permissions Management';
        return view('pages.roles',$data);
    }
    public function listRoles(Request $request)
    {
        $columns = array(
            0 =>'id',
            1=> 'name',
            2=> 'label',
            3=> 'created_at',
            4=> 'action',
        );
        
        $totalData = Role::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
       
        if(empty($request->input('search.value')))
        {
            $posts = Role::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            $totalFiltered =  Role::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Role::where(function($q) use ($search){
                        $q->where('name', 'like', "%{$search}%")->orWhere('created_at', 'like', "%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            $totalFiltered = Role::where(function($q) use ($search){
                        $q->where('name', 'like', "%{$search}%")->orWhere('created_at', 'like', "%{$search}%");
                    })
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {   
            $nestedData['a'] = $r->id;
            $nestedData['b'] = ($r->id==1 || $r->id==2) ? '<span class="badge badge-light-dark">'.$r->name.'</span>' : $r->name;
            $nestedData['lbl'] =  '<div><span class="badge rounded-pill badge-up emptybadge" style="background-color: '.$r->label.'"> </span></div>';
            $nestedData['c'] = (!is_null($r->created_at)) ? date('d,M Y', strtotime($r->created_at)) : '....';
 
            $action = '<a class="editmdl" data-cid="'.$r->id.'" data-lbl="'.$r->label.'"  data-nm="'.$r->name.'" style="padding: 3px;color:#110436"><i class="ficon fa fa-edit info"></i></a>';

            $delete = ($r->id!=2 )? '<a class="dropdown-item delbs" href="#" data-did="'.$r->id.'" data-ttl="'.$r->name.'" >
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      <span>Delete</span>
                    </a>' : '';
            $action = ($r->id==1 ) ? '<span class="badge bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            </span>' :  '<div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                    <a class="dropdown-item editmdl" href="#" data-cid="'.$r->id.'" data-lbl="'.$r->label.'"  data-nm="'.$r->name.'">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                      <span>Edit</span>
                    </a>'.$delete.'
                    
                  </div>
                </div>';
            $nestedData['e'] = $action; 


            $data[] = $nestedData;
        }
    }     
        $json_data = array( "draw" => intval($request->input('draw')),"recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),"data" => $data );
        echo json_encode($json_data); 
    }
    public function saveRole(Request $request)
    {
//        $this->validate($request,
//        [
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
//        ]);
        $exists = Role::where('name',$request->name)->exists();
        if($exists)
        {
            $msg = 'Role Already Exists';
            $typ = 'error';
        }else{
            $role = new Role;
            $role->name = $request->name;
            $role->permissions = $request->permissions;
            $role->label = $request->label;
            $role->save();
            $msg = 'New Role Added Successfully';
            $typ = 'success';
            
        }
        $notification = array(
             'message' => $msg,
             'type' => $typ
         );
        return Response::json($notification);
    }
    public function updateRole(Request $request)
    {
//        $this->validate($request,
//        [
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
//        ]);
        $exists = Role::where('name',$request->name)->where('id','!=',$request->rid)->exists();
        if($exists){
            $msg = 'Role Already Exists';
            $typ = 'error';
        }else{
            $role = Role::find($request->rid);
            $role->name = $request->name;
            $role->permissions = $request->upermissions;
            $role->label = $request->label;
            $role->save();
            $msg = 'Role Information Updated Successfully';
            $typ = 'success';
            
        }
        $notification = array(
             'message' => $msg,
             'type' => $typ
         );
        return Response::json($notification);
    }
    public function statusRole(Request $request)
    {
        $user= Role::find($request->cid);
        $user->status = $request->sts;
        $user->save();
        if($request->sts==1){
            $msg= 'Role Activated';
            $typ= 'success';
        }else{
            $msg= 'Role Inactivated';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification);
    }
    public function deleteRole(Request $request)
    {
        $agent = Role::find($request->did);
        $agent->delete();
        $notification = array(
                 'message' => 'Role Deleted Successfully',
                 'type' => 'success'
             );
        return Response::json($notification);
    }
    public function getSingleRole(Request $request)
    {
        $data = array();
        $info = Role::find($request->id);
        if(count($info->permissions)>0){
            foreach ($info->permissions as $array){
                array_push($data, $array);
           }
        }
        return Response::json($data);
    }
}
