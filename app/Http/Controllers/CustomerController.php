<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use App\Http\Services\MailService;

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
        $data['listing'] = $this->model::with('ads')->where('id', "!=", 1)->orderBy('id', 'desc')->get();
        return view($this->view_page, $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        $data['record'] = null; // Pass null for creating a new record
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
        if($request->password != $request->confirmPassword){
            return redirect()->route($this->redirect_page)->with("error", __('messages.PasswordDoesNotMatch'));
        }

        $model = $request->id > 0 ? $this->model::where($this->model_primary, $request->id)->first() : new $this->model;
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id" && $key != 'confirmPassword') {
                $model->$key = $req;
            }
        }
        $model->save();

        if(Auth::user()->role_id !== 1){
            return redirect()->back()->with("success", __('messages.ProfileUpdatedSuccessfully'));
        }

        return redirect()->route($this->redirect_page)->with("success", $this->title . " ".  __('messages.saved_successfully'));
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . ' '.  __('messages.deleted_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error", __('messages.no_record_found'));
    }

    function verify_email(MailService $mailService)
    {
        $company = Company::first();
        $user = Auth::user();

        $to = $user->email;
        $subject = 'Verify Your Email Address';
        $verificationUrl = url('/verfiy/user/' . rand(100000, 999999) . urlencode($user->id) . rand(100000, 999999));

        $html = '
            <html>
                <body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
                    <div style="max-width: 600px; margin: auto; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 30px;">
                        <h2 style="color: #333;">Hi ' . htmlspecialchars($user->name) . ',</h2>
                        <p style="font-size: 16px; color: #555;">
                            Thank you for registering with us! Please verify your email address by clicking the button below.
                        </p>
                        <p style="text-align: center; margin: 30px 0;">
                            <a href="' . $verificationUrl . '" style="background-color: #4CAF50; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                                Verify Email
                            </a>
                        </p>
                        <p style="font-size: 14px; color: #888;">
                            If you did not create an account, no further action is required.
                        </p>
                        <p style="font-size: 14px; color: #aaa; text-align: center; margin-top: 40px;">
                            &copy; ' . date('Y') . ' ' . $company->name . ' All rights reserved.
                        </p>
                    </div>
                </body>
            </html>
        ';

        $mailService->sendMail($to, $subject, $html);
        return redirect()->back()->with("success", __('messages.VerificationEmailSent'));
    }

    function verifyUser($token)
    {

        $userId = substr($token, 6, -6);
        $user = User::find($userId);
        if ($user != null) {
            $user->email_verified_at = date('Y-m-d h:i:s');
            $user->save();
            return view('home', ['success' => 1]);
        } else {
            return view('home', ['error' => 1]);
        }
    }
}
