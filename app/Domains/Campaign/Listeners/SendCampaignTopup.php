<?php

namespace App\Domains\Campaign\Listeners;

use App\Domains\Common\Listeners\BaseTopupContactListenerAction;

class SendCampaignTopup extends BaseTopupContactListenerAction
{
    protected function getAmount(): int
    {
        return config('confetti.topup.registration');
    }
}
