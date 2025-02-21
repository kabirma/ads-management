<?php
namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Campaign;
use App\Models\AdGroup;
use App\Models\Ads;

class SnapChatController extends Controller
{

    private $apiUrl;
    private $redirectUrl;
    private $clientSecret;
    private $clientId;
    private $setting;

    public function __construct() {
        $this->redirectUrl =  config('services.snapchat.snapchat_redirect_uri');
        $this->apiUrl =  config('services.snapchat.snapchat_api_url');
        $this->clientSecret = config('services.snapchat.snapchat_client_secret');
        $this->clientId = config('services.snapchat.snapchat_client_id');
        $this->setting = Company::find(1);
    }

    public function authSnapChat(){
      
        $clientId = $this->clientId;
        $redirectUri = urlencode($this->redirectUrl);
        $responseType = 'code';
        $scope = 'snapchat-marketing-api';

        $authUrl = "https://accounts.snapchat.com/login/oauth2/authorize?client_id={$clientId}&redirect_uri={$redirectUri}&response_type={$responseType}&scope={$scope}";
        dd($authUrl);
        return redirect($authUrl);
    }

    public function redirectToSnapChat(Request $request){
        dump($request->all(),'rediirect');
        $code = $request->query('code');
        
        if (!$code) {
            return response()->json(['error' => 'Authorization code not provided'], 400);
        }

        $response = Http::asForm()->post('https://accounts.snapchat.com/login/oauth2/access_token', [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->redirectUrl,
        ]);
        dump($response);
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => $response->body()], $response->status());
        }
    }
}