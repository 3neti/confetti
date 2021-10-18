<?php

namespace App\Domains\Common\Listeners;

use App\Exceptions\CampaignConstantException;

abstract class BaseCampaignTopupContactListenerAction extends BaseTopupContactListenerAction
{
    protected function getAmount(): int
    {
        if (!defined('static::STAGE')) {
            throw new CampaignConstantException;
        }

        return config('confetti.campaign.topup')[static::STAGE];
    }
}
