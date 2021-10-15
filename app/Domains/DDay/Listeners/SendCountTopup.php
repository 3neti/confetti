<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseTopupContactListenerAction;

class SendCountTopup extends BaseTopupContactListenerAction
{
    const STAGE = DDayStage::COUNT;
}
