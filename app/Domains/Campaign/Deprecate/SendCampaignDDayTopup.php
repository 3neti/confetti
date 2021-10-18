<?php

namespace App\Domains\Campaign\Deprecate;

use App\Domains\Common\Listeners\BaseDDayTopupContactListenerAction;

//deprecate
class SendCampaignDDayTopup extends BaseDDayTopupContactListenerAction
{
    protected function getAmount(): int
    {
        return config('confetti.topup.registration');
    }
}
