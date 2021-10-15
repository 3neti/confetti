<?php

namespace App\Domains\DDay\Notifications;

use App\Domains\DDay\Interfaces\MustSendPIN;
use LBHurtado\EngageSpark\Notifications\BaseNotification;

class Authorization extends BaseNotification implements MustSendPIN
{
    protected $pin;

    public function getContent($notifiable)
    {
        return trans('confetti.dday.authorization', ['pin' => $this->pin]);
    }

    public function setPIN($pin): self
    {
        $this->pin = $pin;

        return $this;
    }
}
