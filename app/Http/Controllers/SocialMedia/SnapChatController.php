<?php
namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;
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
    private $profileId;
    private $setting;
    private $accessToken;

    public function __construct() {
        $this->redirectUrl =  config('services.snapchat.snapchat_redirect_uri');
        $this->apiUrl =  config('services.snapchat.snapchat_api_url');
        $this->clientSecret = config('services.snapchat.snapchat_client_secret');
        $this->clientId = config('services.snapchat.snapchat_client_id');
        $this->adAccountId = config('services.snapchat.snapchat_ad_acount_id');
        $this->profileId = config('services.snapchat.snapchat_profile_id');

        $this->setting = $this->refreshSnapChatAccessToke($this->clientSecret,$this->clientId);
        $this->accessToken = $this->setting->snapchat_access_token;
    }

    public function authSnapChat(){
      
        $clientId = $this->clientId;
        $redirectUri = urlencode($this->redirectUrl);
        $responseType = 'code';
        $scope = 'snapchat-marketing-api snapchat-offline-conversions-api';

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
        $errors = $this->validateData($request);
        if(count($errors)){
            return $errors;
        }
        $from = (new \DateTime($request->from))->format('Y-m-d\TH:i:s.u\Z');
        $to = (new \DateTime($request->to))->format('Y-m-d\TH:i:s.u\Z');
        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'objective_type' => $request->goal,
            'platform'=>'snapchat',
        ];
        $campaignId = $this->campaignCreationDB($data);

        if($campaignId === 0){
            return ['error'=>'Error Creating Campaign'];
        }
        $campaignName = $this->setting->name.'-SC-'.$campaignId . date('His');

        $payload = [
            'campaigns' => [
                [
                    'name' => $campaignName,
                    'ad_account_id' => $this->adAccountId,
                    'status' => 'ACTIVE',
                    'objective' => $request->goal,
                    'start_time' => $from,
                    'end_time' => $to,
                ]
            ]
        ];
        
        $url = $this->apiUrl."adaccounts/".$this->adAccountId."/campaigns";
        $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->accessToken
            ])
            ->post($url, $payload);
    
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
            $response = $this->createAdGroup($request,$campaignId);
            if(is_array($response) && array_key_exists('error',$response)) {
                return ['error' => $response];
            }
        }else{
            $log = [
                'reference_id' => $campaignId,
                'reference_table' => 'campaigns',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($response),
            ];
            $this->logResponse($log);
            return ['error'=>$this->modifyError($response['debug_message'])];
        }
    }

    function createAdGroup($request,$campaignId){
        if($campaignId === 0){
            return ['error'=>"Error Creating Campaign"];

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

        $demographics = [];
        
        $ageRange = [
            12 => 1,
            18 => 13,
            30 => 19,
            0 => 1,
        ];
        $max_age = $request->age_group;
        $gender = $request->gender;
        
        
        if($max_age !== 0){
            $minAge['min_age'] = (int)$ageRange[$max_age];
            $maxAge['max_age'] = (int)$max_age;
            
            if($gender != "Both"){
                $minAge['gender'] = strtoupper($gender);
                $maxAge['gender'] = strtoupper($gender);
            }

            $demographics = [
                $minAge,
                $maxAge,
            ];
        }
        $locations = $request->location;
        $country = ['country_code' => 'us'];
        // $country = array_map(function($location) {
        //     return ['country_code' => $location]; 
        // },$locations);
      
        
        $optimizationGoal = 'IMPRESSIONS';

        $payload = [
            "adsquads" => [
                [
                    "name" => $adGroupName,
                    "status" => "ACTIVE",
                    "campaign_id" => $campaign->campaign_id,
                    'type'=> 'SNAP_ADS',
                    "targeting" => [
                        "regulated_content" => false,
                        "demographics" => $demographics,
                        "geos" => [$country]
                    ],
                    "targeting_reach_status" => "VALID",
                    "placement_v2" => ["config" => "AUTOMATIC"],
                    "billing_event" => "IMPRESSION",
                    "bid_micro" => (int)$request->budget * 10000,
                    "auto_bid" => false,
                    "target_bid" => false,
                    "bid_strategy" => "LOWEST_COST_WITH_MAX_BID",
                    "lifetime_budget_micro" => (int)$request->budget * 1000000,
                    "start_time" => $from,
                    "end_time" => $to,
                    "optimization_goal" => $optimizationGoal,
                    "pacing_type" => "STANDARD",
                    "brand_safety_config" => [
                        "inventory_option" => "LIMITED_INVENTORY"
                    ]
                ]
            ]
        ];
        
        $url = $this->apiUrl."campaigns/".$campaign->campaign_id."/adsquads";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->accessToken
        ])
        ->post($url, $payload);
        
        $response = $response->json();
        if($response['request_status']=='SUCCESS'){
            $adsquadsResponse = $response['adsquads'][0]['adsquad'];

            $data = [
                'budget'=>$request->budget,
                'adgroup_id'=>$adsquadsResponse['id'],
                'name'=>$adGroupName,
                'status'=>1,
                'id'=>$adGroupId,
                'data'=> json_encode($adsquadsResponse),
            ];
            $adGroupId = $this->adGroupCreationDB($data);
            $response = $this->createAd($adGroupId,$request);
            if(is_array($response) && array_key_exists('error',$response)) {
                return ['error' => $response];
            }
        }else{
            $log = [
                'reference_id' => $adGroupId,
                'reference_table' => 'ad_groups',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($response),
            ];

            $this->logResponse($log);
            return ['error'=>$this->modifyError($response['debug_message'])];
        }
    }


    public function createAd($adGroupId,$request){
        if($adGroupId === 0){
            return ['error'=>"Error Creating Ads"];
        }

        $adGroup = AdGroup::find($adGroupId);

        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'campaign_id'=>$adGroup->campaign_id,
            'platform'=>'snapchat',
            'from'=>$adGroup->from,
            'to'=>$adGroup->to,
            'adgroup_id'=>$adGroupId,
            'name' => $request->title,
            'call_to_action' => $request->call_to_action,
            'landing_page_url' => $request->website_url,
            'description' => $request->description,
            'media_type' => $request->media_type,
        ];

        $adId = $this->adCreationDB($data);
        $media = $this->uploadMedia($request, $adId);
        if(array_key_exists('error',$media)) {
            return ['error' => $this->modifyError($media)];
        }
       
        $creative = $this->createCreative($media,$request);
       
        $payload = [
            "ads" => [
                [
                    "ad_squad_id" => $adGroup->adgroup_id,
                    "creative_id" => $creative['id'],
                    "name" => $request->title,
                    "type" => "SNAP_AD",
                    "status" => "PAUSED"
                ]
            ]
        ];
        $url = $this->apiUrl.'adsquads/'.$adGroup->adgroup_id.'/ads';

        $response = Http::withToken($this->accessToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);

        $response = $response->json();
        
        if($response['request_status']==='SUCCESS'){
            $adResponse = $response['ads'][0]['ad'];
            $data = [
                'image_id'=>$request->media_type == 1 ? $media['id'] : '',
                'video_id'=>$request->media_type == 2 ? $media['id'] : '',
                'image_url'=>$request->media_type == 1 ? $media['download_link'] : '',
                'video_url'=>$request->media_type == 2 ? $media['download_link'] : '',
                'status'=>1,
                'id'=>$adId,
                'data'=> json_encode($adResponse),
                'ads_id'=>$adResponse['id'],
            ];
            $adId = $this->adCreationDB($data);
            return redirect()->route("view.ads")->with("success", "Ads Created Successfully");
        }else{
            $log = [
                'reference_id' => $adId,
                'reference_table' => 'ads',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($response),
            ];
            $this->logResponse($log);
            return ['error'=>$this->modifyError($response['debug_message'])];
        }
    }

    function uploadMedia($request, $reference_id){

        $mediaType = $request->media_type == 1 ? "IMAGE" : "VIDEO";

        $mediaPath = $request->media;
        $fileName = str_replace(" ","_",$request->title) .'-'. date('YMDHis') . '-' . $reference_id;
        $payload = [
            "media" => [
                [
                    "name" => $request->title.'-'.$mediaType,
                    "type" => $mediaType,
                    "ad_account_id" => $this->adAccountId
                ]
            ]
        ];

        $url = $this->apiUrl."adaccounts/".$this->adAccountId."/media";
        $response = Http::withToken($this->accessToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);

        $response = $response->json();
        if($response['request_status'] === 'SUCCESS'){
            $mediaResponse = $response['media'][0]['media'];
            $url = $this->apiUrl."media/".$mediaResponse['id']."/upload";

            $file = public_path($request->media);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $response = Http::withToken($this->accessToken)
                ->attach('file', file_get_contents($file), $fileName.'.'.$extension)
                ->post($url);
            $response = $response->json();

            if($response['request_status']=="SUCCESS"){
                return $response['result'];
            }else{
                $log = [
                    'reference_id' => $reference_id,
                    'reference_table' => 'mediaUpload',
                    'request' => json_encode($payload),
                    'url' => $url,
                    'response' => json_encode($response),
                ];
                $this->logResponse($log);
                return ['error'=>$this->modifyError($response['debug_message'])];
            }
        }else{
            $log = [
                'reference_id' => $reference_id,
                'reference_table' => 'media',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($response),
            ];
            $this->logResponse($log);
            return ['error'=>$this->modifyError($response['debug_message'])];

        }
    }

    function createCreative($mediaResponse,$request){
        $url = $this->apiUrl."adaccounts/$this->adAccountId/creatives";
        $payload = [
            "creatives" => [
                [
                    "name" => $request->title.' CREATIVE',
                    "ad_account_id" => $this->adAccountId,
                    "type" => "SNAP_AD",
                    "shareable" => true,
                    "forced_view_eligibility" => "FULL_DURATION",
                    "headline" => $request->title,
                    "top_snap_media_id" => $mediaResponse['id'],
                    "web_view_properties" => [
                        "url" => $request->website_url,
                        "allow_snap_javascript_sdk" => false,
                        "use_immersive_mode" => false,
                        "deep_link_urls" => [],
                        "block_preload" => true,
                        "web_browser_type" => "SNAP"
                    ],
                    "profile_properties" => [
                        "profile_id" =>  $this->profileId 
                    ],
                ]
            ]
        ];
        
        $response = Http::withToken($this->accessToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);

        $response = $response->json();
        if($response['request_status'] === 'SUCCESS'){
            return $response['creatives'][0]['creative'];
        }else{
            $log = [
                'reference_id' => 0,
                'reference_table' => 'creatives',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($response),
            ];

            $this->logResponse($log);
        }
    }

    function fetchAds($adId){
        $ad = Ads::with('adGroup','campaign')->find($adId);
        $adId = $ad->ads_id;
        $start = date('Y-m-d', strtotime('-15 days')).'T00:00:00';
        $end = date('Y-m-d').'T00:00:00';
        $url = $this->apiUrl."ads/$adId/stats?granularity=DAY&start_time=$start&end_time=$end&limit=10";
        $response = Http::withToken($this->accessToken)->get($url);
        $response = $response->json();
        $statsResponse = [];
        if($response['request_status'] === 'SUCCESS'){
            $timeSeries = $response['timeseries_stats'][0]['timeseries_stat']['timeseries'];
            $impressions = [];
            $spends = [];
            $labels = [];
            foreach($timeSeries as $timeSerie){
                $labels[] = '"'.date("j F", strtotime($timeSerie['start_time'])).'"';
                $spends[] = $timeSerie['stats']['spend'];
                $impressions[] = $timeSerie['stats']['impressions'];
            } 

            $statsResponse['impressions'] = implode(", ", $impressions);
            $statsResponse['spends'] = implode(", ", $spends);
            $statsResponse['labels'] = implode(", ", $labels);
            $statsResponse['impression_total'] = array_sum($impressions);
            $statsResponse['spends_total'] = array_sum($spends);
        }
        return [$ad, $statsResponse];
    }
}