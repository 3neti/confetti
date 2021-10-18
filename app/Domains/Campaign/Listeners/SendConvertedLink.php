<?php

namespace App\Domains\Campaign\Listeners;

use App\Enums\CampaignStage;
use App\Domains\Common\Listeners\BaseCampaignLinkContactListenerAction;


class SendConvertedLink extends BaseCampaignLinkContactListenerAction
{
    const STAGE = CampaignStage::CONVERSION;
}

