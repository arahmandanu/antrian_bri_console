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
    'urlOnlineApp' => 'https://bri-antrian.online',
    // 'urlOnlineApp' => 'http://localhost/antrian_bri',
    // Yang bisa disetting di bawah ini
    'versionCaller' => 'v2',
    'printerEnabled' => false,
    'intervalCallNextQueue' => 2000,
    'intervalAutoSyncReport' => 5000,
    'ajaxTimeOut' => 2000,
    'volumeIklan' => 0.2,
    'delaySound' => 6,
    'queueOfflineIsFirst' => false,
    // TAMPILKAN TOMBOL PEGADAIAN
    'withPegadaian' => false,
    // SETTINGS VIDEOS
    'company_type' => 'kcp', //kcp, unit, all (kalo dikosong default nya all)
];
