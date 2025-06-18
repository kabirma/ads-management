<?php

namespace App\Http\Controllers;

use session;
use Carbon\Carbon;
use App\Models\Ads;
use App\Models\Role;
// use App\Models\AdsImage;
use App\Models\User;
use App\Models\Media;
use App\Models\Company;
use App\Models\Campaign;
use App\Models\AiCampaign;
use App\Models\UserPackage;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SocialMedia\TikTokController;
use App\Http\Controllers\SocialMedia\SnapChatController;


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

    // public function index()
    // {
    //     $data['title'] = $this->title;
    //     if (Auth::user()->role_id === 1) {
    //         $data['listing'] = $this->model::orderBy('id', 'desc')->get();
    //     } else {
    //         $data['listing'] = $this->model::where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'desc')->get();
    //     }
    //     $data['addHide'] = 0;


    //     return view($this->view_page, $data);
    // }

    public function index(Request $request)
    {
        $data['title'] = $this->title;
        $query = $this->model::query();

        // Role-based filtering
        if (Auth::user()->role_id !== 1) {
            $query->where('user_id', Auth::guard('web')->user()->id);
        }

        // Search by name (or any other field)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('platform', 'LIKE', "%{$search}%")
                    ->orWhere('from', 'LIKE', "%{$search}%")
                    ->orWhere('to', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('data', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('call_to_action', 'LIKE', "%{$search}%");
            });
        }

        // Filter by platform
        if ($request->filled('platform') && $request->platform !== 'all') {
            $query->where('platform', $request->platform);
        }

        // Pagination
        $data['listing'] = $query->orderBy('id', 'desc')->paginate(9)->withQueryString(); // preserve filters

        $data['addHide'] = 0;

        return view($this->view_page, $data);
    }


    public function userAds($id)
    {
        $user = User::find($id);
        $data['title'] = ($user->full_name ?? $user->name) . "'s " . $this->title;
        $data['listing'] = $this->model::where('user_id', $id)->orderBy('id', 'desc')->get();
        $data['addHide'] = 1;
        return view($this->view_page, $data);
    }

    public function addOld($ai = 0)
    {

        // dd($ai);
        if ($ai != 0) {

            $aiData = AiCampaign::findOrFail($ai);
            if ($aiData) {
                $data['title'] = $aiData->ai_title;
                $data['name'] = $aiData->name;
                $data['description'] = $aiData->ai_description;
                $data['budget'] = $aiData->budget_range;
                $data['social_media'] = $aiData->ai_platform;
                $data['days'] = $aiData->campaign_duration;

            }

            // $data['title'] = "Create Ads Using AI";
            // $data['name'] = '';
            // $data['description'] = '';
            // $data['budget'] = 0;
            // $data['days'] = 0;
            // $data['campaignName'] = '';
            // $data['ai_sugguested'] = 1;
        } else {
            $data['title'] = "Create Ads";
            $data['name'] = '';
            $data['description'] = '';
            $data['budget'] = 0;
            $data['days'] = 0;
            $data['campaignName'] = '';
        }
        $userPackage = UserPackage::where('user_id', Auth::guard('web')->user()->id)->where('expire_at', '>=', date("Y-m-d"))->first();
        if (!isset($userPackage)) {
            return view('auth.package', ['title' => 'Subscribe to Packages']);
        }
        $data['title'] = $this->title;
        $data['days'] = 0;
        if ($ai == 1) {
            $aiSuggestion = session(self::AI_SESSION_KEY);
            if ($aiSuggestion !== null && $aiSuggestion !== '') {
                $data = $aiSuggestion;
            }
        } else {
            session([self::AI_SESSION_KEY => '']);
        }

        $campaignId = Campaign::latest()->first()->id + 1;
        $setting = Company::first();
        $data['campaignName'] = $setting->name . '-TK-' . $campaignId . date('His');
        return view($this->store_page, $data);
    }


    public function add($ai = 0)
    {
        $defaultData = [
            'title' => 'Create Ads',
            'name' => '',
            'description' => '',
            'budget' => 0,
            'days' => 0,
            'campaignName' => '',
            'social_media' => '',
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'ai_sugguested' => 0,
            'gender' => '',
            'age' => '',
        ];

        // AI campaign fallback
        if ($ai != 0) {
            $aiData = AiCampaign::findOrFail($ai);
            $defaultData['title'] = $aiData->ai_title ?? 'Create Ads Using AI';
            $defaultData['name'] = $aiData->ai_title ?? '';
            $defaultData['description'] = $aiData->ai_description ?? '';
            $defaultData['budget'] = $aiData->budget_range ?? 0;
            $defaultData['social_media'] = $aiData->ai_platform ?? '';
            $defaultData['days'] = $aiData->campaign_duration ?? 0;
            $defaultData['start_date'] = $aiData->start_date ?? Carbon::now()->format('Y-m-d');
            $defaultData['end_date'] = $aiData->end_date ?? Carbon::now()->addDays(7)->format('Y-m-d');
            $defaultData['gender'] = $aiData->gender ?? '';

        }

        // Check active package
        $userId = Auth::guard('web')->id();
        $userPackage = UserPackage::where('user_id', $userId)
            ->where('expire_at', '>=', now()->toDateString())
            ->first();

        if (!$userPackage) {
            return view('auth.package', ['title' => 'Subscribe to Packages']);
        }

        // AI session suggestion override
        if ($ai == 1) {
            $aiSuggestion = session(self::AI_SESSION_KEY);
            if (!empty($aiSuggestion)) {
                $defaultData = array_merge($defaultData, $aiSuggestion);
            }
        } else {
            session([self::AI_SESSION_KEY => '']);
        }

        // Generate campaign name
        $lastCampaignId = optional(Campaign::latest()->first())->id ?? 0;
        $nextCampaignId = $lastCampaignId + 1;

        $companyName = optional(Company::first())->name ?? 'Company';
        $defaultData['campaignName'] = "{$companyName}-TK-{$nextCampaignId}" . date('His');

        // Final title from controller property
        $defaultData['title'] = $this->title;
        $defaultData['media'] = Media::whereIn('media_type', ['image', 'video'])->get();
        $defaultData['media_type'] = 'image'; // or 'video' or get from DB/request


        $Languages = [
            'All',
            'arabic',
            'english',
            'french',
            'german',
            'spanish',
            'portuguese',
            'russian',
            'chinese',
            'japanese',
            'korean',
            'hindi',
            'urdu',
            'turkish',
            'italian',
            'dutch',
            'swedish',
            'norwegian',
            'finnish',
            'danish',
            'polish',
            'thai',
            'vietnamese',
            'indonesian',
            'malay',
            'bengali',
            'tamil',
            'telugu',
            'punjabi',
            'greek',
            'hebrew',
            'persian',
            'swahili',
            'romanian',
            'czech',
            'slovak',
            'ukrainian',
            'hungarian',
            'filipino',
            'burmese',
            'amharic',
            'hausa',
            'zulu',
        ];
        $defaultData['Languages'] = $Languages; // or 'video' or get from DB/request


        return view($this->store_page, $defaultData);
    }

    public function addAI()
    {
        $userPackage = UserPackage::where('user_id', Auth::guard('web')->user()->id)->where('expire_at', '>=', date("Y-m-d"))->first();
        if (!isset($userPackage)) {
            return view('auth.package', ['title' => 'Subscribe to Packages']);
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
        $tags = explode(',', $company->tags);
        $data['tags'] = $tags;
        $series = explode(',', $company->series);
        $data['series'] = $series;

        return view($this->store_page, $data);
    }

    private function validateImageResolution(Request $request)
    {
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
        } else if ($social === 'tiktok') {
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

    private function deductWallet($data)
    {
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

        $dates = explode(" - ", $request->dates);
        $request->merge(
            [
                'from' => $dates[0],
                'to' => $dates[1]
            ]
        );

        $adRequest = new AdRequest();

        $validator = Validator::make(
            $request->all(),
            $adRequest->rules(),
            $adRequest->messages()
        );

        if ($validator->fails()) {
            $error['error']['error']['error'] = collect($validator->errors()->all())->first();
            return json_encode([400, $error]);
        }

        $allowedRes = $this->validateImageResolution($request);
        if (count($allowedRes)) {
            $sizes = array_map(fn($size) => "{$size['width']} x {$size['height']}", $allowedRes);
            $error['error']['error']['error'] = 'Image Should be in following Width & Height ' . implode(", ", $sizes);
            return json_encode([400, $error]);
        }

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        if ($to->diffInDays($from) < 1) {
            $error['error']['error']['error'] = 'The end date must be at least one day after the start date.';
            return json_encode([400, $error]);
        }

        if ($request->social_media == 'tiktok') {
            $tiktokController = new TikTokController();
            $response = $tiktokController->campiagnCreation($request);
            if ($response !== null && array_key_exists('error', $response)) {
                $error['error']['error']['error'] = $this->flattenError($response['error']);
                return json_encode([400, $error]);
            }
        } else if ($request->social_media == 'snapchat') {
            $snapchatController = new SnapChatController();
            $response = $snapchatController->campiagnCreation($request);
            if ($response !== null && array_key_exists('error', $response)) {
                return json_encode([400, $response['error']]);
            }
        }

        $this->deductWallet([
            'walletDeduct' => $request->walletDeduct
        ]);
        return json_encode([200, $this->title . " Saved Successfully"]);
    }

    function flattenError($response)
    {
        while (is_array($response) && isset($response['error'])) {
            $response = $response['error'];
        }
        return ['error' => $response];
    }

    public function delete($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", $this->title . " Deleted Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function delete_image($id)
    {
        $data = $this->child_model::where($this->model_primary, $id)->first();
        if (!is_null($data)) {
            $data->delete();
            return redirect()->route($this->redirect_page)->with("success", "Image Deleted Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function status($id)
    {
        $data = $this->model::where($this->model_primary, $id)->first();
        $change_status = $data->status == 1 ? 0 : 1;
        if (!is_null($data)) {
            $this->model::where('id', $id)->update(['status' => $change_status]);
            return redirect()->route($this->redirect_page)->with("success", $this->title . " Status Updated Successfully");
        }
        return redirect()->route($this->redirect_page)->with("error", "No Record Found");
    }

    public function detail($id, $platform)
    {
        $title = "Ads Detail";
        if ($platform === 'tiktok') {
            $tiktok = new TikTokController();
            $response = $tiktok->fetchAds($id);
            if (count($response)) {
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.tiktok', compact("title", "apiResponse", "ad"));
        } else if ($platform === 'snapchat') {
            $snapchat = new SnapChatController();
            $response = $snapchat->fetchAds($id);
            if (count($response)) {
                [$ad, $apiResponse] = $response;
            }
            return view('pages.ads.detail.snapchat', compact("title", "apiResponse", "ad"));
        }
    }

    public function generateAdOld(Request $request)
    {
        if ($request->keywords == null) {
            return redirect()->back()->with("error", "Atleast 1 Keyword is Required.");
        }
        $aiController = new AIController();
        tryAgain:
        $response = $aiController->fetchContent($request);
        if ($response != '') {
            $suggestion = explode("$==$", $response);

            if (count($suggestion) !== 7) {
                goto tryAgain;
                return redirect()->back()->with("error", "Something went wrong. Please try again.");
            }

            $name = $suggestion[0];
            $description = $suggestion[1];
            $budget = (int) $suggestion[2];
            $days = (int) $suggestion[3];
            $gender = $suggestion[4];
            $age = $suggestion[5];
            $socialMedia = $suggestion[6];

            $startDate = new \DateTime('tomorrow');
            $endDate = new \DateTime('tomorrow');
            if (is_int($days)) {
                $endDate = $endDate->modify("+$days Days");
            }

            $data['title'] = $this->title;
            $data['name'] = $name;
            $data['description'] = $description;
            $data['budget'] = $budget;
            $data['days'] = $days;
            $data['gender'] = $gender;
            $data['age'] = $age;
            $data['social_media'] = $socialMedia;
            $data['ai_sugguested'] = 1;
            session([self::AI_SESSION_KEY => $data]);
            return redirect()->route('add.ads', ['ai' => 1]);
        }

        return redirect()->back()->with("error", "Something went wrong. Please try again.");
    }

    public function getReachImpression(Request $request)
    {
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
        if ($request->location != '') {
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
        $response = $aiController->getContentWithPrompt('Based on ' . $country . ' give me the reach in range like {reachStartRange}-{reachEndRange} if I run a campaign here with following parameters (' . $paramteres . ') and also how much impression I can get in range {impressionStartRange}-{impressionEndRange}, just give response as exactly like two $ sepereted values like {reachStartRange}-{reachEndRange}${impressionStartRange}-{impressionEndRange}');
        if ($response != '') {
            $data = explode("$", $response);
            return [$this->keepOnlyNumbersAndDashes($data[0]), $this->keepOnlyNumbersAndDashes($data[1])];
        }

        return ['4,000 – 2,700,000', '5,100 – 3,000,000'];
    }


    public function generateAd(Request $request)
    {
        if (empty($request->keywords)) {
            return redirect()->back()->with("error", "At least 1 keyword is required.");
        }

        $aiController = new AIController();
        $maxAttempts = 3;
        $attempt = 0;

        do {
            $response = $aiController->fetchContent($request);
            $attempt++;

            if (!empty($response)) {
                $suggestion = explode("$==$", $response);

                if (count($suggestion) === 7) {
                    $name = trim($suggestion[0]);
                    $description = trim($suggestion[1]);
                    $budget = (int) trim($suggestion[2]);
                    $days = (int) trim($suggestion[3]);
                    $gender = trim($suggestion[4]);
                    $age = trim($suggestion[5]);
                    $socialMedia = trim($suggestion[6]);

                    $startDate = new \DateTime('tomorrow');
                    $endDate = (clone $startDate)->modify("+{$days} days");

                    $data = [
                        'title' => $this->title,
                        'name' => $name,
                        'description' => $description,
                        'budget' => $budget,
                        'days' => $days,
                        'gender' => $gender,
                        'age' => $age,
                        'social_media' => $socialMedia,
                        'ai_sugguested' => 1,
                    ];

                    session([self::AI_SESSION_KEY => $data]);
                    return redirect()->route('add.ads', ['ai' => 1]);
                }
            }
        } while ($attempt < $maxAttempts);

        return redirect()->back()->with("error", "Something went wrong. Please try again later.");
    }


    function keepOnlyNumbersAndDashes($string)
    {
        return preg_replace('/[^0-9\-]/', '', $string);
    }
}
