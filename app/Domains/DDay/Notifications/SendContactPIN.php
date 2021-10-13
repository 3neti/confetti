<?php

namespace App\Domains\DDay\Notifications;

use LBHurtado\EngageSpark\Notifications\BaseNotification;

class SendContactPIN extends BaseNotification implements MustSendPIN
{
    protected $pin;

    public function getContent($notifiable)
    {
        return trans('confetti.checkin.pin', ['pin' => $this->pin]);
    }

    public function setPIN($pin): self
    {
        $this->pin = $pin;

        return $this;
    }
}
