<?php

use App\Enums\DDayStage;

return [
    'acknowledgement' => [
        'registration' => 'Your participation is very much appreciated!  Thank you. - HQ'
    ],
    'topup' => [
        'expectation' => 'Please stand by - you will receive a "pasa load" shortly.  Thank you. - HQ',
    ],
    'campaign' => [
        'welcome' => 'Welcome to the campaign!  Thank you.'
    ],
    'dday' => [
        'authorization' => 'This is your authorization code: :pin. You will use it to authenticate your reports. - HQ',
        'instructions' => [
            DDayStage::CHECKIN => 'Checkin stage instructions',
            DDayStage::INGRESS => 'Ingress stage instructions',
            DDayStage::VOTE => 'Vote stage instructions',
            DDayStage::COUNT => 'Count stage instructions',
            DDayStage::TRANSMISSION => 'Transmission stage instructions',
            DDayStage::EGRESS => 'Egress stage instructions',

        ],
        'link' => ':name: Click the :description link: :link',
    ],
    'reminder' => 'This is a reminder.',
];
