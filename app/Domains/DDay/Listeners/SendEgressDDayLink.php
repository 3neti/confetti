<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayLinkContactListenerAction;

class SendEgressDDayLink extends BaseDDayLinkContactListenerAction
{
    const STAGE = DDayStage::EGRESS;
}

