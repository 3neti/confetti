<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseInstructContactListenerAction;

class SendVoteInstructions extends BaseInstructContactListenerAction
{
    const STAGE = DDayStage::VOTE;
}
