<?php

namespace App\Domains\Common\Listeners;

use App\Domains\Campaign\Deprecate\SendCampaignDDayTopup;
use App\Exceptions\DDayConstantException;

abstract class BaseDDayTopupContactListenerAction extends BaseTopupContactListenerAction
{
    protected function getAmount(): int
    {
        if (!defined('static::STAGE')) {
            throw new DDayConstantException;
        }

        return config('confetti.dday.topup')[static::STAGE];
    }
}
