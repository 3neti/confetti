<?php

use App\Enums\DDayStage;

return [
    'topup' => [
        'registration' => (int) env('TOPUP_REGISTRATION', 0),
        'checkin' => (int) env('TOPUP_CHECKIN', 0),
        'ingress' => (int) env('TOPUP_INGRESS', 0),
    ],
    'contact' => [
        'default' => [
            'pin' =>  env('CONTACT_DEFAULT_PIN', '1234')
        ],
    ],
    'dday' => [
        'link' => [
            DDayStage::CHECKIN => env('CHECKIN_LINK', 'bit.ly/DDayCheckIn'),
            DDayStage::INGRESS => env('INGRESS_LINK', 'bit.ly/DDayIngress'),
            DDayStage::VOTE => env('VOTE_LINK', 'bit.ly/DDayVote'),
            DDayStage::COUNT => env('COUNT_LINK', 'bit.ly/DDayCount'),
            DDayStage::TRANSMISSION => env('TRANSMISSION_LINK', 'bit.ly/DDayTransmission'),
            DDayStage::EGRESS => env('INSPECTION_LINK', 'bit.ly/DDayEgress'),
        ],
        'topup' => [
            DDayStage::CHECKIN => env('CHECKIN_TOPUP', 10),
            DDayStage::INGRESS => env('INGRESS_TOPUP', 20),
            DDayStage::VOTE => env('VOTE_TOPUP', 30),
            DDayStage::COUNT => env('COUNT_TOPUP', 40),
            DDayStage::TRANSMISSION => env('TRANSMISSION_TOPUP', 50),
            DDayStage::EGRESS => env('INSPECTION_TOPUP', 60),
        ],
    ],
];
