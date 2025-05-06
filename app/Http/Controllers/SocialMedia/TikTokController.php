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

class TikTokController extends Controller
{
    private $apiUrl;
    private $accessToken;
    private $advertiserId;
    private $secret;
    private $callbackUrl;
    private $setting;

    public function __construct() {
        $isProduction = config('services.tiktok.tiktok_is_production');
        if($isProduction){
            $this->apiUrl =  config('services.tiktok.tiktok_prod_api_url');
            $this->accessToken = config('services.tiktok.tiktok_prod_token');
            $this->advertiserId = config('services.tiktok.tiktok_advertiser_id_prod');
        }else{
            $this->apiUrl =  config('services.tiktok.tiktok_api_url');
            $this->accessToken = config('services.tiktok.tiktok_token');
            $this->advertiserId = config('services.tiktok.tiktok_advertiser_id');
        }
        $this->secret = config('services.tiktok.tiktok_secret');
        $this->callbackUrl = config('services.tiktok.tiktok_callback_url');
        $this->setting = Company::find(1);
    }

    public function authTiktok(){
      
        $secret = $this->secret;
        $redirectUri = urlencode($this->redirectUrl);
        $responseType = 'code';

        $authUrl = "https://business-api.tiktok.com/portal/auth?app_id={$this->advertiserId}&state=your_custom_params&redirect_uri={$this->callbackUrl}";
        return redirect($authUrl);
    }

    public function handleTikTokCallback(Request $request){
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


    function campiagnCreation($request){
        $errors = $this->validateData($request);
        if(count($errors)){
            return $errors;
        }
        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'objective_type' => $request->goal,
            'platform'=>'tiktok',
        ];
        $campaignId = $this->campaignCreationDB($data);

        if($campaignId === 0){
            return ['error'=>'Error Creating Campaign'];
        }
        $campaignName = $this->setting->name.'-TK-'.$campaignId . date('His');
        $payload = [
            'advertiser_id' => $this->advertiserId,
            'objective_type' => $request->goal,
            'campaign_name' => $campaignName,
            'budget_mode' => 'BUDGET_MssODE_TOTAL',
            'budget' => $request->budget,
        ];
        $url = $this->apiUrl.'/open_api/v1.3/campaign/create/';
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
       
        $data = $response->json();
        if($data['message']=='OK'){
            $data = [
                'budget'=>$request->budget,
                'budget_mode'=>'BUDGET_MODE_TOTAL',
                'campaign_id'=>$data['data']['campaign_id'],
                'type'=>$data['data']['campaign_type'],
                'name'=>$campaignName,
                'status'=>1,
                'id'=>$campaignId,
                'data'=> json_encode($data['data']),
            ];
            $campaignId = $this->campaignCreationDB($data);
            $response = $this->createAdGroup($campaignId,$request);
            if(is_array($response) && array_key_exists('error',$response)) {
                return ['error' => $response];
            }
        }else{
            $log = [
                'reference_id' => $campaignId,
                'reference_table' => 'campaigns',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($data),
            ];
            $this->logResponse($log);
            return ['error'=>$this->modifyError($data['message'])];
        }
    }


