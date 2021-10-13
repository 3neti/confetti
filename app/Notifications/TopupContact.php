<?php

namespace App\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class TopupContact extends BaseNotification
{
    public function getContent($notifiable)
    {
        return trans('confetti.topup.registration');
    }
}
