<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;

class PaymentController extends Controller
{
    protected $entityId;
    protected $token;
    protected $checkoutUrl;
    protected $scriptUrl;

    public function __construct()
    {
        $this->checkoutUrl = config('services.payment.checkout_url');
        $this->entityId = config('services.payment.entity_id');
        $this->token = config('services.payment.token');
        $this->scriptUrl = config('services.payment.script_url');
    }

    public function createCheckoutSession($amount)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->asForm()->post($this->checkoutUrl, [
            'entityId' => $this->entityId,
            'amount' => $amount,
            'currency' => 'SAR',
            'paymentType' => 'DB',
            'integrity' => 'true',
        ]);

        if($response === null){
            return '';
        }

        $response = $response->json();
        if($response['result']['code'] !== '000.200.100'){
            return '';
        }

        return $response;
    }

    public function fetchCheckoutSession($checkoutId)
    {
        $url = $this->checkoutUrl . '/' . $checkoutId . '/payment';
        $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $this->token,
        ])->get($url, [
            'entityId' => $this->entityId,
        ]);

        if ($response->failed()) {
            return '';
            dd([
                'status' => 'error',
                'code' => $response->status(),
                'body' => $response->body()
            ]);
        }

        if($response === null){
            return '';
        }

        $response = $response->json();
        if($response['result']['code'] === '000.100.110'){
            return $response;
        }

        if($response['result']['code'] === '100.396.101'){
            return 'CANCELLED';
        }

        return '';
    }

    public function walletTopUp(Request $request)
    {
        $response = $this->createCheckoutSession($request->amount);
        if(empty($response)){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $user = Auth::user();
        $data = [
            'checkoutUrl' => $this->scriptUrl . $response['id'],
            'integrity' => $response['integrity'],
            'amount' => $request->amount,
            'user' => $user,
            'ref' =>  rand(100000,999999).urlencode($user->id).rand(100000,999999),
        ];
        return view('payment.payment', $data);
    }

    public function walletTopUpRedirect(Request $request){
        $response = $this->fetchCheckoutSession($request['id']);
        if(empty($response)){
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        if($response === 'CANCELLED'){
            return redirect()->back()->with('error', 'Cancelled By the User');
        }
        $refId = $request['ref'];
        $userId = substr($refId, 6, -6);
        $user = User::find($userId);
        $user->wallet += $response['amount'];
        $user->save();

        $this->createTransaction([
            'user_id' => $user->id,
            'amount' => $response['amount'],
            'ref_id' => 0,
            'ref' => 'wallet',
            'payment_id' => $response['id'],
            'payment_response' => json_encode($response)
        ]);

        return redirect()->route('dashboard')->with("success", "Wallet Top Up Successfull");
    }

    function walletTopUpCancel(){
        return redirect()->route('dashboard')->with("error", "Wallet Top Up Cancel");
    }
}
