<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignLinkContactListenerAction;


class SendAwarenessLink extends BaseCampaignLinkContactListenerAction
{
    const STAGE = CampaignStage::AWARENESS;
}
