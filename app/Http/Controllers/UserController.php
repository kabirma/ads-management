<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user()
    {
        $data = array();
        $data["roles"] = Role::where('id', '!=', 1)->get();
        return view('pages.user.all', $data);
    }
    public function customer()
    {
        $data = array();
        $data["roles"] = Role::where('id', 2)->get();
        return view('pages.user.customers', $data);
    }
    public function saveUser(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        if ($exists && $request->email != '') {
            $msg = 'User with same email Already Exists';
            $typ = 'error';
        } else {
            $data = new User;
            $data->full_name = $request->full_name;
            $data->role_id = $request->role_id;
            $data->phone = $request->phone;
            $data->mobile = $request->mobile;
            $data->email = ($request->email) ? $request->email : NULL;
            $data->name = $request->username;
            $data->status = $request->status;
            $data->email_verified_at = now();
            $data->password = Hash::make($request->password);
            $data->save();
            $msg = 'User Created Successfully';
            $typ = 'success';
        }
        $notification = array(
            'message' => $msg,
            'type' => $typ
        );
        return Response::json($notification);
    }
    public function updateUser(Request $request)
    {
        $exists = User::where('email', $request->email)->where('id', '!=', $request->cid)->exists();
        if ($exists && $request->email != '') {
            $msg = 'User with same email Already Exists';
            $typ = 'error';
        } else {
            $data = User::find($request->cid);
            $error = 0;
            if ($request->password) {
                $data->password = Hash::make($request->password);
            }
            if ($error == 0) {
                $data->full_name = $request->full_name;
                $data->role_id = $request->role_id;
                $data->phone = $request->phone;
                $data->mobile = $request->mobile;
                $data->email = ($request->email) ? $request->email : NULL;
                $data->name = $request->username;
                $data->status = $request->status;
                $data->save();
                $msg = 'User Updated Successfully';
                $typ = 'success';
            }
        }
        $notification = array(
            'message' => $msg,
            'type' => $typ
        );
        return Response::json($notification);
    }
    public function listUser(Request $request)
    {
        $type = $request->type;
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'name',
            3 => 'email',
            4 => 'role_id',
            5 => 'status',
            6 => 'action'
        );

        $totalData = User::when($type, function ($query, $type) {
            return $query->where('type', $type);
        })->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
            $posts = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =  User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->count();
        } else {
            $search = $request->input('search.value');
            $posts = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                })
                ->count();
        }
        $data = array();

        if ($posts) {
            foreach ($posts as $r) {
                $img = (is_null($r->image)) ? asset('images/user1.png') : asset($r->image);

                $nestedData['a'] =   $r->id;
                //                    '<div class="avatar pull-up my-0">
                //                    <img src="'.$img.'" alt="Avatar"height="35"width="35"/>
                //                </div>';


                $nestedData['b'] =  date('d M ,Y', strtotime($r->created_at));

                $nestedData['c'] = $r->name;
                $phone = (!is_null($r->phone)) ? '<b>Phone:</b> ' . $r->phone . '<br> ' : '';
                $email = (!is_null($r->email)) ? '<b>Email:</b> ' . $r->email . ',' : '';
                $nestedData['d'] = '<small>' . $phone . $email . '</small>';

                $nestedData['e'] = ($r->role_id == 1) ? '<span class="badge badge-pill badge-light-dark mr-1">System</span>' : '<span class="badge badge-pill badge-role mr-1" style="background-color:' . $r->role->label . '">' . $r->role->name . '</span>';

                if ($r->status == 1) {
                    $sts = '<span class="badge badge-pill badge-light-success mr-1">Active</span>';
                } else {
                    $sts = '<span class="badge badge-pill badge-light-danger mr-1">Inactive</span>';
                }

                $nestedData['f'] = $sts;

                $action2 = '<a class="editmdl" data-uid="' . $r->id . '" data-nm="' . $r->name . '" style="padding: 3px;color:#110436"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50" color="#00cfe8"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
                $nestedData['g'] = ($r->role_id == 1) ? '<span class="badge bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            </span>' : '<div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                    <a class="dropdown-item editmdl" href="#" data-cid="' . $r->id . '" data-fname="' . $r->full_name . '" data-uname="' . $r->name . '" data-email="' . $r->email . '" data-phone="' . $r->phone . '" data-mobile="' . $r->mobile . '" data-status="' . $r->status . '" data-role="' . $r->role_id . '">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item delbs" href="#" data-did="' . $r->id . '" data-ttl="' . $r->name . '" >
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>';


                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"          => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"          => $data
        );
        echo json_encode($json_data);
    }
    public function listCustomer(Request $request)
    {
        $type = $request->type;
        $columns = array(
            0 => 'id',
            1 => 'created_at',
            2 => 'name',
            3 => 'email',
            4 => 'status',
            5 => 'action'
        );

        $totalData = User::when($type, function ($query, $type) {
            return $query->where('type', $type);
        })->where('role_id', 2)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
            $posts = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->where('role_id', 2)->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =  User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->where('role_id', 2)->count();
        } else {
            $search = $request->input('search.value');
            $posts = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            })->where('role_id', 2)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::when($type, function ($query, $type) {
                return $query->where('type', $type);
            })->where('role_id', 2)
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                })
                ->count();
        }
        $data = array();

        if ($posts) {
            foreach ($posts as $r) {
                $img = (is_null($r->image)) ? asset('images/user1.png') : asset($r->image);

                $nestedData['a'] =   $r->id;
                //                    '<div class="avatar pull-up my-0">
                //                    <img src="'.$img.'" alt="Avatar"height="35"width="35"/>
                //                </div>';


                $nestedData['b'] =  date('d M ,Y', strtotime($r->created_at));

                $nestedData['c'] = $r->name;
                $phone = (!is_null($r->phone)) ? '<b>Phone:</b> ' . $r->phone . '<br> ' : '';
                $email = (!is_null($r->email)) ? '<b>Email:</b> ' . $r->email . ',' : '';
                $nestedData['d'] = '<small>' . $phone . $email . '</small>';

                if ($r->status == 1) {
                    $sts = '<span class="badge badge-pill badge-light-success mr-1">Active</span>';
                } else {
                    $sts = '<span class="badge badge-pill badge-light-danger mr-1">Inactive</span>';
                }

                $nestedData['e'] = $sts;





                $action2 = '<a class="editmdl" data-uid="' . $r->id . '" data-nm="' . $r->name . '" style="padding: 3px;color:#110436"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50" color="#00cfe8"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';

                $nestedData['f'] = ($r->role_id == 1) ? '<span class="badge bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star me-25"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            </span>' : '<div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" style="">
                    <a class="dropdown-item editmdl" href="#" data-cid="' . $r->id . '" data-fname="' . $r->full_name . '" data-uname="' . $r->name . '" data-email="' . $r->email . '" data-phone="' . $r->phone . '" data-mobile="' . $r->mobile . '" data-status="' . $r->status . '" data-role="' . $r->role_id . '">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                      <span>Edit</span>
                    </a>
                    <a class="dropdown-item delbs" href="#" data-did="' . $r->id . '" data-ttl="' . $r->name . '" >
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      <span>Delete</span>
                    </a>
                  </div>
                </div>';


                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"          => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"          => $data
        );
        echo json_encode($json_data);
    }
    public function statusUser(Request $request)
    {
        $user = User::find($request->cid);
        $user->status = $request->sts;

        if ($request->sts == 1) {
            $msg = 'User account is on Activated';
            $typ = 'success';
        } else if ($request->sts == 2) {
            $msg = 'User account is on Hold';
            $typ = 'warning';
        } else if ($request->sts == 0) {
            $msg = 'User account marked as verified';
            $typ = 'info';
            $user->email_verified_at = now();
            $user->status = 1;
        } else {
            $msg = 'User account is on Blocked';
            $typ = 'error';
        }
        $user->save();
        $notification = array(
            'message' => $msg,
            'type' => $typ
        );
        return Response::json($notification);
    }
    public function deleteUser(Request $request)
    {
        $agent = User::find($request->did);
        $agent->delete();
        $notification = array(
            'message' => 'User account is deleted Successfully',
            'type' => 'error'
        );
        return Response::json($notification);
    }
}
