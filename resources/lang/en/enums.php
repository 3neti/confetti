<?php

use App\Enums\DDayStage;

return [
    DDayStage::class => [
        DDayStage::CHECKIN => 'check in stage link',
        DDayStage::INGRESS => 'ingress stage link',
        DDayStage::VOTE => 'voting stage link',
        DDayStage::COUNT => 'count stage link',
        DDayStage::TRANSMISSION => 'transmission stage link',
        DDayStage::EGRESS => 'egress stage link',
    ],

];
