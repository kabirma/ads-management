<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;
use App\Models\AiCampaign;
use App\Models\AiCampaignHistory;
class AIController extends Controller
{
    private $openAiToken;

    public function __construct()
    {
        $this->openAiToken = config('services.openai.key');
    }

    function fetchContent($request)
    {


        $pattern = 'TITLE$==$DESCRIPTION$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA';
        $rules = 'snapchat ads budget should be min 5$ for one day, and tiktok min is 10$ for one day.';
        $social_media_among = 'tiktok and snapchat';

        $campaignGoal = $request->campaignGoal;
        $social_media = $request->social_media;
        $budgetRange = $request->budgetRange;
        $target = $request->target;
        $keywords = $request->keywords;
        $notFirstCampaign = '';
        if ($request->first_campaign !== "1") {
            $used_social_media = implode(", ", $request->used_social_media ?? '');
            $best_social_media = implode(", ", $request->best_social_media ?? '');
            $worst_social_media = implode(", ", $request->worst_social_media ?? '');
            $used_budget = $request->used_budget;
            $duration = $request->duration;
            $comments = $request->comments;

            $notFirstCampaign = ', Moreover I have already ran a campaign using the following social media platforms: ' . $used_social_media . '. Among them, the best performing platforms were: ' . $best_social_media . ' and the worst performing were: ' . $worst_social_media . '. I spent a budget of ' . $used_budget . ' SAR and ran the campaign for ' . $duration . '. Here are some comments about the campaign performance: ' . $comments . ' based on this can you help me with the new one';
        }

        $prompt = 'I want to create an Ad for ' . $social_media . ', the purpose of my campaign is ' . $campaignGoal . ', my budget range is ' . $budgetRange . ' and I want to target ' . $target . ' and some keywords related to my business are ' . $keywords . ', based on this give me a title, description (atleast 50 words), recommended budget in Saudi Riyal (SAR), how many days should I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12), 18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18, 0 (being every other age from 31)), and also tell me which social media (among ' . $social_media_among . ' ) should I publish my ad ' . $notFirstCampaign . ' . Give me the response in exactly like the following pattern ' . $pattern . ' please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules ' . $rules;

        $url = "https://api.openai.com/v1/chat/completions";

        $payload = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt . ' only give me single response'
                ]
            ]
        ];

        $response = Http::withToken($this->openAiToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);
        $response = $response->json();
        if (array_key_exists('choices', $response)) {
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }


    function modifyErrorContent($error)
    {
        return $error;
        if (is_array($error)) {
            $error = implode(", ", $error);
        }
        $prompt = "Modify the error in more human readable form this is the errror '" . $error . "'";

        $url = "https://api.openai.com/v1/chat/completions";

        $payload = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt . ' give me a short one line response and remove unnecessary words'
                ]
            ]
        ];
        $response = Http::withToken($this->openAiToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);
        $response = $response->json();
        if (array_key_exists('choices', $response)) {
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }


    function getContentWithPrompt($prompt)
    {

        $url = "https://api.openai.com/v1/chat/completions";

        $payload = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt
                ]
            ]
        ];
        $response = Http::withToken($this->openAiToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);
        $response = $response->json();
        if (array_key_exists('choices', $response)) {
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'campaign_goal' => 'nullable|string',
            'business_keywords' => 'nullable|string',
            'age' => 'nullable|string',
            'gender' => 'nullable|string',
            'target_choices' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'platform' => 'nullable|string',
            'is_first_campaign' => 'nullable|string',
            'previous_platform' => 'nullable|string',
            'best_platform' => 'nullable|string',
            'worst_platform' => 'nullable|string',
            'previous_budget' => 'nullable|string',
            'campaign_duration' => 'nullable|string',
        ]);

        $data = $request->all();
        $userId = auth()->id();

        $openaiKey = env('OPENAI_API_KEY');
        if (!$openaiKey) {
            return response()->json(['error' => 'OpenAI API key not configured.'], 500);
        }

        $headers = [
            'Authorization' => "Bearer {$openaiKey}",
            'Content-Type' => 'application/json'
        ];

        $isFirst = strtolower($data['is_first_campaign'] ?? 'yes') === 'yes';

        // Fallback values if not provided
        $campaignGoal = $data['campaign_goal'] ?? 'Brand awareness';
        $budgetRange = $data['budget_range'] ?? 'ALL';
        $age = $data['age'] ?? 'ALL';
        $gender = $data['gender'] ?? 'ALL';
        $targetChoices = $data['target_choices'] ?? 'ALL';
        $platform = $data['platform'] ?? 'ALL';

        // STRATEGY PROMPT
        if ($isFirst) {
            $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
                "This is the user's **first-ever** campaign. Based on best practices, recommend:\n" .
                "1. Starting Budget in SAR: Suggest a safe and effective budget range considering the goal is \"{$campaignGoal}\".\n" .
                "2. Platform: Choose the most effective platform for reaching {$targetChoices} aged {$age}.\n" .
                "3. Confidence Message: Reassure the user that this is a great starting point, and explain why your plan will help build brand awareness and early traction.\n\n" .
                "Inputs:\n" .
                "- Campaign Goal: {$campaignGoal}\n" .
                "- Proposed Budget: {$budgetRange}\n" .
                "- Target Audience: {$targetChoices}\n" .
                "- Age Group: {$age}\n" .
                "- Gender: {$gender}\n" .
                "- Platform Suggestion: {$platform}";
        } else {
            $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
                "Using the campaign insights below, provide:\n" .
                "1. Recommended Budget in SAR: Improve on previous budget (" . ($data['previous_budget'] ?? 'ALL') . ") with reasoning.\n" .
                "2. Recommended Platform: Use best performing (" . ($data['best_platform'] ?? 'N/A') . ") and avoid worst (" . ($data['worst_platform'] ?? 'N/A') . ").\n" .
                "3. Confidence Message: Reassure the user that this plan is better than their past campaign due to smarter budgeting/platform alignment.\n\n" .
                "Campaign Data:\n" .
                "- Not First Campaign: Yes\n" .
                "- Previous Platform: " . ($data['previous_platform'] ?? 'N/A') . "\n" .
                "- Campaign Goal: {$campaignGoal}\n" .
                "- Proposed Budget: {$budgetRange}\n" .
                "- Duration: " . ($data['campaign_duration'] ?? 'ALL');


        }

        // Escape for embedding
        $strategyPromptEscaped = addslashes($strategyPrompt);

        // VALUES PROMPT
        $valuesPrompt = "Based on the following campaign strategy prompt:\n\n" .
            "\"{$strategyPromptEscaped}\"\n\n" .
            "Please provide a summary in the exact format:\n\n" .
            "TITLE\$==\$BUDGET\$==\$DAYS\$==\$GENDER\$==\$AGE\$==\$SOCIAL_MEDIA\n\n" .
            "Where:\n" .
            "- TITLE: 3–5 word campaign summary.\n" .
            "- BUDGET: Recommended ad budget in SAR or 'ALL'.\n" .
            "- DAYS: Run time (1 or 2 days).\n" .
            "- GENDER: MALE, FEMALE, BOTH, or ALL.\n" .
            "- AGE: 12 (under 12), 18 (12–17), 30 (18–30), 0 (31+), or ALL.\n" .
            "- SOCIAL_MEDIA: TIKTOK or SNAPCHAT only.\n\n" .
            "Respond in one single line. Use \$==\$ as separator. No extra explanation.";

        // (Optional) Description prompt (currently commented out)
        // $descriptionPrompt = "...";

        $url = 'https://api.openai.com/v1/chat/completions';
        $model = 'gpt-3.5-turbo';

        try {
            // STRATEGY REQUEST
            // $stratResp = Http::withHeaders($headers)->post($url, [
            //     'model' => $model,
            //     'messages' => [['role' => 'user', 'content' => $strategyPrompt]],
            // ]);

            // // VALUES REQUEST
            // $valResp = Http::withHeaders($headers)->post($url, [
            //     'model' => $model,
            //     'messages' => [['role' => 'user', 'content' => $valuesPrompt]],
            // ]);

            // $descResp = Http::withOptions(['verify' => false])->withHeaders($headers)->post($url, [
            //     'model' => $model,
            //     'messages' => [['role' => 'user', 'content' => $descriptionPrompt]],
            // ]);

            $stratResp = Http::withOptions(['verify' => false])->withHeaders($headers)->post($url, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $strategyPrompt]],
            ]);

            $valResp = Http::withOptions(['verify' => false])->withHeaders($headers)->post($url, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $valuesPrompt]],
            ]);


            // Extract content
            $strategy = $stratResp->successful() ? $stratResp->json()['choices'][0]['message']['content'] : null;
            $values = $valResp->successful() ? $valResp->json()['choices'][0]['message']['content'] : null;

            // Save
            $campaign = new AiCampaign();
            $campaign->user_id = $userId;
            $campaign->campaign_goal = $data['campaign_goal'] ?? 'null';
            $campaign->business_keywords = $data['business_keywords'] ?? null;
            $campaign->age = $data['age'] ?? null;
            $campaign->gender = $data['gender'] ?? null;
            $campaign->target_choices = $data['target_choices'] ?? null;
            $campaign->budget_range = $data['budget_range'] ?? null;
            $campaign->platform = $data['platform'] ?? null;
            $campaign->is_first_campaign = $isFirst;
            $campaign->previous_platform = $data['previous_platform'] ?? null;
            $campaign->best_platform = $data['best_platform'] ?? null;
            $campaign->worst_platform = $data['worst_platform'] ?? null;
            $campaign->previous_budget = $data['previous_budget'] ?? null;
            $campaign->campaign_duration = $data['campaign_duration'] ?? null;
            $campaign->ai_strategy = $strategy;
            $campaign->ai_values = $values;
            $campaign->save();

            return response()->json([
                'strategy' => $strategy,
                'values' => $values,
                'campaign_id' => $campaign->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing the request: ' . $e->getMessage()
            ], 500);
        }
    }


    public function fetch1(Request $request)
    {

        $request->validate([
            'first_campaign' => 'nullable|string', // '1' or '0'
            'campaignGoal' => 'nullable|string',
            'social_media' => 'nullable|string',
            'budgetRange' => 'nullable|string',
            'target' => 'nullable|string',
            'keywords' => 'nullable|string',
            'used_platforms' => 'nullable|string',
            'best_platform' => 'nullable|string',
            'worst_platform' => 'nullable|string',
            'used_budget' => 'nullable|string',
            'duration' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);


        $data = $request->all();

        // Debugging: Remove or comment out in production
        // dd($data);

        $userId = auth()->id(); // or use $request->user_id if public

        $openaiKey = env('OPENAI_API_KEY');
        if (!$openaiKey) {
            return response()->json(['error' => 'OpenAI API key not configured.'], 500);
        }

        $headers = [
            'Authorization' => "Bearer {$openaiKey}",
            'Content-Type' => 'application/json'
        ];

        // Use previous campaign data if needed
        $lastCampaign = AiCampaign::where('user_id', $userId)->latest()->first();
        $isFirst = strtolower($data['is_first_campaign'] ?? 'yes') === 'yes';

        // Prompt 1: Description
        $descriptionPrompt = "You are a creative ad copywriter. Your job is to write a human-touching, emotionally engaging, and specific ad description.\n\n" .
            "Generate a 5–8 line ad focused on the *end-user*, using the tone of a warm and persuasive marketer.\n\n" .
            "Use the input:\n" .
            "- Campaign Goal: {$data['campaign_goal']}\n" .
            "- Business Keywords: {$data['business_keywords']}\n" .
            "- Age Group: {$data['age']}\n" .
            "- Gender: {$data['gender']}\n" .
            "- Target Audience: {$data['target_choices']}\n" .
            "- This is " . ($isFirst ? 'their first campaign (be welcoming and inspiring)' : 'not their first campaign (so show maturity in brand voice)') . "\n" .
            "Only return the ad description. No titles, no bullets.";

        // Prompt 2: Strategy
        if ($isFirst) {
            $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
                "This is the user's **first-ever** campaign. Based on best practices, recommend:\n" .
                "1. Starting Budget in SAR: Suggest a safe and effective budget range considering the goal is \"{$data['campaign_goal']}\".\n" .
                "2. Platform: Choose the most effective platform for reaching {$data['target_choices']} aged {$data['age']}.\n" .
                "3. Confidence Message: Reassure the user that this is a great starting point, and explain why your plan will help build brand awareness and early traction.\n\n" .
                "Inputs:\n" .
                "- Campaign Goal: {$data['campaign_goal']}\n" .
                "- Proposed Budget: {$data['budget_range']}\n" .
                "- Target Audience: {$data['target_choices']}\n" .
                "- Age Group: {$data['age']}\n" .
                "- Gender: {$data['gender']}\n" .
                "- Platform Suggestion: {$data['platform']}";
        } else {
            $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
                "Using the campaign insights below, provide:\n" .
                "1. Recommended Budget in SAR: Improve on previous budget ({$data['previous_budget']}) with reasoning.\n" .
                "2. Recommended Platform: Use best performing ({$data['best_platform']}) and avoid worst ({$data['worst_platform']}).\n" .
                "3. Confidence Message: Reassure the user that this plan is better than their past campaign due to smarter budgeting/platform alignment.\n" .
                "Campaign Data:\n" .
                "- Not First Campaign: Yes\n" .
                "- Previous Platform: {$data['previous_platform']}\n" .
                "- Campaign Goal: {$data['campaign_goal']}\n" .
                "- Proposed Budget: {$data['budget_range']}\n" .
                "- Duration: {$data['campaign_duration']}";
        }

        // Prompt 3: Values (recommendation summary)
        $strategyPromptEscaped = addslashes($strategyPrompt); // Escape for embedding in valuesPrompt
        $valuesPrompt = "Based on strategy prompt '{$strategyPromptEscaped}' of campaign give me a title, recommended budget in Saudi Riyal (SAR), how many days should I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12), 18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18), 0 (being every other age from 31)), and also tell me which social media (among TIKTOK, SNAPCHAT) should I publish my ad.\n" .
            "Give me the response in exactly like the following pattern TITLE$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA\n" .
            "Please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules";

        // Prepare payloads
        $url = 'https://api.openai.com/v1/chat/completions';
        $model = 'gpt-3.5-turbo';

        try {
            $descResp = Http::withHeaders($headers)->post($url, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $descriptionPrompt]],
            ]);

            $stratResp = Http::withHeaders($headers)->post($url, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $strategyPrompt]],
            ]);

            $valResp = Http::withHeaders($headers)->post($url, [
                'model' => $model,
                'messages' => [['role' => 'user', 'content' => $valuesPrompt]],
            ]);

            // Check for successful responses
            $description = $descResp->successful() ? $descResp->json()['choices'][0]['message']['content'] : null;
            $strategy = $stratResp->successful() ? $stratResp->json()['choices'][0]['message']['content'] : null;
            $values = $valResp->successful() ? $valResp->json()['choices'][0]['message']['content'] : null;

            // Save to database
            $campaign = new AiCampaign();
            $campaign->user_id = $userId;
            $campaign->campaign_goal = $data['campaign_goal'];
            $campaign->business_keywords = $data['business_keywords'];
            $campaign->age = $data['age'];
            $campaign->gender = $data['gender'];
            $campaign->target_choices = $data['target_choices'];
            $campaign->budget_range = $data['budget_range'];
            $campaign->platform = $data['platform'];
            $campaign->is_first_campaign = $isFirst;
            $campaign->previous_platform = $data['previous_platform'] ?? null;
            $campaign->best_platform = $data['best_platform'] ?? null;
            $campaign->worst_platform = $data['worst_platform'] ?? null;
            $campaign->previous_budget = $data['previous_budget'] ?? null;
            $campaign->campaign_duration = $data['campaign_duration'] ?? null;
            $campaign->ai_description = $description;
            $campaign->ai_strategy = $strategy;
            $campaign->ai_values = $values;
            $campaign->save();

            return response()->json([
                'description' => $description,
                'strategy' => $strategy,
                'values' => $values,
                'campaign_id' => $campaign->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request: ' . $e->getMessage()], 500);
        }
    }

    //     public function fetch(Request $request)
