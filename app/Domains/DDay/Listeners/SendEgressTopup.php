<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseTopupContactListenerAction;

class SendEgressTopup extends BaseTopupContactListenerAction
{
    const STAGE = DDayStage::EGRESS;
}
