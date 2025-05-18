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

    function fetchContent($request){

       
        $pattern = 'TITLE$==$DESCRIPTION$==$BUDGET$==$DAYS$==$GENDER$==$AGE$==$SOCIAL_MEDIA';
        $rules = 'snapchat ads budget should be min 5$ for one day, and tiktok min is 10$ for one day.';
        $social_media_among = 'tiktok and snapchat';

        $campaignGoal = $request->campaignGoal;
        $social_media = $request->social_media;
        $budgetRange = $request->budgetRange;
        $target = $request->target;
        $keywords = $request->keywords;
        $notFirstCampaign = '';
        if($request->first_campaign !== "1"){
            $used_social_media = implode(", ", $request->used_social_media ?? '');
            $best_social_media = implode(", ", $request->best_social_media ?? '');
            $worst_social_media = implode(", ", $request->worst_social_media ?? '');
            $used_budget = $request->used_budget;
            $duration = $request->duration;
            $comments = $request->comments;

            $notFirstCampaign = ', Moreover I have already ran a campaign using the following social media platforms: '. $used_social_media .'. Among them, the best performing platforms were: '. $best_social_media .' and the worst performing were: '. $worst_social_media .'. I spent a budget of '. $used_budget .' SAR and ran the campaign for '. $duration .'. Here are some comments about the campaign performance: ' . $comments .' based on this can you help me with the new one';
        }

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