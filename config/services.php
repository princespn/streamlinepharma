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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'instamojo' => [

        // 'api_key'       => 'test_02ebb009e61da81d9f50d3b4ed0',
        // 'auth_token'    => 'test_25528b85a090d521ceac8bd0ac9',
        // 'url'           => 'https://test.instamojo.com/api/1.1/',

        'api_key'       => 'dee8187d62c63d2955baf37889e35860',
        'auth_token'    => 'df569c61770b6a55f7dec9cc5d89ce9a',
        'url'           => 'https://www.instamojo.com/api/1.1/',
    
    ],

];
