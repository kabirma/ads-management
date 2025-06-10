<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Company;
use Auth;

class AIController extends Controller
{
    private $openAiToken;

    public function __construct() {
        $this->openAiToken =  config('services.openai.key');
    }

    function fetchContent($request) {
        $data = [
            'isFirstCampaign' => $request->first_campaign == "1",
            'usedBudget' => $request->used_budget,
            'duration' => $request->duration,
            'campaignGoal' => $request->campaignGoal,
            'socialMedia' => $request->social_media,
            'budgetRange' => $request->budgetRange,
            'ageRange' => $request->age_range,
            'gender' => $request->gender,
            'target' => $request->target,
            'keywords' => $request->keywords,
            'usedSocialMedia' => implode(",", $request->used_social_media ?? ''),
            'bestSocialMedia' => implode(",", $request->best_social_media ?? ''),
            'worstSocialMedia' => implode(",", $request->worst_social_media ?? ''),
        ];

        $strategyPrompt = $this->fetchStrategyPrompt($data);
        $descriptionPrompt = $this->fetchDescriptionPrompt($data);
        $valuesPrompt = $this->fetchValuePrompt($strategyPrompt);

        $strategy = $this->runScript($strategyPrompt);
        $description = $this->runScript($descriptionPrompt);
        $values = $this->runScript($valuesPrompt);

        return ['strategy'=>$strategy, 'description'=>$description, 'values'=>$values];
    }

