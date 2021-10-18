<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

class SendTransmissionDDayTopup extends BaseDDayTopupContactListenerAction
{
    const STAGE = DDayStage::TRANSMISSION;
}
