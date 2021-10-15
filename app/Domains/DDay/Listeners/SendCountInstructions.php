<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseInstructContactListenerAction;

class SendCountInstructions extends BaseInstructContactListenerAction
{
    const STAGE = DDayStage::COUNT;
}
