<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayLinkContactListenerAction;

class SendIngressDDayLink extends BaseDDayLinkContactListenerAction
{
    const STAGE = DDayStage::INGRESS;
}
