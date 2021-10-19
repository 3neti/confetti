<?php

use App\Enums\{
    DDayStage,
    CampaignStage
};
use App\Domains\Campaign\Events\{
    ContactMadeAware,
    ContactInterested,
    ContactConsidered,
    ContactEvaluated,
    ContactDecided,
    ContactConverted,
};

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
    'demo' => [
        'topup' => [
            'register' => (int) env('DEMO_REGISTER_TOPUP', 0),
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
    'campaign' => [
        'event' => [
            CampaignStage::AWARENESS => ContactMadeAware::class,
            CampaignStage::INTEREST => ContactInterested::class,
            CampaignStage::CONSIDERATION => ContactConsidered::class,
            CampaignStage::EVALUATION => ContactEvaluated::class,
            CampaignStage::DECISION => ContactDecided::class,
            CampaignStage::CONVERSION => ContactConverted::class,
        ],
        'fields' => [
            CampaignStage::AWARENESS => [
                'mobile' => 'required',
                'aware' => 'required' //aware of running
            ],
            CampaignStage::INTEREST => [
                'mobile' => 'required',
                'interested' => 'required', //interested to fight criminality, corruption, etc.
            ],
            CampaignStage::CONSIDERATION => [
                'mobile' => 'required',
                'considered' => 'required', //consider an alternative to
            ],
            CampaignStage::EVALUATION => [
                'mobile' => 'required',
                'evaluated' => 'required',
            ],
            CampaignStage::DECISION => [
                'mobile' => 'required',
                'decided' => 'required',
            ],
            CampaignStage::CONVERSION => [
                'mobile' => 'required',
                'converted' => 'required',
            ],
        ],
        'link' => [
            CampaignStage::AWARENESS => env('AWARENESS_LINK', 'bit.ly/CampaignAwareness'),
            CampaignStage::INTEREST => env('INTEREST_LINK', 'bit.ly/CampaignInterest'),
            CampaignStage::CONSIDERATION => env('CONSIDERATION_LINK', 'bit.ly/CampaignConsideration'),
            CampaignStage::EVALUATION => env('EVALUATION_LINK', 'bit.ly/CampaignEvaluation'),
            CampaignStage::DECISION => env('DECISION_LINK', 'bit.ly/CampaignDecision'),
            CampaignStage::CONVERSION => env('CONVERSION_LINK', 'bit.ly/CampaignConversion'),
        ],
        'topup' => [
            CampaignStage::AWARENESS => env('AWARENESS_TOPUP', 10),
            CampaignStage::INTEREST => env('INTEREST_TOPUP', 20),
            CampaignStage::CONSIDERATION => env('CONSIDERATION_TOPUP', 30),
            CampaignStage::EVALUATION => env('EVALUATION_TOPUP', 30),
            CampaignStage::DECISION => env('DECISION_TOPUP', 40),
            CampaignStage::CONVERSION => env('CONVERSION_TOPUP', 50),
        ],
    ],
];
