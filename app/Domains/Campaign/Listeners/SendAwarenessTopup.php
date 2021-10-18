<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignTopupContactListenerAction;

class SendAwarenessTopup extends BaseCampaignTopupContactListenerAction
{
    const STAGE = CampaignStage::AWARENESS;
}
