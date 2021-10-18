<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayLinkContactListenerAction;

class SendCountDDayLink extends BaseDDayLinkContactListenerAction
{
    const STAGE = DDayStage::COUNT;
}
