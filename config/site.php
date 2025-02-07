<?php

use Illuminate\Support\Facades\Facade;

return [
    'invalid' => [
        'allowed' => false
    ],
    'valid' => [
        'allowed' => true
    ],
    'onlineApp' => env('ONLINE_APP', false),
    'urlOnlineApp' => env('ONLINE_APP_URL', ''),
    'versionCaller' => env('VERSION_CALLER', 'v2')
];
