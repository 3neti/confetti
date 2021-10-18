<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayLinkContactListenerAction;

class SendTransmissionDDayLink extends BaseDDayLinkContactListenerAction
{
    const STAGE = DDayStage::TRANSMISSION;
}