//     {
//         $data = $request->all();

    //         dd($data);
//         $userId = auth()->id(); // or use $request->user_id if public

    //         $openaiKey = env('OPENAI_API_KEY');
//         if (!$openaiKey) {
//             return response()->json(['error' => 'OpenAI API key not configured.'], 500);
//         }

    //         $headers = [
//             'Authorization' => "Bearer {$openaiKey}",
//             'Content-Type'  => 'application/json'
//         ];

    //         //  Use previous campaign data if needed
//         $lastCampaign = AiCampaign::where('user_id', $userId)->latest()->first();
//         $isFirst = strtolower($data['is_first_campaign'] ?? 'yes') === 'yes';

    //         // Prompt 1: Description
// $descriptionPrompt = <<<EOT
//            You are a creative ad copywriter. Your job is to write a human-touching, emotionally engaging, and specific ad description.

    //            Generate a 5–8 line ad focused on the *end-user*, using the tone of a warm and persuasive marketer.

    //            Use the input:
//            - Campaign Goal: {$data['campaign_goal']}
//            - Business Keywords: {$data['business_keywords']}
//            - Age Group: {$data['age']}
//            - Gender: {$data['gender']}
//            - Target Audience: {$data['target_choices']}
//            - This is {$isFirst ? "their first campaign (be welcoming and inspiring)" : "not their first campaign (so show maturity in brand voice)"}
//            Only return the ad description. No titles, no bullets.
//            EOT;

    //         // Prompt 2: Strategy
