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

    'google' => [
        'client_id' => '905098694565-f1o69sd14q8b7j4jjmj1a7trtd3uce8v.apps.googleusercontent.com',
        'client_secret' => '2hX7wD62JqTHoqwbIxa0RFCS',
        'redirect' => 'http://127.0.0.1:8000/login/google/callback',
    ],

    'github' => [
        'client_id' => '',
        'client_secret' => '',
        'redirect' => 'http://127.0.0.1:8000/login/github/callback',
    ]
];
