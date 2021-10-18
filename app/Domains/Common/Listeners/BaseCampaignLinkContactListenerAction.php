<?php

namespace App\Domains\Common\Listeners;

use App\Enums\CampaignStage;
use App\Exceptions\CampaignConstantException;

abstract class BaseCampaignLinkContactListenerAction extends BaseLinkContactListenerAction
{
    protected function getMessage(): string
    {
        if (!defined('static::STAGE')) {
            throw new CampaignConstantException;
        }
        $stage = CampaignStage::fromValue(static::STAGE);
        $name = $stage->key;
        $description = $stage->description;
        $link = config('confetti.campaign.link')[$stage->value];

        return trans('confetti.campaign.link', compact('name', 'description', 'link'));
    }
}
