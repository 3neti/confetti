<?php

namespace App\Actions;

class TopupRegistrantAction extends TopupContact
{
    protected function getAmount(): int
    {
        return config('confetti.topup.registration');
    }
}
