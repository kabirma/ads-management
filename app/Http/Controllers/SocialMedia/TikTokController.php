<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TikTokController extends Controller
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $redirectUri;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TIKTOK_API_KEY');       // Add this to .env
        $this->apiSecret = env('TIKTOK_API_SECRET'); // Add this to .env
        $this->redirectUri = env('TIKTOK_REDIRECT_URI'); // Add this to .env
    }

    public function redirectToTikTok()
    {
        $authUrl = "https://ads.tiktok.com/marketing_api/auth?app_id={$this->apiKey}&redirect_uri={$this->redirectUri}&state=xyz";
        return redirect()->away($authUrl);
    }

    public function handleCallback(Request $request)
    {
        $code = $request->input('auth_code');

        // Exchange the code for an access token
        $response = $this->client->post('https://business-api.tiktok.com/open_api/oauth2/access_token/', [
            'form_params' => [
                'app_id' => $this->apiKey,
                'secret' => $this->apiSecret,
                'auth_code' => $code,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $accessToken = $data['data']['access_token'];

        // Save the token securely (in session or database)
        session(['tiktok_access_token' => $accessToken]);

        return redirect('/dashboard')->with('success', 'TikTok Authenticated Successfully!');
    }

    public function createCampaign(Request $request)
    {
        $accessToken = session('tiktok_access_token');
        $advertiserId =  $this->getAdvertiserId();
        if($advertiserId === null){
            dd('error');
        }

        $response = $this->client->post('https://business-api.tiktok.com/open_api/v1.2/campaign/create/', [
            'headers' => [
                'Access-Token' => $accessToken,
            ],
            'json' => [
                'advertiser_id' => $advertiserId,
                'campaign_name' => $request->input('campaign_name'),
                'objective_type' => 'TRAFFIC',  // Example objective: TRAFFIC, CONVERSIONS, APP_INSTALLS
                'budget_mode' => 'BUDGET_MODE_INFINITE', // or BUDGET_MODE_DAY
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 0) {
            return back()->with('success', 'Campaign Created Successfully!');
        } else {
            return back()->with('error', 'Failed to Create Campaign: ' . $data['message']);
        }
    }

    public function createAd(Request $request)
    {
        $accessToken = session('tiktok_access_token');
        $advertiserId = $this->getAdvertiserId();
        if($advertiserId === null){
            dd('error');
        }
        $adGroupId = 'your_ad_group_id';  // You need to create an Ad Group first

        $response = $this->client->post('https://business-api.tiktok.com/open_api/v1.2/ad/create/', [
            'headers' => [
                'Access-Token' => $accessToken,
            ],
            'json' => [
                'advertiser_id' => $advertiserId,
                'adgroup_id' => $adGroupId,
                'ad_name' => $request->input('ad_name'),
                'creative_material_mode' => 'UNION',
                'ad_format' => 'SINGLE_VIDEO',
                'creatives' => [
                    [
                        'ad_name' => $request->input('ad_name'),
                        'video_id' => 'your_uploaded_video_id',  // Upload videos via API first
                        'title' => $request->input('ad_title'),
                    ],
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 0) {
            return back()->with('success', 'Ad Created Successfully!');
        } else {
            return back()->with('error', 'Failed to Create Ad: ' . $data['message']);
        }
    }

    public function getAdvertiserId()
    {
        $accessToken = session('tiktok_access_token');

        $response = $this->client->get('https://business-api.tiktok.com/open_api/v1.2/oauth2/advertiser/get/', [
            'headers' => [
                'Access-Token' => $accessToken,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 0) {
            // List of advertiser accounts linked to your app
            $advertiserAccounts = $data['data']['list'];

            // Example: Return the first advertiser ID
            return $advertiserAccounts[0]['advertiser_id'];
        } else {
             dd('Error fetching advertiser ID: ' . $data['message']);
             return null;
        }
    }


}
