<?php

return [

    'accepted_secret' => env('ACCEPTED_SECRET'),

    'api_gateway' => [
        
        'base_url' => env('API_GATEWAY_BASE_URL')

    ],

    'toeis' => [

        'base_url' => env('TOEIS_BASE_URL'),
        'secret' => env('TOEIS_SECRET')

    ]
];