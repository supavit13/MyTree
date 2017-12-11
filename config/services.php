<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '1251841691592100',
        'client_secret' => '22da2ef82447a5060188c5960fb8c005',
        'redirect' => 'http://mytree-th.herokuapp.com/validation',
    ],
    'google' => [
        'client_id' => '92557457763-qhd2mubimahpcm247g7v2spf8j9ldnco.apps.googleusercontent.com',
        'client_secret' => 'DsZYRPxqN3qUkxr-KnH2fb6Z',
        'redirect' => 'http://mytree-th.herokuapp.com/validation',
    ],


];
