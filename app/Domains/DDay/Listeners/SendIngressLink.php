<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseLinkContactListenerAction;

class SendIngressLink extends BaseLinkContactListenerAction
{
    const STAGE = DDayStage::INGRESS;
}
