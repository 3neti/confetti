<?php

namespace App\Domains\DDay\Listeners;

use App\Enums\DDayStage;
use App\Domains\Common\Listeners\BaseTopupContactListenerAction;

class SendTransmissionTopup extends BaseTopupContactListenerAction
{
    const STAGE = DDayStage::TRANSMISSION;
}
