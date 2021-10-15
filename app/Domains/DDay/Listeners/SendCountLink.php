<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseLinkContactListenerAction;

class SendCountLink extends BaseLinkContactListenerAction
{
    const STAGE = DDayStage::COUNT;
}
