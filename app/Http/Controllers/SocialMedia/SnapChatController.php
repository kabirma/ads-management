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
    private $adAccountId;
    private $setting;
    private $accessToken;

    public function __construct() {
        $this->redirectUrl =  config('services.snapchat.snapchat_redirect_uri');
        $this->apiUrl =  config('services.snapchat.snapchat_api_url');
        $this->clientSecret = config('services.snapchat.snapchat_client_secret');
        $this->clientId = config('services.snapchat.snapchat_client_id');
        $this->adAccountId = config('services.snapchat.snapchat_ad_acount_id');
        $this->setting = Company::find(1);
        $this->accessToken = $this->setting->snapchat_access_token;

        $this->refreshSnapChatAccessToke($this->clientSecret,$this->clientId,$this->setting);
    }

    public function authSnapChat(){
      
        $clientId = $this->clientId;
        $redirectUri = urlencode($this->redirectUrl);
        $responseType = 'code';
        $scope = 'snapchat-marketing-api snapchat-offline-conversions-api snapchat-profile-api snapchat-business-api snapchat-adaccounts-api';

        $authUrl = "https://accounts.snapchat.com/login/oauth2/authorize?client_id={$clientId}&redirect_uri={$redirectUri}&response_type={$responseType}&scope={$scope}";
        return redirect($authUrl);
    }

    public function redirectToSnapChat(Request $request){
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
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => $response->body()], $response->status());
        }
    }


    // ads Creation Start Here
    function campiagnCreation($request){
        $from = (new \DateTime($request->from))->format('Y-m-d\TH:i:s.u\Z');
        $to = (new \DateTime($request->to))->format('Y-m-d\TH:i:s.u\Z');
        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'objective_type' => $request->goal,
            'platform'=>'snapchat',
        ];
        $campaignId = $this->campaignCreationDB($data);

        if($campaignId === 0){
            return redirect()->route('add.ads')->with("error", "Error Creating Campaign");
        }
        $campaignName = $this->setting->name.'-SC-'.$campaignId . date('His');

        $payload = [
            'campaigns' => [
                [
                    'name' => $campaignName,
                    'ad_account_id' => $this->adAccountId,
                    'status' => 'PAUSED',
                    'objective' => 'WEB_CONVERSION',
                    'start_time' => $from,
                    'end_time' => $to,
                ]
            ]
        ];

        $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->accessToken
            ])
            ->post($this->apiUrl."campaigns", $payload);
    
        $response = $response->json();
        if($response['request_status']=='SUCCESS'){
            $campaignResponse = $response['campaigns'][0]['campaign'];
            $data = [
                'budget'=>$request->budget,
                'budget_mode'=>'BUDGET_MODE_TOTAL',
                'campaign_id'=>$campaignResponse['id'],
                'name'=>$campaignName,
                'status'=>1,
                'id'=>$campaignId,
                'data'=> json_encode($campaignResponse),
            ];
            $campaignId = $this->campaignCreationDB($data);
            $this->createAdGroup($request,$campaignId);
            dd($response,$data);
            $this->uploadMedia($request);
            dd($request->all());
        }
    }

    function createAdGroup($request,$campaignId){
        if($campaignId === 0){
            return redirect()->route('add.ads')->with("error", "Error Creating Campaign");
        }
        $campaign = Campaign::find($campaignId);
        $from = (new \DateTime($request->from))->format('Y-m-d\TH:i:s.u\Z');
        $to = (new \DateTime($request->to))->format('Y-m-d\TH:i:s.u\Z');
        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'campaign_id'=>$campaignId,
            'platform'=>'snapchat',
            'from'=>$from,
            'to'=>$to,
        ];
        $adGroupId = $this->adGroupCreationDB($data);
        $adGroupName = $this->setting->name.'-SC-'.$adGroupId . date('His');

        $payload = [
            "adsquads" => [
                [
                    "name" => $adGroupName,
                    "status" => "ACTIVE",
                    "campaign_id" => $campaign->campaign_id,
                    'type'=> 'SCT_ID',
                    "targeting" => [
                        "regulated_content" => false,
                        "demographics" => [
                        ],
                        "geos" => [
                        ]
                    ],
                    "targeting_reach_status" => "VALID",
                    "placement_v2" => ["config" => "AUTOMATIC"],
                    "billing_event" => "IMPRESSION",
                    "bid_micro" => $request->budget,
                    "auto_bid" => false,
                    "target_bid" => false,
                    "bid_strategy" => "LOWEST_COST_WITH_MAX_BID",
                    "lifetime_budget_micro" => $request->budget,
                    "start_time" => $from,
                    "end_time" => $to,
                    "optimization_goal" => $request->goal,
                    "pacing_type" => "STANDARD",
                    "brand_safety_config" => [
                        "inventory_option" => "LIMITED_INVENTORY"
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->accessToken
        ])
        ->post($this->apiUrl."adsquads", $payload);
        dump($campaign->campaign_id);
        $response = $response->json();
        dd($response);
        if($response['request_status']=='SUCCESS'){
            
        }


    }

    function uploadMedia($request, $reference_id){

        if($request->media_type == 1){
            $mediaPath = $this->saveMedia('image',$request,'socialMedia/TikTok', $reference_id);
            $fileName = str_replace(" ","_",$request->title) .'-'. date('YMDHis') . '-'.$reference_id;

            $response = Http::withHeaders([
                'Access-Token' => $this->accessToken,
            ])->attach(
                'image_file', file_get_contents($mediaPath), $fileName
            )->post($this->apiUrl.'/open_api/v1.3/file/image/ad/upload/', [
                'advertiser_id' => $this->advertiserId,
                'file_name' => $fileName,
                'image_signature' => md5(file_get_contents($mediaPath)),
            ]);
        }else{

            $mediaPath = $this->saveMedia('video',$request,'socialMedia/TikTok', $reference_id);
            $fileName = str_replace(" ","_",$request->name) .'-'. date('YMDHis') . '-'.$reference_id;

            $response = Http::withHeaders([
                'Access-Token' => $this->accessToken,
            ])->attach(
                'video_file', file_get_contents($mediaPath), $fileName
            )->post($this->apiUrl.'/open_api/v1.3/file/video/ad/upload/', [
                'advertiser_id' => $this->advertiserId,
                'file_name' => $fileName,
                'upload_type' => 'UPLOAD_BY_FILE',
                'video_signature' => md5(file_get_contents($mediaPath)),
                'flaw_detect' => 'true',
                'auto_fix_enabled' => 'true',
                'auto_bind_enabled' => 'true',
            ]);
        }

        $data = $response->json();
        if($data['message']=="OK"){
            return $data['data'];
        }

        return [];
    }
}