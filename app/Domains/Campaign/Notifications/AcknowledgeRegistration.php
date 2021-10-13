<?php

namespace App\Domains\Campaign\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class AcknowledgeRegistration extends BaseNotification
{
    public function getContent($notifiable)
    {
        return trans('confetti.acknowledgement.registration');
    }
}
