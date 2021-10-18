<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

class SendVoteDDayTopup extends BaseDDayTopupContactListenerAction
{
    const STAGE = DDayStage::VOTE;
}
