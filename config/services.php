<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'openai' => [
        'key' => env('OPEN_AI_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],
    'tiktok' => [
        'tiktok_api_url' => env('TIKTOK_API_URL'),
        'tiktok_token' => env('TIKTOK_BUSINESS_TOKEN'),
        'tiktok_advertiser_id' => env('TIKTOK_ADVERTISER_ID'),
    ],
    'snapchat' => [
        'snapchat_ad_acount_id' => env('SNAPCHAT_AD_ACCOUNT_ID'),
        'snapchat_redirect_uri' => env('SNAPCHAT_REDIRECT_URI'),
        'snapchat_api_url' => env('SNAPCHAT_API_URL'),
        'snapchat_client_id' => env('SNAPCHAT_CLIENT_ID'),
        'snapchat_client_secret' => env('SNAPCHAT_CLIENT_SECRET'),
        'snapchat_profile_id' => env('SNAPCHAT_PROFILE_ID'),   
    ],
];
