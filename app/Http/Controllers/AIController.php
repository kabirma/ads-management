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
        $pattern = '{TITLE}$==${DESCRIPTION}$==${BUDGET}$==${DAYS}$==${GENDER}$==${AGE}';
        $rules = 'snapchat ads budget should be min 5$ for one day, and tiktok min is 10$ for one day';
        $prompt = 'I want to create a '. $request->social_media . ' Ad, that is for the purpose of '. $request->reason .' and want to cover the '.$request->location.' based on this give me a title, description (atleast 50 words), recommended budget in Saudi Riyal (SAR), how many days should I run it (1 or 2), which gender should we target (MALE, FEMALE, BOTH), and which age should we target (12 (being less than 12), 18 (being less than 18 and greater than 12), 30 (being less than 30 and greater than 18, 0 (being every other age from 31)). Give me the response in exactly like the following pattern '.$pattern .' please strictly follow the pattern and add $==$ this between all as I will split response on this also keep in mind these rules '.$rules;
        

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
}