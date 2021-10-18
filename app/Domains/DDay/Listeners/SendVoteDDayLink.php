<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayLinkContactListenerAction;

class SendVoteDDayLink extends BaseDDayLinkContactListenerAction
{
    const STAGE = DDayStage::VOTE;
}
