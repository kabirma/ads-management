<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\UserPackage;
use App\Models\User;
use App\Models\Transaction;
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
        $user = Auth::user();
        $userPackage = new UserPackage;
        $userPackage->package_id = $request->package_id;
        $userPackage->price = $request->price;
        $userPackage->expire_at = (new \DateTime('+1 Month'))->format('Y-m-d');
        $userPackage->user_id = $user->id;
        $userPackage->status = 1;
        $userPackage->save();

        $this->createTransaction([
            'user_id' => $user->id,
            'amount' => $request->price,
            'ref_id' => $request->package_id,
            'ref' => 'user_package',
            'payment_id' => '',
        ]);

        return redirect()->route('dashboard')->with("success", "Purcahse Was Successful");
    }


    public function viewTransaction()
    {
        $user = Auth::user();
        if($user->role_id == 1){
            $data['listing'] = Transaction::get();
        } else{
            $data['listing'] = Transaction::where('user_id', $user->id)->get();
        }
        $data['title'] = 'Transactions';
        return view('pages.transaction.view',$data);
    }

}