//         if ($isFirst) {
//             $strategyPrompt = <<<EOT
//              You are a professional digital marketing consultant.

    //              This is the user's **first-ever** campaign. Based on best practices, recommend:
//              1. Starting Budget in SAR: Suggest a safe and effective budget range considering the goal is "{$data['campaign_goal']}".
//              2. Platform: Choose the most effective platform for reaching {$data['target_choices']} aged {$data['age']}.
//              3. Confidence Message: Reassure the user that this is a great starting point, and explain why your plan will help build brand awareness and early traction.

    //             Inputs:
//             - Campaign Goal: {$data['campaign_goal']}
//             - Proposed Budget: {$data['budget_range']}
//             - Target Audience: {$data['target_choices']}
//             - Age Group: {$data['age']}
//             - Gender: {$data['gender']}
//             - Platform Suggestion: {$data['platform']}
//             EOT;
//         } else {
//             $strategyPrompt = <<<EOT
//             You are a professional digital marketing consultant.

    //              Using the campaign insights below, provide:
//             1. Recommended Budget in SAR: Improve on previous budget ({$data['previous_budget']}) with reasoning.
//             2. Recommended Platform: Use best performing ({$data['best_platform']}) and avoid worst ({$data['worst_platform']}).
//             3. Confidence Message: Reassure the user that this plan is better than their past campaign due to smarter budgeting/platform alignment.
//             Campaign Data:
//             - Not First Campaign: Yes
//             - Previous Platform: {$data['previous_platform']}
//             - Campaign Goal: {$data['campaign_goal']}
//             - Proposed Budget: {$data['budget_range']}
//             - Duration: {$data['campaign_duration']}
//             EOT;
//         }

    //         // Prompt 3: Values (recommendation summary)
