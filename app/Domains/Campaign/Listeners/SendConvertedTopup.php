<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignTopupContactListenerAction;

class SendConvertedTopup extends BaseCampaignTopupContactListenerAction
{
    const STAGE = CampaignStage::CONVERSION;
}
