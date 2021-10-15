<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseInstructContactListenerAction;

class SendTransmissionInstructions extends BaseInstructContactListenerAction
{
    const STAGE = DDayStage::TRANSMISSION;
}
