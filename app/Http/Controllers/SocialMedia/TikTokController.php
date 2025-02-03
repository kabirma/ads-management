<?php
namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;

class TikTokController extends Controller
{

    // Step 1: Redirect user to TikTok's OAuth page
    public function redirectToTikTok()
    {
        $query = http_build_query([
            'client_key' => config('services.tiktok.client_key'),
            'response_type' => 'code',
            'scope' => 'user.info.basic,video.publish,video.upload',
            'redirect_uri' => config('services.tiktok.redirect'),
            'state' => csrf_token(), // For CSRF protection
        ]);
        
        return redirect("https://www.tiktok.com/v2/auth/authorize/?" . $query);
    }

    // Step 2: Handle TikTok's callback and exchange code for access token
    public function handleTikTokCallback(Request $request)
    {
        if ($request->has('error')) {
            return redirect()->route('user_setting')->with('error', 'TikTok authorization failed.');
        }

        $code = $request->get('code');
        // Step 3: Exchange authorization code for access token using v2 endpoint
        $response = Http::asForm()->post('https://open.tiktokapis.com/v2/oauth/token/', [
            'client_key' => config('services.tiktok.client_key'),
            'client_secret' => config('services.tiktok.client_secret'),
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('services.tiktok.redirect'),
        ]);
        
        $data = $response->json();
        
        if (isset($data['access_token'])) {
            $user = User::find(Auth::user()->id);
            $user->tiktok_token = $data['access_token'];
            $user->tiktok_refresh_token = $data['refresh_token'];
            $user->tiktok_token_expiry = now()->addSeconds($data['expires_in']);
            $user->save();
            
            return redirect()->route('dashboard')->with('success', 'TikTok connected successfully!');
        }
        return redirect()->route('dashboard')->with('error', 'Failed to retrieve TikTok access token.');
    }
}
