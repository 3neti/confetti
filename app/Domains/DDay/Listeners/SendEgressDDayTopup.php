<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

class SendEgressDDayTopup extends BaseDDayTopupContactListenerAction
{
    const STAGE = DDayStage::EGRESS;
}
