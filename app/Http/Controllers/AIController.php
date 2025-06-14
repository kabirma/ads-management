<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\AiCampaign;
use Illuminate\Http\Request;
use App\Models\AiCampaignHistory;
use Illuminate\Support\Facades\Http;

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
        // if ($isFirst) {
        //     $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
        //         "This is the user's **first-ever** campaign. Based on best practices, recommend:\n" .
        //         "1. Starting Budget in SAR: Suggest a safe and effective budget range considering the goal is \"{$campaignGoal}\".\n" .
        //         "2. Platform: Choose the most effective platform for reaching {$targetChoices} aged {$age}.\n" .
        //         "3. Confidence Message: Reassure the user that this is a great starting point, and explain why your plan will help build brand awareness and early traction.\n\n" .
        //         "Inputs:\n" .
        //         "- Campaign Goal: {$campaignGoal}\n" .
        //         "- Proposed Budget: {$budgetRange}\n" .
        //         "- Target Audience: {$targetChoices}\n" .
        //         "- Age Group: {$age}\n" .
        //         "- Gender: {$gender}\n" .
        //         "- Platform Suggestion: {$platform}";
        // } else {
        //     $strategyPrompt = "You are a professional digital marketing consultant.\n\n" .
        //         "Using the campaign insights below, provide:\n" .
        //         "1. Recommended Budget in SAR: Improve on previous budget (" . ($data['previous_budget'] ?? 'ALL') . ") with reasoning.\n" .
        //         "2. Recommended Platform: Use best performing (" . ($data['best_platform'] ?? 'N/A') . ") and avoid worst (" . ($data['worst_platform'] ?? 'N/A') . ").\n" .
        //         "3. Confidence Message: Reassure the user that this plan is better than their past campaign due to smarter budgeting/platform alignment.\n\n" .
        //         "Campaign Data:\n" .
        //         "- Not First Campaign: Yes\n" .
        //         "- Previous Platform: " . ($data['previous_platform'] ?? 'N/A') . "\n" .
        //         "- Campaign Goal: {$campaignGoal}\n" .
        //         "- Proposed Budget: {$budgetRange}\n" .
        //         "- Duration: " . ($data['campaign_duration'] ?? 'ALL');


        // }

        if ($isFirst) {
            $strategyPrompt = "You are a professional digital marketing expert. Help a new user set up their **first-ever** ad campaign.\n\n" .
                "Use best practices for new advertisers to recommend:\n" .
                "1. Budget (SAR): What's a safe but effective starting budget for the goal: \"{$campaignGoal}\"?\n" .
                "2. Platform: Choose TIKTOK or SNAPCHAT based on the target audience: {$targetChoices}, age: {$age}, gender: {$gender}.\n" .
                "3. Duration: Recommend 1 or 2 days of runtime.\n" .
                "4. Confidence Message: Give a positive, reassuring message about why this plan will work well.\n\n" .
                "User Inputs:\n" .
                "- Campaign Goal: {$campaignGoal}\n" .
                "- Proposed Budget: {$budgetRange}\n" .
                "- Target: {$targetChoices}\n" .
                "- Age: {$age}\n" .
                "- Gender: {$gender}\n" .
                "- Platform: {$platform}";
        } else {
            $strategyPrompt = "You are a professional digital marketing expert. Help improve an existing advertiser’s campaign.\n\n" .
                "Using the past data and best practices, provide:\n" .
                "1. Improved Budget in SAR (past budget: " . ($data['previous_budget'] ?? 'ALL') . ").\n" .
                "2. Platform Recommendation: Build on best platform (" . ($data['best_platform'] ?? 'N/A') . ") and avoid worst (" . ($data['worst_platform'] ?? 'N/A') . ").\n" .
                "3. Duration: Recommend 1 or 2 days of runtime.\n" .
                "4. Confidence Message: Explain why this setup improves past performance.\n\n" .
                "Campaign Details:\n" .
                "- Previous Platform: " . ($data['previous_platform'] ?? 'N/A') . "\n" .
                "- Goal: {$campaignGoal}\n" .
                "- Proposed Budget: {$budgetRange}\n" .
                "- Target: {$targetChoices}\n" .
                "- Age: {$age}\n" .
                "- Gender: {$gender}\n" .
                "- Duration: " . ($data['campaign_duration'] ?? 'ALL');
        }


        // Escape for embedding
        $strategyPromptEscaped = addslashes($strategyPrompt);

        // VALUES PROMPT
        $valuesPrompt = "Based on the campaign strategy below, generate a compact campaign summary.\n\n" .
            "\"{$strategyPromptEscaped}\"\n\n" .
            "Return the result using this exact format (one single line):\n\n" .
            "TITLE\$==\$BUDGET\$==\$DAYS\$==\$GENDER\$==\$AGE\$==\$SOCIAL_MEDIA\n\n" .
            "Rules:\n" .
            "- TITLE: A 3–5 word headline (max 32 characters) that fits the goal (e.g., 'Boost Brand Buzz').\n" .
            "- BUDGET: Suggested ad spend in SAR (numeric or 'ALL').\n" .
            "- DAYS: 1 or 2.\n" .
            "- GENDER: MALE, FEMALE, BOTH, or ALL.\n" .
            "- AGE: 12, 18, 30, 0, or ALL (as defined).\n" .
            "- SOCIAL_MEDIA: TIKTOK or SNAPCHAT only.\n\n" .
            "Output ONLY one line, using \$==\$ as separator. No extra text.";

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

    public function save(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'campaign_goal' => 'nullable|string',
            'business_keywords' => 'nullable|string',
            'age' => 'nullable|string',
            'gender' => 'nullable|string',
            'target' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'platform' => 'nullable|string',
            'is_first_campaign' => 'nullable|string', // '1' or '0'
            'previous_platform' => 'nullable|string',
            'best_platform' => 'nullable|string',
            'worst_platform' => 'nullable|string',
            'previous_budget' => 'nullable|string',
            'ai_description' => 'nullable|string',
            'ai_title' => 'nullable|string',
            'ai_platform' => 'nullable|string',
            'ai_strategy' => 'nullable|string',
            'ai_values' => 'nullable|string',
        ]);

        $startDate = Carbon::parse($request->campaign_start);
        $endDate = Carbon::parse($request->campaign_end);

        $duration = $startDate->diffInDays($endDate);
        // Helper function to clean AI-generated strings
        $clean = fn($value, $removeTrailingComma = false) => $removeTrailingComma
            ? rtrim(trim(str_replace(['**', '"'], '', $value)), ',')
            : trim(str_replace(['**', '"'], '', $value));

        $campaign = new AiCampaign();
        $campaign->user_id = auth()->id() ?? $data['user_id'];
        $campaign->campaign_goal = $data['campaign_goal'];
        $campaign->business_keywords = $data['business_keywords'] ?? '';
        $campaign->age = $data['age'] ?? "all ages";
        $campaign->gender = $data['gender'];
        $campaign->target_choices = $data['target'] ?? 'all';
        $campaign->budget_range = $data['budget_range'];
        $campaign->platform = $data['platform'];
        $campaign->is_first_campaign = $data['is_first_campaign'] ?? false;
        $campaign->previous_platform = $data['previous_platform'] ?? "all";
        $campaign->best_platform = $data['best_platform'];
        $campaign->worst_platform = $data['worst_platform'];
        $campaign->previous_budget = $data['previous_budget'] ?? '0.00';
        $campaign->campaign_duration = $duration;

        // Clean AI-generated strings
        $campaign->ai_strategy = $clean($data['ai_strategy'] ?? '');
        $campaign->ai_title = $clean($data['ai_title'] ?? '');
        $campaign->ai_description = $clean($data['ai_description'] ?? '');
        $campaign->ai_platform = $clean($data['ai_platform'] ?? 'Not set');
        $campaign->ai_values = $clean($data['ai_values'] ?? '', true);

        $campaign->save();

        return response()->json(['status' => 'success', 'campaign_id' => $campaign->id]);
    }

    public function generate(Request $request)
    {
        $isFirst = $request->input('first_campaign') == 1;

        if ($isFirst) {
            $prompt = "Create an ad for the following campaign:\n\n" .
                "Business: {$request->business}\n" .
                "Goal: {$request->campaignGoal}\n" .
                "Platform: {$request->social_media}\n" .
                "Budget Range: {$request->budgetRange}\n" .
                "Target Audience: {$request->worst_platform}\n" .
                "Keywords: {$request->keywords}\n\n" .
                "Generate:\n- Title (max 10 words)\n- Description (max 200 characters)\n- Strategy\n";
        } else {
            $prompt = "Improve a campaign based on past data:\n\n" .
                "Used Platforms: {$request->used_platforms}\n" .
                "Best Platform: {$request->best_platform}\n" .
                "Worst Platform: {$request->worst_platform}\n" .
                "Budget: {$request->previous_budget}\n" .
                "Dates: {$request->campaign_start} to {$request->campaign_end}\n" .
                "Issue: {$request->comments}\n\n" .
                "Generate:\n- Title (max 10 words)\n- Description (max 200 characters)\n- Strategy\n";
        }

        // Call OpenAI (you need to configure your API key)


        $headers = [
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ];

        $url = 'https://api.openai.com/v1/chat/completions';
        $model = 'gpt-4o';

        $response = Http::withOptions(['verify' => false])
            ->withHeaders($headers)
            ->post($url, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an expert digital marketer.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
            ]);
        // $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
        //     'model' => 'gpt-4o',
        //     'messages' => [
        //         ['role' => 'system', 'content' => 'You are an expert digital marketer.'],
        //         ['role' => 'user', 'content' => $prompt],
        //     ],
        //     'temperature' => 0.7,
        // ]);

        $text = $response['choices'][0]['message']['content'];

        // Very basic parsing (you can improve this)
        preg_match('/Title:(.*?)\n/i', $text, $title);
        preg_match('/Description:(.*?)\n/i', $text, $desc);
        preg_match('/Strategy:(.*?)$/is', $text, $strategy);

        return response()->json([
            'title' => trim($title[1] ?? 'Untitled'),
            'description' => trim($desc[1] ?? 'No description'),
            'strategy' => trim($strategy[1] ?? 'No strategy'),
            'platform' => $request->social_media ?? $request->best_platform ?? 'Not set',
            'values' => $request->keywords ?? '',
        ]);
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

}
