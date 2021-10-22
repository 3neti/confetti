<?php

namespace App\Domains\Common\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class Topup extends BaseNotification
{
    public function getAmount($notifiable)//published for test purposes
    {
        return $this->amount;
    }
}
