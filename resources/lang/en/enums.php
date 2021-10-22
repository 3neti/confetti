<?php

use App\Enums\{CampaignStage, DDayStage};

return [
    DDayStage::class => [
        DDayStage::CHECKIN => 'signify intention in executing with your poll watching duties',
        DDayStage::INGRESS => 'report your presence in the voting center',
        DDayStage::VOTE => 'report your vote',
        DDayStage::COUNT => 'report your tally',
        DDayStage::TRANSMISSION => 'report the transmission proceedings',
        DDayStage::EGRESS => "report the candidate's position results"
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
