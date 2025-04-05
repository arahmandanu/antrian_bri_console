<?php

use Illuminate\Support\Facades\Facade;

return [
    'invalid' => [
        'allowed' => false
    ],
    'valid' => [
        'allowed' => true
    ],
    'onlineApp' => true,
    // 'urlOnlineApp' => 'https://bri-antrian.online',
    'urlOnlineApp' => 'localhost/antrian_bri',
    // Yang bisa disetting di bawah ini
    'versionCaller' => 'v2',
    'printerEnabled' => false,
    'intervalCallNextQueue' => 2000,
    'intervalAutoSyncReport' => 5000,
    'ajaxTimeOut' => 2000,
    'volumeIklan' => 0.2,
    'delaySound' => 6
];
