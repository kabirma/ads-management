<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\UserPackage;
use App\Models\User;
use Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $data['title'] = 'Subscribe to Packages';
        $data['package'] = Package::limit(3)->get();
        return view('auth.package',$data);
    }

    public function purchase(Request $request)
    {
        $userPackage = new UserPackage;
        $userPackage->package_id = $request->package_id;
        $userPackage->price = $request->price;
        $userPackage->expire_at = (new \DateTime('+1 Month'))->format('Y-m-d');
        $userPackage->user_id = Auth::user()->id;
        $userPackage->status = 1;
        $userPackage->save();
        return redirect()->route('dashboard')->with("success", "Purcahse Was Successful");
    }

}
