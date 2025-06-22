<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{

    public function getStates(Request $request)
    {
        // $countries = $request->input('countries', []);
        $country = $request->input('country'); // single

        $audienceRanges = [
            "saudi" => [
                "Riyadh" => ["snapchat" => "4,800,000 – 6,000,000", "tiktok" => "5,500,000 – 7,200,000"],
                "Jeddah" => ["snapchat" => "3,200,000 – 4,000,000", "tiktok" => "3,800,000 – 4,600,000"],
                "Dammam" => ["snapchat" => "1,300,000 – 1,800,000", "tiktok" => "1,500,000 – 2,100,000"],
                "Mecca" => ["snapchat" => "2,100,000 – 2,900,000", "tiktok" => "2,400,000 – 3,200,000"],
                "Medina" => ["snapchat" => "1,000,000 – 1,400,000", "tiktok" => "1,200,000 – 1,700,000"],
                "Tabuk" => ["snapchat" => "600,000 – 900,000", "tiktok" => "750,000 – 1,100,000"],
                "Abha" => ["snapchat" => "500,000 – 800,000", "tiktok" => "650,000 – 950,000"],
                "Khobar" => ["snapchat" => "900,000 – 1,300,000", "tiktok" => "1,100,000 – 1,600,000"],
                "Yanbu" => ["snapchat" => "400,000 – 700,000", "tiktok" => "550,000 – 850,000"]
            ],
            "uae" => [
                "Dubai" => ["snapchat" => "2,200,000 – 2,800,000", "tiktok" => "2,600,000 – 3,200,000"],
                "Abu Dhabi" => ["snapchat" => "1,800,000 – 2,400,000", "tiktok" => "2,100,000 – 2,700,000"],
                "Sharjah" => ["snapchat" => "1,200,000 – 1,600,000", "tiktok" => "1,400,000 – 1,800,000"],
                "Ajman" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Fujairah" => ["snapchat" => "300,000 – 500,000", "tiktok" => "350,000 – 600,000"],
                "Ras Al Khaimah" => ["snapchat" => "400,000 – 600,000", "tiktok" => "450,000 – 700,000"],
                "Umm Al Quwain" => ["snapchat" => "150,000 – 250,000", "tiktok" => "200,000 – 300,000"],
                "Al Ain" => ["snapchat" => "600,000 – 900,000", "tiktok" => "750,000 – 1,000,000"]
            ],
            "kuwait" => [
                "Kuwait City" => ["snapchat" => "1,000,000 – 1,300,000", "tiktok" => "1,200,000 – 1,500,000"],
                "Hawalli" => ["snapchat" => "700,000 – 900,000", "tiktok" => "850,000 – 1,100,000"],
                "Salmiya" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Farwaniya" => ["snapchat" => "600,000 – 850,000", "tiktok" => "700,000 – 950,000"],
                "Ahmadi" => ["snapchat" => "550,000 – 750,000", "tiktok" => "650,000 – 850,000"],
                "Jahra" => ["snapchat" => "300,000 – 500,000", "tiktok" => "400,000 – 600,000"],
                "Fintas" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"]
            ],
            "qatar" => [
                "Doha" => ["snapchat" => "1,500,000 – 2,000,000", "tiktok" => "1,800,000 – 2,300,000"],
                "Al Rayyan" => ["snapchat" => "800,000 – 1,100,000", "tiktok" => "900,000 – 1,300,000"],
                "Umm Salal" => ["snapchat" => "300,000 – 450,000", "tiktok" => "350,000 – 500,000"],
                "Al Wakrah" => ["snapchat" => "400,000 – 600,000", "tiktok" => "500,000 – 700,000"],
                "Al Khor" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 450,000"],
                "Dukhan" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "Mesaieed" => ["snapchat" => "150,000 – 250,000", "tiktok" => "200,000 – 300,000"]
            ],
            "bahrain" => [
                "Manama" => ["snapchat" => "700,000 – 900,000", "tiktok" => "800,000 – 1,000,000"],
                "Riffa" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Muharraq" => ["snapchat" => "300,000 – 500,000", "tiktok" => "350,000 – 600,000"],
                "Hamad Town" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 500,000"],
                "Isa Town" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "A'ali" => ["snapchat" => "150,000 – 250,000", "tiktok" => "180,000 – 280,000"],
                "Sitra" => ["snapchat" => "100,000 – 200,000", "tiktok" => "120,000 – 220,000"]
            ],
            "oman" => [
                "Muscat" => ["snapchat" => "1,200,000 – 1,500,000", "tiktok" => "1,400,000 – 1,800,000"],
                "Salalah" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Sohar" => ["snapchat" => "400,000 – 600,000", "tiktok" => "500,000 – 700,000"],
                "Nizwa" => ["snapchat" => "300,000 – 450,000", "tiktok" => "350,000 – 500,000"],
                "Sur" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 450,000"],
                "Ibri" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "Barka" => ["snapchat" => "180,000 – 280,000", "tiktok" => "220,000 – 320,000"],
                "Rustaq" => ["snapchat" => "150,000 – 250,000", "tiktok" => "180,000 – 280,000"]
            ]
        ];

        $result = [];

        if (isset($audienceRanges[$country])) {
            $result[$country] = array_keys($audienceRanges[$country]);
        }


        return response()->json(['states' => $result]);
    }

    public function getAudience(Request $request)
    {
        $inputStates = $request->input('states', []); // e.g., ['saudi|Riyadh', 'uae|Dubai']
        $platform = $request->input('platform');

        $audienceRanges = [
            "saudi" => [
                "Riyadh" => ["snapchat" => "4,800,000 – 6,000,000", "tiktok" => "5,500,000 – 7,200,000"],
                "Jeddah" => ["snapchat" => "3,200,000 – 4,000,000", "tiktok" => "3,800,000 – 4,600,000"],
                "Dammam" => ["snapchat" => "1,300,000 – 1,800,000", "tiktok" => "1,500,000 – 2,100,000"],
                "Mecca" => ["snapchat" => "2,100,000 – 2,900,000", "tiktok" => "2,400,000 – 3,200,000"],
                "Medina" => ["snapchat" => "1,000,000 – 1,400,000", "tiktok" => "1,200,000 – 1,700,000"],
                "Tabuk" => ["snapchat" => "600,000 – 900,000", "tiktok" => "750,000 – 1,100,000"],
                "Abha" => ["snapchat" => "500,000 – 800,000", "tiktok" => "650,000 – 950,000"],
                "Khobar" => ["snapchat" => "900,000 – 1,300,000", "tiktok" => "1,100,000 – 1,600,000"],
                "Yanbu" => ["snapchat" => "400,000 – 700,000", "tiktok" => "550,000 – 850,000"]
            ],
            "uae" => [
                "Dubai" => ["snapchat" => "2,200,000 – 2,800,000", "tiktok" => "2,600,000 – 3,200,000"],
                "Abu Dhabi" => ["snapchat" => "1,800,000 – 2,400,000", "tiktok" => "2,100,000 – 2,700,000"],
                "Sharjah" => ["snapchat" => "1,200,000 – 1,600,000", "tiktok" => "1,400,000 – 1,800,000"],
                "Ajman" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Fujairah" => ["snapchat" => "300,000 – 500,000", "tiktok" => "350,000 – 600,000"],
                "Ras Al Khaimah" => ["snapchat" => "400,000 – 600,000", "tiktok" => "450,000 – 700,000"],
                "Umm Al Quwain" => ["snapchat" => "150,000 – 250,000", "tiktok" => "200,000 – 300,000"],
                "Al Ain" => ["snapchat" => "600,000 – 900,000", "tiktok" => "750,000 – 1,000,000"]
            ],
            "kuwait" => [
                "Kuwait City" => ["snapchat" => "1,000,000 – 1,300,000", "tiktok" => "1,200,000 – 1,500,000"],
                "Hawalli" => ["snapchat" => "700,000 – 900,000", "tiktok" => "850,000 – 1,100,000"],
                "Salmiya" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Farwaniya" => ["snapchat" => "600,000 – 850,000", "tiktok" => "700,000 – 950,000"],
                "Ahmadi" => ["snapchat" => "550,000 – 750,000", "tiktok" => "650,000 – 850,000"],
                "Jahra" => ["snapchat" => "300,000 – 500,000", "tiktok" => "400,000 – 600,000"],
                "Fintas" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"]
            ],
            "qatar" => [
                "Doha" => ["snapchat" => "1,500,000 – 2,000,000", "tiktok" => "1,800,000 – 2,300,000"],
                "Al Rayyan" => ["snapchat" => "800,000 – 1,100,000", "tiktok" => "900,000 – 1,300,000"],
                "Umm Salal" => ["snapchat" => "300,000 – 450,000", "tiktok" => "350,000 – 500,000"],
                "Al Wakrah" => ["snapchat" => "400,000 – 600,000", "tiktok" => "500,000 – 700,000"],
                "Al Khor" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 450,000"],
                "Dukhan" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "Mesaieed" => ["snapchat" => "150,000 – 250,000", "tiktok" => "200,000 – 300,000"]
            ],
            "bahrain" => [
                "Manama" => ["snapchat" => "700,000 – 900,000", "tiktok" => "800,000 – 1,000,000"],
                "Riffa" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Muharraq" => ["snapchat" => "300,000 – 500,000", "tiktok" => "350,000 – 600,000"],
                "Hamad Town" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 500,000"],
                "Isa Town" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "A'ali" => ["snapchat" => "150,000 – 250,000", "tiktok" => "180,000 – 280,000"],
                "Sitra" => ["snapchat" => "100,000 – 200,000", "tiktok" => "120,000 – 220,000"]
            ],
            "oman" => [
                "Muscat" => ["snapchat" => "1,200,000 – 1,500,000", "tiktok" => "1,400,000 – 1,800,000"],
                "Salalah" => ["snapchat" => "500,000 – 700,000", "tiktok" => "600,000 – 800,000"],
                "Sohar" => ["snapchat" => "400,000 – 600,000", "tiktok" => "500,000 – 700,000"],
                "Nizwa" => ["snapchat" => "300,000 – 450,000", "tiktok" => "350,000 – 500,000"],
                "Sur" => ["snapchat" => "250,000 – 400,000", "tiktok" => "300,000 – 450,000"],
                "Ibri" => ["snapchat" => "200,000 – 300,000", "tiktok" => "250,000 – 350,000"],
                "Barka" => ["snapchat" => "180,000 – 280,000", "tiktok" => "220,000 – 320,000"],
                "Rustaq" => ["snapchat" => "150,000 – 250,000", "tiktok" => "180,000 – 280,000"]
            ]
        ];
        $result = [];

        foreach ($inputStates as $item) {
            [$country, $state] = explode('|', $item);

            if (isset($audienceRanges[$country][$state])) {
                $data = $audienceRanges[$country][$state];

                // Return only selected platform if set, otherwise both
                $result[] = [
                    'country' => $country,
                    'state' => $state,
                    'snapchat' => $platform === 'snapchat' || !$platform ? ($data['snapchat'] ?? 'N/A') : '-',
                    'tiktok' => $platform === 'tiktok' || !$platform ? ($data['tiktok'] ?? 'N/A') : '-',
                ];
            }
        }
        // dd($result);

        return response()->json($result);
    }


}