    function createAdGroup($campaignId,$request){
        if($campaignId === 0){
            return ['error'=>"Error Creating Campaign"];
        }
        $campaign = Campaign::find($campaignId);
        $from = (new \DateTime($request->from))->format('Y-m-d H:i:s');
        $to = (new \DateTime($request->to))->format('Y-m-d H:i:s');
        $data = [
            'user_id'=>Auth::guard('web')->user()->id,
            'campaign_id'=>$campaignId,
            'platform'=>'tiktok',
            'from'=>$from,
            'to'=>$to,
        ];
        $adGroupId = $this->adGroupCreationDB($data);
        $adGroupName = $this->setting->name.'-TK-'.$adGroupId . date('His');

        $placements = [];
        
        if($request->goal === 'TRAFFIC'){
            $placements[] = 'PLACEMENT_PANGLE';
            $placements[] = 'PLACEMENT_TIKTOK';
            $optimizationGoal = 'CLICK';
            $promotion_type = 'WEBSITE';
            $billing_event = "CPC";
        }elseif($request->goal === 'LEAD_GENERATION'){
            $placements[] = 'PLACEMENT_PANGLE';
            $optimizationGoal = 'LEAD_GENERATION';
            $billing_event = "OCPM";
            $promotion_type = 'LEAD_GENERATION';
        }

        $payload = array(
            'advertiser_id' => $this->advertiserId,
            'campaign_id' => $campaign->campaign_id,
            'adgroup_name' => $adGroupName,
            'promotion_type' => $promotion_type,
            'placement_type' => 'PLACEMENT_TYPE_NORMAL',
            'placements' => $placements,
            'video_download_disabled' => false,
            'location_ids' => ['102358'],
            'gender' => 'GENDER_UNLIMITED',
            'operating_systems' => ['ANDROID'],
            'budget_mode' => 'BUDGET_MODE_TOTAL',
            'budget' => $campaign->budget,
            'schedule_type' => 'SCHEDULE_START_END',
            'schedule_start_time' => $from,
            'schedule_end_time' => $to,
            'optimization_goal' => $optimizationGoal,
            'bid_type' => 'BID_TYPE_NO_BID',
            'billing_event' => $billing_event,
            'pacing' => 'PACING_MODE_SMOOTH',
            'operation_status' => 'ENABLE',
        );

        if($billing_event === 'CPM'){
            $payload['frequency'] = 3;
            $payload['frequency_schedule'] = 3;
        }
        $url = $this->apiUrl.'/open_api/v1.3/adgroup/create/';
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
        $data = $response->json();

        if($data['message']==='OK'){
            $data = [
                'budget'=>$request->budget,
                'budget_mode'=>'BUDGET_MODE_TOTAL',
                'adgroup_id'=>$data['data']['adgroup_id'],
                'name'=>$adGroupName,
                'status'=>1,
                'id'=>$adGroupId,
                'data'=> json_encode($data['data']),
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
                'response' => json_encode($data),
            ];

            $this->logResponse($log);
            return ['error'=>$this->modifyError($data['message'])];
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
            'platform'=>'tiktok',
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


        $creatives = [
            'ad_name' => $request->title,
            'identity_type' => 'CUSTOMIZED_USER',
            'identity_id' => $this->setting->tiktok_identity,
            'ad_format' => $request->media_type == 1 ?  'SINGLE_IMAGE' : 'SINGLE_VIDEO',
            'ad_text' => 'asd',
            'call_to_action' => $request->call_to_action,
            'landing_page_url' => $request->website_url,
        ];

        if($request->media_type == 1){
            $creatives['image_ids'] = [$media['image_id']];
        }else{
            $creatives['video_id'] = $media['video_id'];
        }
        $payload = [
            'advertiser_id' => $this->advertiserId,
            'adgroup_id' => $adGroup->adgroup_id,
            'creatives' => [$creatives]
        ];
        $url = $this->apiUrl.'/open_api/v1.3/ad/create/';
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
        $data = $response->json();
        if($data['message']==='OK'){
            $data = [
                'image_id'=>$request->media_type == 1 ? $media['image_id'] : '',
                'video_id'=>$request->media_type == 2 ? $media['video_id'] : '',
                'image_url'=>$request->media_type == 1 ? $media['image_url'] : '',
                'video_url'=>$request->media_type == 2 ? $media['video_url'] : '',
                'status'=>1,
                'id'=>$adId,
                'data'=> json_encode($data['data']['creatives']),
                'ads_id'=>$data['data']['ad_ids'][0],
            ];
            $adId = $this->adCreationDB($data);
            return redirect()->route("view.ads")->with("success", "Ads Created Successfully");
        }else{
            $log = [
                'reference_id' => $adId,
                'reference_table' => 'ads',
                'request' => json_encode($payload),
                'url' => $url,
                'response' => json_encode($data),
            ];
            $this->logResponse($log);
            return ['error'=>$this->modifyError($data['message'])];
        }
    }

    function uploadMedia($request, $reference_id){

        $mediaPath = public_path($request->media);

        if($request->media_type == 1){
            $fileName = str_replace(" ","_",$request->title) .'-'. date('YMDHis') . '-'.$reference_id;
            $url = $this->apiUrl.'/open_api/v1.3/file/image/ad/upload/';
            $payload = [
                'advertiser_id' => $this->advertiserId,
                'file_name' => $fileName,
                'image_signature' => md5(file_get_contents($mediaPath)),
            ];
            $response = Http::withHeaders([
                'Access-Token' => $this->accessToken,
            ])->attach(
                'image_file', file_get_contents($mediaPath), $fileName
            )->post($url, $payload);
        }else{
            $url = $this->apiUrl.'/open_api/v1.3/file/video/ad/upload/';
            $fileName = str_replace(" ","_",$request->name) .'-'. date('YMDHis') . '-'.$reference_id;
            $payload =  [
                'advertiser_id' => $this->advertiserId,
                'file_name' => $fileName,
                'upload_type' => 'UPLOAD_BY_FILE',
                'video_signature' => md5(file_get_contents($mediaPath)),
                'flaw_detect' => 'true',
                'auto_fix_enabled' => 'true',
                'auto_bind_enabled' => 'true',
            ];
            $response = Http::withHeaders([
                'Access-Token' => $this->accessToken,
            ])->attach(
                'video_file', file_get_contents($mediaPath), $fileName
            )->post($url, $payload);
        }

        $data = $response->json();
        if($data['message']=="OK"){
            return $data['data'];
        }
        
        $log = [
            'reference_id' => $reference_id,
            'reference_table' => 'mediaUpload',
            'request' => json_encode($payload),
            'url' => $url,
            'response' => json_encode($data),
        ];
        $this->logResponse($log);
        return ['error'=>$this->modifyError($data['message'])];
    }

    function createIdentity(){
        $mediaPath = $this->setting->logo;
        $fileName = $this->setting->name . date('YmdHis');

        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
        ])->attach(
            'image_file', file_get_contents($mediaPath), $fileName
        )->post($this->apiUrl.'/open_api/v1.3/file/image/ad/upload/', [
            'advertiser_id' => $this->advertiserId,
            'file_name' => $fileName,
            'image_signature' => md5(file_get_contents($mediaPath)),
        ]);

        $mediaResponse = $response->json();
        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl.'/open_api/v1.3/identity/create/', [
            'advertiser_id' => $this->advertiserId,
            'image_uri' => $mediaResponse['data']['image_id'],
            'display_name' => $fileName,
        ]);

        $data = $response->json();
        dump($data);
        $this->setting->tiktok_identity = $data['data']['identity_id'];
        $this->setting->save();
        echo 'Success '.$data['data']['identity_id'];
    }

    function fetchAds($adId){
        $ad = Ads::with('adGroup','campaign')->find($adId);

        $tiktokAdId = $ad->ads_id;
        $tiktokCampaignId = $ad?->campaign?->campaign_id;
        $tiktokAdGroupId = $ad?->adGroup?->adgroup_id;

        $response = Http::withHeaders([
            'Access-Token' => $this->accessToken,
        ])->get('https://sandbox-ads.tiktok.com/open_api/v1.3/ad/get/', [
            'advertiser_id' => $this->advertiserId,
            'filtering' => json_encode(['ad_ids' => [$tiktokAdId]]),
        ]);

        $data = $response->json();
        if($data['message']!=='OK'){
            return [];
        }
        return [$ad, $data];
    }

}