//         $valuesPrompt = <<<EOT
//                        based on strategy prompt `{$strategyPrompt}` of campaign give me a title, recommended budget in Saudi Riyal (SAR), how many days should
//                        I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12),
//                        18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18, 0 (being every other age from 31)),
//                        and also tell me which social media (among TIKTOK, SNAPCHAT ) should I publish my ad.
//                        Give me the response in exactly like the following pattern TITLE$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA
//                        please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules
//                        EOT;

    //         // Prepare payloads
//         $url = 'https://api.openai.com/v1/chat/completions';
//         $model = 'gpt-3.5-turbo';

    //         $descResp = Http::withHeaders($headers)->post($url, [
//             'model' => $model,
//             'messages' => [['role' => 'user', 'content' => $descriptionPrompt]],
//         ]);

    //         $stratResp = Http::withHeaders($headers)->post($url, [
//             'model' => $model,
//             'messages' => [['role' => 'user', 'content' => $strategyPrompt]],
//         ]);

    //         $valResp = Http::withHeaders($headers)->post($url, [
//             'model' => $model,
//             'messages' => [['role' => 'user', 'content' => $valuesPrompt]],
//         ]);

    //         $description = $descResp->ok() ? $descResp['choices'][0]['message']['content'] : null;
//         $strategy = $stratResp->ok() ? $stratResp['choices'][0]['message']['content'] : null;
//         $values = $valResp->ok() ? $valResp['choices'][0]['message']['content'] : null;

    //         // Save to database
