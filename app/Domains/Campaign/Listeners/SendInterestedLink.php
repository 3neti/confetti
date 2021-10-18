<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignLinkContactListenerAction;


class SendInterestedLink extends BaseCampaignLinkContactListenerAction
{
    const STAGE = CampaignStage::INTEREST;
}
