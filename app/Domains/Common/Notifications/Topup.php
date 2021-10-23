<?php

namespace App\Domains\Common\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class Topup extends BaseNotification
{
    public function via($notifiable) //update lbhurtado/engagespark
    {
        if (empty($this->getContent($notifiable)))
            return [];

        return config('engagespark.notification.channels');
    }

    public function getAmount($notifiable)//published for test purposes
    {
        return $this->amount;
    }
}
