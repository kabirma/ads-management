<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Campaign;
use App\Models\Company;
// use App\Models\AdsImage;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\Media;
use App\Http\Controllers\SocialMedia\TikTokController;
use App\Http\Controllers\SocialMedia\SnapChatController;
use App\Http\Controllers\AIController;
use Auth;
use session;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class AdsController extends Controller
{
    protected $title;
    protected $model;
    protected $view_page;
    protected $store_page;
    protected $redirect_page;
    protected $model_primary;
    protected $child_model;

    protected const AI_SESSION_KEY = 'ai_session';

    public function __construct()
    {
        $this->title = "Ads";
        $this->model_primary = "id";
        $this->view_page = "pages.ads.view";
        $this->store_page = "pages.ads.store";
        $this->redirect_page = "view.ads";
        $this->redirect_store_page = "add.ads";
        $this->model = Ads::class;
        // $this->child_model = AdsImage::class;
    }

    public function index()
    {
        $data['title'] = $this->title;
        if(Auth::user()->role_id === 1){
            $data['listing'] = $this->model::orderBy('id','desc')->get();
        }else{
            $data['listing'] = $this->model::where('user_id',Auth::guard('web')->user()->id)->orderBy('id','desc')->get();
        }
        $data['addHide'] = 0;

        return view($this->view_page, $data);
    }

    public function userAds($id)
    {
        $user = User::find($id);
        $data['title'] = ($user->full_name ?? $user->name) . "'s ".$this->title;
        $data['listing'] = $this->model::where('user_id',$id)->orderBy('id','desc')->get();
        $data['addHide'] = 1;
        return view($this->view_page, $data);
    }

    public function add($ai = 0)
    {
        $userPackage = UserPackage::where('user_id',Auth::guard('web')->user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
        $data['medias'] = Media::where('user_id', Auth::user()->id)->get();
        if(!isset($userPackage)){
            return view('auth.package',['title'=>'Subscribe to Packages']);
        }
        $data['title'] = $this->title;
        $data['days'] = 0;
        if($ai == 1){
            $aiSuggestion = session(self::AI_SESSION_KEY);
            if($aiSuggestion !== null && $aiSuggestion !== ''){
                $data = $aiSuggestion;
            }
        }else{
            session([self::AI_SESSION_KEY=>'']);
        }

        $campaignId = Campaign::latest()->first()->id + 1;
        $setting = Company::first();
        $data['campaignName'] = $setting->name.'-TK-'.$campaignId . date('His');
        return view($this->store_page, $data);
    }

    public function addAI()
    {
        $userPackage = UserPackage::where('user_id',Auth::guard('web')->user()->id)->where('expire_at','>=', date("Y-m-d"))->first();
        if(!isset($userPackage)){
            return view('auth.package',['title'=>'Subscribe to Packages']);
        }

        $data['title'] = "Create Ads Using AI";
        return view("pages.ads.ai", $data);
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['record'] = $this->model::with('galleries')->where($this->model_primary, $id)->first();
        $tags = [];
        $company = Company::first();
        $tags = explode(',',$company->tags);
        $data['tags'] = $tags;
        $series = explode(',',$company->series);
        $data['series'] = $series;

        return view($this->store_page, $data);
    }

    private function validateImageResolution(Request $request){
        $url = $request->media;
        $social = $request->social_media;
       
        $image = Image::make(public_path($url));
        $width = $image->width();
        $height = $image->height();

        $valid = false;

        if ($social === 'snapchat') {
            $allowed = [
                ['width' => 1080, 'height' => 1920],
            ];
        }
        else if ($social === 'tiktok') {
            $allowed = [
                ['width' => 720, 'height' => 1280],
                ['width' => 1200, 'height' => 628],
                ['width' => 640, 'height' => 640],
                ['width' => 640, 'height' => 100],
                ['width' => 600, 'height' => 500],
                ['width' => 640, 'height' => 200],
            ];
        }

        $valid = collect($allowed)->contains(function ($size) use ($width, $height) {
            return $width >= $size['width'] && $height >= $size['height'];
        });

        if (!$valid) {
            return $allowed;
        }

        return [];
    }

    private function deductWallet($data) {
        $user = Auth::user();
        $user->wallet -= $data['walletDeduct'];
        $user->save();

        $this->createTransaction([
            'user_id' => $user->id,
            'amount' => $data['walletDeduct'],
            'ref_id' => Auth::user()->ads()->latest()->first()->id,
            'ref' => 'ads',
            'payment_id' => '',
        ]);

    }

    public function save(Request $request)
    {

        $dates = explode(" - ",$request->dates);
        $request->merge(
            [
                'from'=>$dates[0],
                'to'=>$dates[1]
            ]
        );
        
        $adRequest = new AdRequest();

        $validator = Validator::make(
            $request->all(),
            $adRequest->rules(),
            $adRequest->messages()
        );

        if ($validator->fails()) {
            $error['error']['error']['error']= collect($validator->errors()->all())->first();
            return json_encode([400, $error]);
        }

        $allowedRes = $this->validateImageResolution($request);
        if(count($allowedRes)){
            $sizes = array_map(fn($size) => "{$size['width']} x {$size['height']}", $allowedRes);
            $error['error']['error']['error']= 'Image Should be in following Width & Height '. implode(", ", $sizes);
            return json_encode([400, $error]);
        }

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        if ($to->diffInDays($from) < 1) {
            $error['error']['error']['error']= 'The end date must be at least one day after the start date.';
            return json_encode([400, $error]);
        }

        if($request->social_media == 'tiktok'){
            $tiktokController = new TikTokController();
            $response = $tiktokController->campiagnCreation($request);
            if($response !== null && array_key_exists('error',$response)){
                $error['error']['error']['error'] = $this->flattenError($response['error']); 
                return json_encode([400, $error]);
            }
        }else if($request->social_media == 'snapchat'){
            $snapchatController = new SnapChatController();
            $response = $snapchatController->campiagnCreation($request);
            if($response !== null && array_key_exists('error',$response)){
                return json_encode([400, $response['error']]);
            }
        }
        
        $this->deductWallet([
            'walletDeduct' => $request->walletDeduct
        ]);
        return json_encode([200, $this->title .' '.  __('messages.saved_successfully')]);
    }

    function flattenError($response) {
        while (is_array($response) && isset($response['error'])) {
            $response = $response['error'];
        }
        return $response;
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . ' '.  __('messages.deleted_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error",  __('messages.no_record_found'));
    }

    public function delete_image($id)
    {
        $data = $this->child_model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success",__('messages.image_deleted_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error", __('messages.no_record_found'));
    }

    public function status($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        $change_status=$data->status==1 ? 0 : 1;
        if (!is_null($data)) {
            $this->model::where('id',$id)->update(['status'=>$change_status]);
            return redirect()->route($this->redirect_page)->with("success", $this->title . ' '.  __('messages.status_updated_successfully'));
        }
        return redirect()->route($this->redirect_page)->with("error", __('messages.no_record_found'));
    }

    public function detail($id, $platform){
        $title = "Ads Detail";
        if($platform === 'tiktok'){
            $tiktok = new TikTokController();
            $response = $tiktok->fetchAds($id);
            if(count($response)){
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.tiktok',compact("title","apiResponse","ad"));
        }else if($platform === 'snapchat'){
            $snapchat = new SnapChatController();
            $response = $snapchat->fetchAds($id);
            if(count($response)){
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.snapchat',compact("title","apiResponse","ad"));
        }
    }

    public function generateAd(Request $request){
        if($request->keywords == null){
            return redirect()->back()->with("error", __('messages.keyword_required'));
        }
        $aiController = new AIController();
        tryAgain:
        $response = $aiController->fetchContent($request);
        
        if(!empty(array_filter($response))){
            $suggestion = explode("$==$",$response['values']);
            if(count($suggestion) !== 6){
                goto tryAgain;
                return redirect()->back()->with("error", __('messages.something_went_wrong'));
            }

            $name = $suggestion[0];
            $budget = (int)$suggestion[1];
            $days = (int)$suggestion[2];
            $gender = $suggestion[3];
            $age = $suggestion[4];
            $socialMedia = $suggestion[5];

            $startDate = new \DateTime('tomorrow');
            $endDate = new \DateTime('tomorrow');
            if(is_int($days)){
                $endDate = $endDate->modify("+$days Days");
            }

            $data['title'] = $this->title;
            $data['name'] = $name;
            $data['description'] = $response['description'];
            $data['budget'] = $budget;
            $data['days'] = $days;
            $data['gender'] = $gender;
            $data['age'] = $age;
            $data['social_media'] = $socialMedia;
            $data['ai_sugguested'] = 1;
            $data['medias'] = Media::where('user_id', Auth::user()->id)->get();
            $data['strategy'] = $response['strategy'];
            $data['used_request'] = [
                'first_campaign' => $request->first_campaign,
                'used_budget' => $request->used_budget,
                'duration' => $request->duration,
                'campaignGoal' => $request->campaignGoal,
                'social_media' => $request->social_media,
                'budgetRange' => $request->budgetRange,
                'age_range' => $request->age_range,
                'gender' => $request->gender,
                'target' => $request->target,
                'keywords' => $request->keywords,
                'used_social_media' => $request->used_social_media,
                'best_social_media' => $request->best_social_media,
                'worst_social_media' => $request->worst_social_media,
            ];

            session([self::AI_SESSION_KEY=>$data]);
            return redirect()->route('add.ads',['ai'=>1]);
        }

        return redirect()->back()->with("error", "Something went wrong. Please try again.");
    }

    public function getReachImpression(Request $request){
        $countryNames = [
            "SA" => "Saudi Arabia",
            "AE" => "United Arab Emirates",
            "QA" => "Qatar",
            "BH" => "Bahrain",
            "KW" => "Kuwait",
            "OM" => "Oman",
            "YE" => "Yemen",
            "IQ" => "Iraq",
            "SY" => "Syria",
            "LB" => "Lebanon",
            "JO" => "Jordan",
            "PS" => "Palestine",
            "EG" => "Egypt",
        ];
        $country = 'Saudi Arabia';
        if($request->location != ''){
            $country = $countryNames[$request->location];
        }

        $paramteres = $request->all();
        $exclude = ['_token', 'id', 'step'];
        $paramteres = collect($paramteres)
            ->except($exclude)
            ->map(function ($value, $key) {
                if (is_array($value)) {
                    $value = implode(', ', $value); 
                }
                return "$key: $value";
            })->implode(', ');

        $aiController = new AIController();
        $response = $aiController->getContentWithPrompt('Based on '.$country.' give me the reach in range like {reachStartRange}-{reachEndRange} if I run a campaign here with following parameters ('.$paramteres.') and also how much impression I can get in range {impressionStartRange}-{impressionEndRange}, just give response as exactly like two $ sepereted values like {reachStartRange}-{reachEndRange}${impressionStartRange}-{impressionEndRange}');
        if($response != ''){
            $data = explode("$", $response);
            return [$this->keepOnlyNumbersAndDashes($data[0]), $this->keepOnlyNumbersAndDashes($data[1])];
        }

        return ['4,000 – 2,700,000', '5,100 – 3,000,000'];
    }

    function keepOnlyNumbersAndDashes($string) {
        return preg_replace('/[^0-9\-]/', '', $string);
    }

    function reGenerateAd(Request $request) {
        $aiController = new AIController();
        tryAgain:
        $response = $aiController->fetchContent($request);
        
        if(!empty(array_filter($response))){
            $suggestion = explode("$==$",$response['values']);
            if(count($suggestion) !== 6){
                goto tryAgain;
            }

            $name = $suggestion[0];
            $budget = (int)$suggestion[1];
            $days = (int)$suggestion[2];
            $gender = $suggestion[3];
            $age = $suggestion[4];
            $socialMedia = $suggestion[5];

            $startDate = new \DateTime('tomorrow');
            $endDate = new \DateTime('tomorrow');
            if(is_int($days)){
                $endDate = $endDate->modify("+$days Days");
            }

            $data['title'] = $this->title;
            $data['name'] = $name;
            $data['description'] = $response['description'];
            $data['budget'] = $budget;
            $data['days'] = $days;
            $data['gender'] = $gender;
            $data['age'] = $age;
            $data['social_media'] = $socialMedia;
            $data['ai_sugguested'] = 1;
            $data['medias'] = Media::where('user_id', Auth::user()->id)->get();
            $data['strategy'] = $response['strategy'];
            $data['used_request'] = [
                'first_campaign' => $request->first_campaign,
                'used_budget' => $request->used_budget,
                'duration' => $request->duration,
                'campaignGoal' => $request->campaignGoal,
                'social_media' => $request->social_media,
                'budgetRange' => $request->budgetRange,
                'age_range' => $request->age_range,
                'gender' => $request->gender,
                'target' => $request->target,
                'keywords' => $request->keywords,
                'used_social_media' => $request->used_social_media,
                'best_social_media' => $request->best_social_media,
                'worst_social_media' => $request->worst_social_media,
            ];

            session([self::AI_SESSION_KEY=>$data]);
            return json_encode([200, $data]);
        }

        return json_encode([400,[]]);
    }
}
