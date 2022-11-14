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

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /**
     * Configuración de acceso al Api Gateway
     */
    'api_gateway' => [
        'base_uri' => env('API_GATEWAY_BASE_URI', 'http://md-api-gateway'),
        'access_secret' => env('API_GATEWAY_ACCESS_SECRET', 'PlyxRzUxpm5GG0r3bOOJkufTT9kUnnYj')
    ],

    'access_secrets' => env('ACCESS_SECRETS', 'n5IZ4MFPx61PsIud15Mmi3Gda3cDQdJ5')

];
