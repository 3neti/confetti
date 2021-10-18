<?php

use App\Enums\{CampaignStage, DDayStage};

return [
    DDayStage::class => [
        DDayStage::CHECKIN => 'check in stage link',
        DDayStage::INGRESS => 'ingress stage link',
        DDayStage::VOTE => 'voting stage link',
        DDayStage::COUNT => 'count stage link',
        DDayStage::TRANSMISSION => 'transmission stage link',
        DDayStage::EGRESS => 'egress stage link'
    ],
    CampaignStage::class => [
        CampaignStage::AWARENESS => 'awareness stage link',
        CampaignStage::INTEREST => 'interest stage link',
        CampaignStage::CONSIDERATION => 'consideration stage link',
        CampaignStage::EVALUATION => 'evaluation stage link',
        CampaignStage::DECISION => 'decision stage link',
        CampaignStage::CONVERSION => 'conversion stage link',
        CampaignStage::RETENTION => 'retention stage link',
        CampaignStage::LOYALTY => 'loyalty stage link',
        CampaignStage::ADVOCACY => 'advocacy stage link'
    ],
];
