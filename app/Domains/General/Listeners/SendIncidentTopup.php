<?php

namespace App\Domains\General\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

class SendIncidentTopup extends BaseDDayTopupContactListenerAction
{
    const STAGE = DDayStage::INCIDENT;
}
