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
        'key' => env('pk_test_51OBsIkSBerUuYEFV2torSfUCNK4kyQXqtJiHAWtLIPvfsrRGNGYw1IgE5JDHpeitGHyBhCYyTmZuVhvvqw0xZnTv00Nnkec9sf'),
        'secret' => env('sk_test_51OBsIkSBerUuYEFVz9agXn60XbG9tDPNyxFPmnuAZEjyl6kOgonyv5uFQxPw7Cukm4VgulIGfzxf5LrJGHgtuUFr00LPGgWhyz'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
