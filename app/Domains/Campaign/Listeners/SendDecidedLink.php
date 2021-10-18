<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignLinkContactListenerAction;


class SendDecidedLink extends BaseCampaignLinkContactListenerAction
{
    const STAGE = CampaignStage::DECISION;
}

