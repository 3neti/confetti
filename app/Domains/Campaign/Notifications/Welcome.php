<?php

namespace App\Domains\Campaign\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class Welcome extends BaseNotification
{
    public function getContent($notifiable)
    {
        return trans('confetti.campaign.welcome');
    }
}
