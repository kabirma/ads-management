<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use TheNetworg\OAuth2\Client\Provider\Azure;

class MailService
{
    protected $accessToken;

    public function __construct()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://login.microsoftonline.com/' . env('OUTLOOK_TENANT_ID') . '/oauth2/v2.0/token', [
            'form_params' => [
                'grant_type'    => 'client_credentials',
                'client_id'     => env('OUTLOOK_CLIENT_ID'),
                'client_secret' => env('OUTLOOK_SECRET_VALUE'),
                'scope'         => 'https://graph.microsoft.com/.default',
            ],
        ]);

        $this->accessToken = json_decode($response->getBody()->getContents(), true)['access_token'];
    }

    // Needed to verify if info email was correct
    public function resolveUser()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://graph.microsoft.com/v1.0/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ]);

        $res = $client->get('users/' . env('OUTLOOK_FROM_ADDRESS'));

        return json_decode($res->getBody()->getContents(), true);
    }

    public function sendMail($to, $subject, $htmlBody)
    {
        $client = new Client([
            'base_uri' => 'https://graph.microsoft.com/v1.0/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ],
        ]);

        $response = $client->post('users/' . env('OUTLOOK_FROM_ADDRESS') . '/sendMail', [
            'json' => [
                'message' => [
                    'subject' => $subject,
                    'body' => [
                        'contentType' => 'HTML',
                        'content' => $htmlBody,
                    ],
                    'toRecipients' => [
                        [
                            'emailAddress' => [
                                'address' => $to,
                            ],
                        ],
                    ],
                ],
                'saveToSentItems' => true,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}