//         $campaign = new AiCampaign();
//         $campaign->user_id = $userId;
//         $campaign->campaign_goal = $data['campaign_goal'];
//         $campaign->business_keywords = $data['business_keywords'];
//         $campaign->age = $data['age'];
//         $campaign->gender = $data['gender'];
//         $campaign->target_choices = $data['target_choices'];
//         $campaign->budget_range = $data['budget_range'];
//         $campaign->platform = $data['platform'];
//         $campaign->is_first_campaign = $isFirst;
//         $campaign->previous_platform = $data['previous_platform'] ?? null;
//         $campaign->best_platform = $data['best_platform'] ?? null;
//         $campaign->worst_platform = $data['worst_platform'] ?? null;
//         $campaign->previous_budget = $data['previous_budget'] ?? null;
//         $campaign->campaign_duration = $data['campaign_duration'] ?? null;
//         $campaign->ai_description = $description;
//         $campaign->ai_strategy = $strategy;
//         $campaign->ai_values = $values;
//         $campaign->save();

    //         return response()->json([
//             'description' => $description,
//             'strategy' => $strategy,
//             'values' => $values,
//             'campaign_id' => $campaign->id,
//         ]);
//     }

    // public function index()
    // {
    //     $company = Company::first();
    //     $campaigns = AiCampaign::where('status', 1)->get();
    //     $campaignHistory = AiCampaignHistory::where('status', 1)->get();
    //     $pageType = 'list';
    //     return view('front.ai.index', compact("company", "campaigns", "campaignHistory", "pageType"));
    // }

    // public function createCampaign()
    // {
    //     $company = Company::first();
    //     $campaigns = AiCampaign::where('status', 1)->get();
    //     $campaignHistory = AiCampaignHistory::where('status', 1)->get();
    //     $pageType = 'create';
    //     return view('front.ai.create', compact("company", "campaigns", "campaignHistory", "pageType"));
    // }

}