    function fetchContentOld($request){

       
        $pattern = 'TITLE$==$DESCRIPTION$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA';
        $rules = 'snapchat ads budget should be min 5$ for one day, and tiktok min is 10$ for one day.';
        $social_media_among = 'tiktok and snapchat';

        $campaignGoal = $request->campaignGoal;
        $social_media = $request->social_media;
        $budgetRange = $request->budgetRange;
        $target = $request->target;
        $keywords = $request->keywords;
        $isFirstCampaign = $request->first_campaign;
        $notFirstCampaign = '';
        if($isFirstCampaign !== "1"){
            $used_social_media = implode(", ", $request->used_social_media ?? '');
            $best_social_media = implode(", ", $request->best_social_media ?? '');
            $worst_social_media = implode(", ", $request->worst_social_media ?? '');
            $used_budget = $request->used_budget;
            $duration = $request->duration;
            $comments = $request->comments;

            $notFirstCampaign = ', Moreover I have already ran a campaign using the following social media platforms: '. $used_social_media .'. Among them, the best performing platforms were: '. $best_social_media .' and the worst performing were: '. $worst_social_media .'. I spent a budget of '. $used_budget .' SAR and ran the campaign for '. $duration .'. Here are some comments about the campaign performance: ' . $comments .' based on this can you help me with the new one';
        }
        
        $data = [
            'campaignGoal' => $campaignGoal,
            'social_media' => $social_media,
            'budgetRange' => $budgetRange,
            'target' => $target,
            'keywords' => $keywords,
            'isFirstCampaign' => $isFirstCampaign,
        ];
        $prompt = 'I want to create an Ad for '. $social_media .', the purpose of my campaign is '. $campaignGoal .', my budget range is '. $budgetRange .' and I want to target '. $target .' and some keywords related to my business are '. $keywords .', based on this give me a title, description (atleast 50 words), recommended budget in Saudi Riyal (SAR), how many days should I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12), 18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18, 0 (being every other age from 31)), and also tell me which social media (among '.$social_media_among.' ) should I publish my ad ' . $notFirstCampaign . ' . Give me the response in exactly like the following pattern '.$pattern .' please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules '.$rules;

        $url = "https://api.openai.com/v1/chat/completions";

        $payload = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt. ' only give me single response'
                ]
            ]
        ];

        $response = Http::withToken($this->openAiToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);
        $response = $response->json();
        if(array_key_exists('choices',$response)){
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }

    function fetchValuePrompt($strategyPrompt) {
        $prompt = '
               based on this strategy 
               
               `'.$strategyPrompt.'`

               
               Give me a title, recommended budget in Saudi Riyal (SAR), how many days should
               I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12),
               18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18, 0 (being every other age from 31)),
               and also tell me which social media (among TIKTOK, SNAPCHAT ) should I publish my ad.
               Give me the response in exactly like the following pattern TITLE$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA
               please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules';
        return $prompt;
    }

    function fetchDescriptionPrompt($data){

        $campaignGoal = $data['campaignGoal'];
        $keywords = $data['keywords'];
        $ageRange = $data['ageRange'];
        $gender = $data['gender'];
        $target = $data['target'];
        $isFirstCampaign = $data['isFirstCampaign'];

        $firstCampaignText = $isFirstCampaign ? 'their first campaign (be welcoming and inspiring)' : 'not their first campaign (so show maturity in brand voice)';
        $prompt = "
                You are a creative ad copywriter. Your job is to write a human-touching, emotionally engaging, and specific ad description.

                Generate a 5–8 line ad focused on the *end-user*, using the tone of a warm and persuasive marketer.

                Use the input:
                - Campaign Goal: $campaignGoal
                - Business Keywords: $keywords
                - Age Group: $ageRange
                - Gender: $gender
                - Target Audience: $target
                - This is $firstCampaignText

                Only return the ad description. No titles, no bullets.";
        return $prompt;
    }

    function fetchStrategyPrompt($data){
        
        $campaignGoal = $data['campaignGoal'];
        $keywords = $data['keywords'];
        $ageRange = $data['ageRange'];
        $duration = $data['duration'];
        $gender = $data['gender'];
        $target = $data['target'];
        $isFirstCampaign = $data['isFirstCampaign'];
        $budgetRange = $data['budgetRange'];
        $socialMedia = $data['socialMedia'];
        $usedBudget = $data['usedBudget'];
        $bestSocialMedia = $data['bestSocialMedia'];
        $worstSocialMedia = $data['worstSocialMedia'];
        $usedSocialMedia = $data['usedSocialMedia'];

        if($isFirstCampaign){
            $prompt = "
                You are a professional digital marketing consultant.

                This is the user's **first-ever** campaign. Based on best practices, recommend:
                1. Starting Budget in SAR: Suggest a safe and effective budget range considering the goal is $campaignGoal.
                2. Platform: Choose the most effective platform for reaching $target aged $ageRange.
                3. Confidence Message: Reassure the user that this is a great starting point, and explain why your plan will help build brand awareness and early traction.

                Inputs:
                - Campaign Goal: $campaignGoal
                - Proposed Budget: $budgetRange
                - Target Audience: $target
                - Age Group: $ageRange
                - Gender: $gender
                - Platform Suggestion: $socialMedia";
        } else {
            $prompt = "
                You are a professional digital marketing consultant.

                Using the campaign insights below, provide:
                1. Recommended Budget in SAR: Improve on previous budget ($usedBudget) with reasoning.
                2. Recommended Platform: Use best performing ($bestSocialMedia) and avoid worst ($worstSocialMedia).
                3. Confidence Message: Reassure the user that this plan is better than their past campaign due to smarter budgeting/platform alignment.


                Campaign Data:
                - Not First Campaign: Yes
                - Previous Platform: $usedSocialMedia
                - Campaign Goal: $campaignGoal
                - Proposed Budget: $budgetRange
                - Duration: $duration";
        }

        return $prompt;
    }

    function runScript($prompt) {
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
        if(array_key_exists('choices',$response)){
            return $response['choices'][0]['message']['content'];
        }
    }


    function modifyErrorContent($error){
        return $error;
        if(is_array($error)){
            $error = implode(", ", $error);
        }
        $prompt = "Modify the error in more human readable form this is the errror '".$error."'"; 

        $url = "https://api.openai.com/v1/chat/completions";

        $payload = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $prompt. ' give me a short one line response and remove unnecessary words'
                ]
            ]
        ];
        $response = Http::withToken($this->openAiToken)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ])
            ->post($url, $payload);
        $response = $response->json();
        if(array_key_exists('choices',$response)){
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }


    function getContentWithPrompt($prompt){

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
        if(array_key_exists('choices',$response)){
            return $response['choices'][0]['message']['content'];
        }

        return '';
    }
}