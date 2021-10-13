<?php

return [
    'topup' => [
        'registration' => (int) env('TOPUP_REGISTRATION', 0),
        'checkin' => (int) env('TOPUP_CHECKIN', 0),
    ],
    'contact' => [
        'default' => [
            'pin' =>  env('CONTACT_DEFAULT_PIN', '1234')
        ],
    ],
];
