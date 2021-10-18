<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

class SendCountDDayTopup extends BaseDDayTopupContactListenerAction
{
    const STAGE = DDayStage::COUNT;
}
