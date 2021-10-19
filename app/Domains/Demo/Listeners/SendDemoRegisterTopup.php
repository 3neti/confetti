<?php


namespace App\Domains\Demo\Listeners;


use App\Domains\Common\Listeners\BaseTopupContactListenerAction;

class SendDemoRegisterTopup extends BaseTopupContactListenerAction
{
    protected function getAmount(): int
    {
        return config('confetti.demo.topup.register');
    }

}
